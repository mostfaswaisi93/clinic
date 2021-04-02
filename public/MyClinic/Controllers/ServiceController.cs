using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using DataTables.Mvc;
using MyClinic.Models;
using System.Linq.Dynamic;

namespace MyClinic.Controllers
{
    [Authorize]
    public class ServiceController : Controller
    {
        private ApplicationDbContext db = new ApplicationDbContext();

        // GET: Service
        public ActionResult Index()
        {
            return View(db.Services.ToList());
        }

        public ActionResult Get([ModelBinder(typeof(DataTablesBinder))] IDataTablesRequest requestModel)
        {
            IQueryable<Service> query = db.Services;
            var totalCount = query.Count();

            #region Filtering 

            // Apply filters for searching 
            if (requestModel.Search.Value.Length > 0)
            {
                var value = requestModel.Search.Value.Trim();
                query = query.Where(p => p.Name.Contains(value));
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

            query = query.OrderBy(orderByString == string.Empty ? "Name asc" : orderByString);

            #endregion Sorting 


            // Paging 
            query = query.Skip(requestModel.Start).Take(requestModel.Length);


            var data = query.Select(a => new
            {
                ServiceID = a.ServiceID,
                Name = a.Name,
                Price = a.Price
            }).ToList();

            return Json(new DataTablesResponse(requestModel.Draw, data, filteredCount, totalCount), JsonRequestBehavior.AllowGet);
        }

        // GET: Service/Details/5
        public ActionResult GetService(int? id)
        {
            var service = db.Services.Where(m => m.ServiceID == id).ToList().Select(s => new
            {
                s.ServiceID,
                s.Name,
                s.Price
            }).FirstOrDefault();

            return Json(service, JsonRequestBehavior.AllowGet);
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult SaveService(Service service)
        {
            if (service.ServiceID != 0)
            {
                var p = db.Services.Find(service.ServiceID);
                p.Name = service.Name;
                p.Price = service.Price;
                db.Entry(p).State = EntityState.Modified;
                db.SaveChanges();
                return Json("تم تعديل البيانات بنجاح", JsonRequestBehavior.AllowGet);
            }
            else
            {
                var p = new Service();
                p.Name = service.Name;
                p.Price = service.Price;
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
