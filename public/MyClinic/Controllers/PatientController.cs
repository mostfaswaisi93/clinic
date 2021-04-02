using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Threading.Tasks;
using System.Net;
using System.Web;
using System.Web.Mvc;
using MyClinic.Models;
using System.Linq.Dynamic;
using Newtonsoft.Json;
using DataTables.Mvc;
using System.Globalization;
using Microsoft.AspNet.Identity;

namespace MyClinic.Controllers
{
    [Authorize]
    public class PatientController : Controller
    {
        private ApplicationDbContext db = new ApplicationDbContext();

        // GET: Patient
        public ActionResult Index()
        {
            ViewBag.users = db.Users.Where(m => m.Roles.Any(r => r.RoleId == "1")).
                Select(x => new SelectDoctorVM
                {
                    DoctorID = x.Id,
                    DoctorName = x.FullName
                }).ToList();

            ViewBag.Gender = db.Refs.Where(m => m.RefTableNo == 1 && m.RefTableIndex != 0).Select(x => new
            {
                x.RefID,
                Gender = x.DescEng
            }).ToList();

            return View();
        }
        public ActionResult Get([ModelBinder(typeof(DataTablesBinder))] IDataTablesRequest requestModel, string DoctorID)
        {
            IQueryable<Patient> query = db.Patients;
            if (DoctorID != "0")
                query = query.Where(m => m.DoctorId == DoctorID);
            var totalCount = query.Count();

            #region Filtering 

            // Apply filters for searching 
            if (requestModel.Search.Value.Length > 0)
            {
                var value = requestModel.Search.Value.Trim();
                query = query.Where(p => p.FullName.Contains(value) ||
                                         p.Address.Contains(value) ||
                                         p.Phone.Contains(value)
                                   );
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

            query = query.OrderBy(orderByString == string.Empty ? "FullName asc" : orderByString);

            #endregion Sorting 


            // Paging 
            query = query.Skip(requestModel.Start).Take(requestModel.Length);


            var data = query.Select(a => new
            {
                PatientId = a.PatientId,
                FullName = a.FullName,
                Address = a.Address,
                Phone = a.Phone
            }).ToList();

            return Json(new DataTablesResponse(requestModel.Draw, data, filteredCount, totalCount), JsonRequestBehavior.AllowGet);
        }

        // GET: Patient/Details/5
        public ActionResult GetPatient(int? id)
        {
            var patient = db.Patients.Where(m => m.PatientId == id).Include(u => u.Users).Include(r => r.Ref).ToList().Select(s => new
            {
                s.PatientId,
                s.FullName,
                GenderId = s.Gender,
                GenderDesc = s.Ref.DescEng,
                s.Phone,
                s.DoctorId,
                DoctorName = string.IsNullOrEmpty(s.DoctorId) ? "" : s.Users.FullName,
                Address = string.IsNullOrEmpty(s.Address) ? "N/A" : s.Address,
                Notes = string.IsNullOrEmpty(s.Notes) ? "N/A" : s.Notes,
                Birthdate = s.Birthdate.HasValue ? s.Birthdate.Value.ToString("dd/MM/yyyy") : "N/A",
            }).FirstOrDefault();

            return Json(patient, JsonRequestBehavior.AllowGet);
        }


        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult SavePatient(PatientInfoVM patient)
        {
            DateTime? BOD = null;
            if (!string.IsNullOrEmpty(patient.Birthdate))
                BOD = DateTime.ParseExact(patient.Birthdate, "dd/MM/yyyy", CultureInfo.InvariantCulture);

            if (patient.PatientId != 0)
            {
                var p = db.Patients.Find(patient.PatientId);
                p.FullName = patient.FullName;
                p.Birthdate = BOD ?? null;
                p.Phone = patient.Phone;
                p.Gender = patient.Gender;
                p.DoctorId = patient.DoctorId;
                p.Address = patient.Address;
                p.Notes = patient.Notes;
                db.Entry(p).State = EntityState.Modified;
                db.SaveChanges();
                return Json("تم تعديل البيانات بنجاح", JsonRequestBehavior.AllowGet);
            }
            else
            {
                var p = new Patient();
                p.FullName = patient.FullName;
                p.Birthdate = BOD ?? null;
                p.Phone = patient.Phone;
                p.Gender = patient.Gender;
                p.Address = patient.Address;
                p.DoctorId = patient.DoctorId;
                p.AddedBy = User.Identity.GetUserId();
                p.AddedDate = DateTime.Now;
                p.Notes = patient.Notes;
                db.Entry(p).State = EntityState.Added;
                db.SaveChanges();
                return Json("تمت إضافة البيانات بنجاح", JsonRequestBehavior.AllowGet);
            }
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
