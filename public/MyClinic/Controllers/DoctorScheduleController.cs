using DataTables.Mvc;
using MyClinic.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Linq.Dynamic;
using System.Data.Entity;
using System.Globalization;
using Microsoft.AspNet.Identity;

namespace MyClinic.Controllers
{
    [Authorize]
    public class DoctorScheduleController : Controller
    {
        private ApplicationDbContext db = new ApplicationDbContext();

        // GET: Doctor Schedule
        public ActionResult Index()
        {
            ViewBag.patient = db.Patients.Select(x => new
            {
                x.PatientId,
                PatientName = x.FullName
            }).ToList();

            ViewBag.service = db.Services.Select(x => new
            {
                x.ServiceID,
                ServiceName = x.Name
            }).ToList();

            return View();
        }

        public ActionResult Get([ModelBinder(typeof(DataTablesBinder))] IDataTablesRequest requestModel, string fromDate, string toDate)
        {
            DateTime dtFrom = DateTime.Parse(fromDate);
            DateTime dtTo = DateTime.Parse(toDate);
            string DoctorID = User.Identity.GetUserId();
            IQueryable<Appointment> query = db.Appointments.Where(r => r.IsCancel == false && r.DoctorId == DoctorID && r.AppointmentDate >= dtFrom && r.AppointmentDate <= dtTo);
            var totalCount = query.Count();

            #region Filtering 

            // Apply filters for searching 
            if (requestModel.Search.Value.Length > 0)
            {
                var value = requestModel.Search.Value.Trim();
                query = query.Where(p => p.AppointmentNotes.Contains(value) ||
                                         p.Users.FullName.Contains(value) ||
                                         p.Patient.Phone.Contains(value) ||
                                         p.Service.Name.Contains(value) ||
                                         p.Patient.FullName.Contains(value));
            }

            var filteredCount = query.Count();

            #endregion Filtering 

            #region Sorting 

            // Sorting 
            var sortedColumns = requestModel.Columns.GetSortedColumns();
            var orderByString = String.Empty;

            foreach (var column in sortedColumns)
            {
                orderByString += orderByString != String.Empty ? "," : "";
                orderByString += (column.Data) + (column.SortDirection == Column.OrderDirection.Ascendant ? " asc" : " desc");
            }

            query = query.OrderBy(orderByString == string.Empty ? "AppointmentNotes asc" : orderByString);

            #endregion Sorting 


            // Paging 
            query = query.Skip(requestModel.Start).Take(requestModel.Length);

            var data = query.Select(a => new 
            {
                a.AppointmentId,
                PatientName = a.Patient.FullName,
                ServiceName = a.Service.Name,
                PhoneNumber = a.Patient.Phone,
                a.AppointmentDate,
                a.AppointmentTime,
                a.AppointmentNotes,
            }).ToList();

            var data2 = data.Select(a => new ListOfAppointmentVM
            {
                AppointmentId = a.AppointmentId,
                PatientName = a.PatientName,
                ServiceName = a.ServiceName,
                PhoneNumber = a.PhoneNumber,
                AppointmentDate = a.AppointmentDate.ToString("dd/MM/yyyy"),
                AppointmentTime = a.AppointmentTime.ToString("hh:mm tt"),
                AppointmentNotes = a.AppointmentNotes
            });

            return Json(new DataTablesResponse(requestModel.Draw, data2, filteredCount, totalCount), JsonRequestBehavior.AllowGet);
        }

        // GET: Appointment/Details/5
        public ActionResult GetAppointment(int? id)
        {
            var appointment = db.Appointments.Where(m => m.AppointmentId == id).Include(r => r.Patient).Include(u => u.Users).Include(x => x.Service).ToList().Select(s => new
            {
                s.AppointmentId,
                s.PatientId,
                PatientName = s.Patient.FullName,
                s.ServiceID,
                s.RequestAmount,
                s.DoctorNotes,
                ServiceName = s.Service.Name,
                PhoneNumber = s.Patient.Phone,
                AppointmentDate = s.AppointmentDate.ToString("dd/MM/yyyy"),
                AppointmentTime = s.AppointmentTime.ToString("hh:mm tt"),
                AppointmentNotes = string.IsNullOrEmpty(s.AppointmentNotes) ? "N/A" : s.AppointmentNotes,
            }).FirstOrDefault();

            return Json(appointment, JsonRequestBehavior.AllowGet);
        }
        public ActionResult GetConfirmAppointment(int? id)
        {
            var appointment = db.Appointments.Where(m => m.AppointmentId == id).Select(s => new
            {
                s.AppointmentId,
                s.DoctorNotes,
            }).FirstOrDefault();

            return Json(appointment, JsonRequestBehavior.AllowGet);
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult SaveAppointment(AppointmentInfoVM appointment)
        {
            DateTime ADate = DateTime.Now;
            if (!string.IsNullOrEmpty(appointment.AppointmentDate))
                ADate = DateTime.ParseExact(appointment.AppointmentDate, "dd/MM/yyyy", CultureInfo.InvariantCulture);
            DateTime ATime = DateTime.Now;
            if (!string.IsNullOrEmpty(appointment.AppointmentTime))
                ATime = DateTime.ParseExact(appointment.AppointmentTime, "hh:mm tt", CultureInfo.InvariantCulture);
            if (appointment.AppointmentId != 0)
            {
                var p = db.Appointments.Find(appointment.AppointmentId);
                p.PatientId = appointment.PatientId;
                p.ServiceID = appointment.ServiceID;
                p.AppointmentDate = ADate;
                p.AppointmentTime = ATime;
                p.AppointmentNotes = appointment.AppointmentNotes;
                db.Entry(p).State = EntityState.Modified;
                db.SaveChanges(); 
                return Json("تم تعديل البيانات بنجاح", JsonRequestBehavior.AllowGet);
            }
            else
            {
                var p = new Appointment();
                p.PatientId = appointment.PatientId;
                p.ServiceID = appointment.ServiceID;
                p.DoctorId = User.Identity.GetUserId();
                p.AppointmentDate = ADate;
                p.AppointmentTime = ATime;
                p.RequestAmount = db.Services.Find(appointment.ServiceID).Price;
                p.AppointmentNotes = appointment.AppointmentNotes;
                p.AddedBy = User.Identity.GetUserId();
                p.AddedDate = DateTime.Now;
                db.Entry(p).State = EntityState.Added;
                db.SaveChanges();
                return Json("تمت إضافة البيانات بنجاح", JsonRequestBehavior.AllowGet);
            }
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult SaveConfirmAppointment(AppointmentInfoVM model)
        {
            if (model.AppointmentId != 0)
            {
                var p = db.Appointments.Find(model.AppointmentId);
                p.DoctorNotes = model.DoctorNotes;
                db.Entry(p).State = EntityState.Modified;
                db.SaveChanges();
                return Json("تمت إضافة البيانات بنجاح", JsonRequestBehavior.AllowGet);
            }
            return HttpNotFound();
        }


        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

    }
}