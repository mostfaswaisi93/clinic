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
using MyClinic.Common;
using System.Linq.Dynamic;
using Newtonsoft.Json;
using DataTables.Mvc;
using System.Globalization;
using Microsoft.AspNet.Identity;
using Microsoft.Reporting.WebForms;

namespace MyClinic.Controllers
{
    [Authorize]
    public class ReceiptController : Controller
    {
        ApplicationDbContext db = new ApplicationDbContext();
        ReceiptServices RS = new ReceiptServices();
        TransactionServices TS = new TransactionServices();

        public ActionResult ReceiptVoucher()  // سند قبض 
        {
            ViewBag.patient = db.Patients.Select(x => new
            {
                x.PatientId,
                PatientName = x.FullName
            }).ToList();

            return View();
        }

        public ActionResult GetListOfReceiptVoucher([ModelBinder(typeof(DataTablesBinder))] IDataTablesRequest requestModel, string fromDate, string toDate, int PatientId)
        {
            DateTime dtFrom = DateTime.Parse(fromDate);
            DateTime dtTo = DateTime.Parse(toDate);

            IQueryable<Receipt> query = db.Receipts.Where(m => m.RecType == "R");
            query = query.Where(r => r.AddedDate >= dtFrom && r.AddedDate <= dtTo);
            if (PatientId != 0)
                query = query.Where(m => m.PatientID == PatientId);
            var totalCount = query.Count();

            #region Filtering 

            // Apply filters for searching 
            if (requestModel.Search.Value.Length > 0)
            {
                var value = requestModel.Search.Value.Trim();
                query = query.Where(p => p.Patient.FullName.Contains(value) ||
                                         p.Notes.Contains(value) ||
                                         p.Amount.ToString().Contains(value)
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

            query = query.OrderBy(orderByString == string.Empty ? "RecSerial desc" : orderByString);

            #endregion Sorting 


            // Paging 
            query = query.Skip(requestModel.Start).Take(requestModel.Length);


            var data = query.Select(a => new
            {
                a.RecID,
                a.RecSerial,
                PatientName = a.Patient.FullName,
                a.Notes,
                a.Amount,
                a.AddedDate
            }).ToList();

            var data2 = data.ToList().Select(x => new ListOfReceiptVoucherVM
            {
                RecID = x.RecID,
                RecSerial = x.RecSerial,
                PatientName = x.PatientName,
                Notes = x.Notes,
                Amount = x.Amount,
                AddedDate = x.AddedDate.ToString("dd/MM/yyyy")
            });

            return Json(new DataTablesResponse(requestModel.Draw, data2, filteredCount, totalCount), JsonRequestBehavior.AllowGet);
        }

        public ActionResult GetReceiptVoucher(int? id)
        {
            var rec = db.Receipts.Where(m => m.RecID == id).Select(x => new
            {
                RecID = x.RecID,
                RecSerial = x.RecSerial,
                PatientId = x.PatientID,
                PatientName = x.Patient.FullName,
                Notes = x.Notes,
                Amount = x.Amount,
                AddedDate = x.AddedDate
            }).Take(1);

            var rec2 = rec.ToList().Select(x => new
            {
                RecID = x.RecID,
                RecSerial = x.RecSerial,
                PatientId = x.PatientId,
                PatientName = x.PatientName,
                Notes = x.Notes,
                Amount = x.Amount,
                AddedDate = x.AddedDate.ToString("dd/MM/yyyy")
            }).FirstOrDefault();

            return Json(rec2, JsonRequestBehavior.AllowGet);
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult SaveReceiptVoucher(ReceiptVoucherInfoVM receipt)
        {
            var r = new Receipt();
            r.RecSerial = RS.GetNextRecNo(db, "R");
            r.PatientID = receipt.PatientId;
            r.Notes = receipt.Notes;
            r.Amount = receipt.Amount;
            r.RecType = "R";
            r.AddedBy = User.Identity.GetUserId();
            r.AddedDate = DateTime.Now;
            db.Entry(r).State = EntityState.Added;
            db.SaveChanges();
            var res = TS.AddTransction(db, receipt.PatientId, "C", receipt.Amount, r.Notes);

            return Json("تمت إضافة البيانات بنجاح", JsonRequestBehavior.AllowGet);
        }

        ///////
        public ActionResult PaymentVoucher()  // سند صرف 
        {
            return View();
        }

        public ActionResult GetListOfPaymentVoucher([ModelBinder(typeof(DataTablesBinder))] IDataTablesRequest requestModel, string fromDate, string toDate)
        {
            DateTime dtFrom = DateTime.Parse(fromDate);
            DateTime dtTo = DateTime.Parse(toDate);
            IQueryable<Receipt> query = db.Receipts.Where(m => m.RecType == "P");
            query = query.Where(r => r.AddedDate >= dtFrom && r.AddedDate <= dtTo);
            var totalCount = query.Count();

            #region Filtering 

            // Apply filters for searching 
            if (requestModel.Search.Value.Length > 0)
            {
                var value = requestModel.Search.Value.Trim();
                query = query.Where(p => p.Notes.Contains(value) ||
                                         p.Amount.ToString().Contains(value)
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

            query = query.OrderBy(orderByString == string.Empty ? "RecSerial desc" : orderByString);

            #endregion Sorting 


            // Paging 
            query = query.Skip(requestModel.Start).Take(requestModel.Length);


            var data = query.Select(a => new
            {
                a.RecID,
                a.RecSerial,
                a.Notes,
                a.Amount,
                a.AddedDate
            }).ToList();

            var data2 = data.ToList().Select(x => new ListOfReceiptVoucherVM
            {
                RecID = x.RecID,
                RecSerial = x.RecSerial,
                Notes = x.Notes,
                Amount = x.Amount,
                AddedDate = x.AddedDate.ToString("dd/MM/yyyy")
            });

            return Json(new DataTablesResponse(requestModel.Draw, data2, filteredCount, totalCount), JsonRequestBehavior.AllowGet);
        }

        public ActionResult GetPaymentVoucher(int? id)
        {
            var rec = db.Receipts.Where(m => m.RecID == id).Select(x => new
            {
                RecID = x.RecID,
                RecSerial = x.RecSerial,
                Notes = x.Notes,
                Amount = x.Amount,
                AddedDate = x.AddedDate
            }).Take(1);

            var rec2 = rec.ToList().Select(x => new
            {
                RecID = x.RecID,
                RecSerial = x.RecSerial,
                Notes = x.Notes,
                Amount = x.Amount,
                AddedDate = x.AddedDate.ToString("dd/MM/yyyy")
            }).FirstOrDefault();

            return Json(rec2, JsonRequestBehavior.AllowGet);
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult SavePaymentVoucher(ReceiptVoucherInfoVM receipt)
        {
            var r = new Receipt();
            r.RecSerial = RS.GetNextRecNo(db, "P");
            r.Notes = receipt.Notes;
            r.Amount = receipt.Amount;
            r.PatientID = null;
            r.RecType = "P";
            r.AddedBy = User.Identity.GetUserId();
            r.AddedDate = DateTime.Now;
            db.Entry(r).State = EntityState.Added;
            db.SaveChanges();
            var res = TS.AddTransction(db, null, "D", receipt.Amount, r.Notes);
            return Json("تمت إضافة البيانات بنجاح", JsonRequestBehavior.AllowGet);
        }


        
        public void PrintReceiptVoucher(int? id)
        {
            if (id == null)
                HttpNotFound();

            var receipt2 = db.Receipts.Where(m => m.RecID == id.Value).Select(x => new
            {
                x.RecSerial,
                PatientName = x.Patient.FullName,
                x.AddedDate,
                AddedBy = x.UserAddedBy.FullName,
                RecNotes = x.Notes,
                RecAmount = x.Amount
            }).ToList();

            if (receipt2 == null)
                HttpNotFound();

            var Profiles = db.Profiles.FirstOrDefault();
            var settings = db.Settings.FirstOrDefault();

            var receipts = receipt2.Select(x => new ReceiptVoucherVM
            {
                RecSerial = CommonServices.ConvertRecSerialToString(x.RecSerial),
                PatientName = x.PatientName,
                AddedDate = x.AddedDate.ToShortDateString(),
                AddedBy = x.AddedBy,
                PrintBy = (Request.Cookies["FullName"] != null ? Request.Cookies["FullName"].Value : "NULL"),
                RecNotes = x.RecNotes,
                RecAmount = x.RecAmount,
                Currency = settings.CurrencyName
            }).ToList();

            ReportViewer veiwer = new ReportViewer();
            var lr = veiwer.LocalReport;
            lr.ReportPath = Server.MapPath("~/Reports/RptReceiptVoucher.rdlc");
            lr.DataSources.Add(new ReportDataSource("ReceiptInfo", receipts));

            lr.SetParameters(new ReportParameter("ClinicName", Profiles.ClinicName));
            lr.SetParameters(new ReportParameter("ClinicAddress", Profiles.ClinicAddress));
            lr.SetParameters(new ReportParameter("ClinicContact", "هاتف : " + Profiles.ClinicTelNumber + " | موبايل : " + Profiles.ClinicPhoneNumber));

            lr.Refresh();
            Response.ContentType = "application/pdf";
            Response.BinaryWrite(lr.Render("pdf"));
        }

        public void PrintPaymentVoucher(int? id)
        {
            if (id == null)
                HttpNotFound();

            var receipt2 = db.Receipts.Where(m => m.RecID == id.Value).Select(x => new
            {
                x.RecSerial,
                PatientName = "مصاريف",
                x.AddedDate,
                AddedBy = x.UserAddedBy.FullName,
                RecNotes = x.Notes,
                RecAmount = x.Amount
            }).ToList();

            if (receipt2 == null)
                HttpNotFound();

            var Profiles = db.Profiles.FirstOrDefault();
            var settings = db.Settings.FirstOrDefault();

            var receipts = receipt2.Select(x => new ReceiptVoucherVM
            {
                RecSerial = CommonServices.ConvertRecSerialToString(x.RecSerial),
                PatientName = x.PatientName,
                AddedDate = x.AddedDate.ToShortDateString(),
                AddedBy = x.AddedBy,
                PrintBy = (Request.Cookies["FullName"] != null ? Request.Cookies["FullName"].Value : "NULL"),
                RecNotes = x.RecNotes,
                RecAmount = x.RecAmount,
                Currency = settings.CurrencyName
            }).ToList();

            ReportViewer veiwer = new ReportViewer();
            var lr = veiwer.LocalReport;
            lr.ReportPath = Server.MapPath("~/Reports/RptPaymentVoucher.rdlc");
            lr.DataSources.Add(new ReportDataSource("ReceiptInfo", receipts));

            lr.SetParameters(new ReportParameter("ClinicName", Profiles.ClinicName));
            lr.SetParameters(new ReportParameter("ClinicAddress", Profiles.ClinicAddress));
            lr.SetParameters(new ReportParameter("ClinicContact", "هاتف : " + Profiles.ClinicTelNumber + " | موبايل : " + Profiles.ClinicPhoneNumber));

            lr.Refresh();
            Response.ContentType = "application/pdf";
            Response.BinaryWrite(lr.Render("pdf"));
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