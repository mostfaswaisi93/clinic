using DataTables.Mvc;
using Microsoft.AspNet.Identity.Owin;
using MyClinic.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using System.Web;
using System.Web.Mvc;
using System.Linq.Dynamic;
using System.Data.Entity;

namespace MyClinic.Controllers
{
    [Authorize]
    public class DoctorController : Controller
    {
        private ApplicationUserManager _userManager;
        private ApplicationRoleManager _roleManager;
        private ApplicationDbContext db = new ApplicationDbContext();

        public DoctorController()
        {
        }

        public DoctorController(ApplicationUserManager userManager,ApplicationRoleManager roleManager)
        {
            UserManager = userManager;
            RoleManager = roleManager;
        }

        public ApplicationRoleManager RoleManager
        {
            get
            {
                return _roleManager ?? HttpContext.GetOwinContext().Get<ApplicationRoleManager>();
            }
            private set
            {
                _roleManager = value;
            }
        }

        public ApplicationUserManager UserManager
        {
            get
            {
                return _userManager ?? HttpContext.GetOwinContext().GetUserManager<ApplicationUserManager>();
            }
            private set
            {
                _userManager = value;
            }
        }

        public ActionResult Index()
        {
            var d = db.Users.Where(m => m.Roles.Any(r => r.RoleId == "1")).Select(x => new ListOfDoctorVM
            {
                UserId = x.Id,
                FullName = x.FullName,
                UserName = x.UserName,
                Specialization = x.Specialization
            });
            return View(d);
        }

        public ActionResult AddDoctor()
        {
            return View();
        }
        public ActionResult Get([ModelBinder(typeof(DataTablesBinder))] IDataTablesRequest requestModel)
        {
            IQueryable<ApplicationUser> query = db.Users.Where(m => m.Roles.Any(r => r.RoleId == "1"));
            var totalCount = query.Count();

            #region Filtering 

            // Apply filters for searching 
            if (requestModel.Search.Value.Length > 0)
            {
                var value = requestModel.Search.Value.Trim();
                query = query.Where(p => p.FullName.Contains(value) ||
                                         p.UserName.Contains(value) ||
                                         p.Specialization.Contains(value));
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
                UserId = a.Id,
                FullName = a.FullName,
                UserName = a.UserName,
                Specialization = a.Specialization

            }).ToList();

            return Json(new DataTablesResponse(requestModel.Draw, data, filteredCount, totalCount), JsonRequestBehavior.AllowGet);
        }
        public ActionResult GetDoctor(string id)
        {
            var doctor = db.Users.Where(m => m.Id == id).ToList().Select(s => new
            {
                s.Id,
                s.FullName,
                s.UserName,
                s.Specialization
            }).FirstOrDefault();

            return Json(doctor, JsonRequestBehavior.AllowGet);
        }



        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<ActionResult> SaveDoctorAsync(DoctorInfoVM model)
        {
            if (model.Password == model.ConfirmPassword)
            {
                if (!string.IsNullOrEmpty(model.UserId))
                {
                    var p = db.Users.Find(model.UserId);
                    p.FullName = model.FullName;
                    p.UserName = model.UserName;
                    p.Specialization = model.Specialization;
                    db.Entry(p).State = EntityState.Modified;
                    db.SaveChanges();
                    return Json("تم تعديل البيانات بنجاح", JsonRequestBehavior.AllowGet);
                }
                else
                {
                    var user = new ApplicationUser
                    {
                        UserName = model.UserName,
                        Email = model.UserName,
                        FullName = model.FullName,
                        Specialization = model.Specialization
                    };

                    var result = await UserManager.CreateAsync(user, model.Password);
                    if (result.Succeeded)
                    {
                        var result1 = await UserManager.AddToRoleAsync(user.Id, "Doctor");
                        return Json("تمت إضافة البيانات بنجاح", JsonRequestBehavior.AllowGet);
                    }
                    else
                    {
                        return Json("حدث خطأ أثناء إضافة البيانات", JsonRequestBehavior.AllowGet);
                    }
                }
            }
            else
            {
                return Json("كلمتي المرور غير متطابقتين", JsonRequestBehavior.AllowGet);
            }

        }
        public async Task<ActionResult> AddDoctor(AddDoctorVM model)
        {
            if (ModelState.IsValid)
            {
                var user = new ApplicationUser
                {
                    UserName = model.UserName,
                    Email = model.UserName,
                    FullName = model.FullName,
                    Specialization = model.Specialization
                };

                var result = await UserManager.CreateAsync(user, model.Password);
                if (result.Succeeded)
                {
                    result = await UserManager.AddToRoleAsync(user.Id, "Doctor");
                    return RedirectToAction("Index");
                }
            }
            return View(model);
        }
    }
}