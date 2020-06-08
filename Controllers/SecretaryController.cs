using DataTables.Mvc;
using Microsoft.AspNet.Identity.Owin;
using MyClinic.Models;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Threading.Tasks;
using System.Web;
using System.Web.Mvc;
using System.Linq.Dynamic;

namespace MyClinic.Controllers
{
    [Authorize]
    public class SecretaryController : Controller
    {
        private ApplicationUserManager _userManager;
        private ApplicationRoleManager _roleManager;
        private ApplicationDbContext db = new ApplicationDbContext();

        public SecretaryController()
        {
        }

        public SecretaryController(ApplicationUserManager userManager, ApplicationRoleManager roleManager)
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
        public ActionResult Get([ModelBinder(typeof(DataTablesBinder))] IDataTablesRequest requestModel)
        {
            IQueryable<ApplicationUser> query = db.Users.Where(m => m.Roles.Any(r => r.RoleId == "2"));
            var totalCount = query.Count();

            #region Filtering 

            // Apply filters for searching 
            if (requestModel.Search.Value.Length > 0)
            {
                var value = requestModel.Search.Value.Trim();
                query = query.Where(p => p.FullName.Contains(value) ||
                                         p.UserName.Contains(value));
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
            }).ToList();

            return Json(new DataTablesResponse(requestModel.Draw, data, filteredCount, totalCount), JsonRequestBehavior.AllowGet);
        }


        public ActionResult Index()
        {
            var d = db.Users.Where(m => m.Roles.Any(r => r.RoleId == "2")).Select(x => new ListOfSecretaryVM
            {
                UserId = x.Id,
                FullName = x.FullName,
                UserName = x.UserName,
            });
            return View(d);
        }

        public ActionResult AddSecretary()
        {
            return View();
        }
        public ActionResult GetSecretary(string id)
        {
            var secretary = db.Users.Where(m => m.Id == id).ToList().Select(s => new
            {
                s.Id,
                s.FullName,
                s.UserName,
            }).FirstOrDefault();

            return Json(secretary, JsonRequestBehavior.AllowGet);
        }


        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<ActionResult> SaveSecretaryAsync(SecretaryInfoVM model)
        {
            if (model.Password == model.ConfirmPassword)
            {
                if (!string.IsNullOrEmpty(model.UserId))
                {
                    var p = db.Users.Find(model.UserId);
                    p.FullName = model.FullName;
                    p.UserName = model.UserName;
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
                    };

                    var result = await UserManager.CreateAsync(user, model.Password);
                    if (result.Succeeded)
                    {
                        result = await UserManager.AddToRoleAsync(user.Id, "Secretary");
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

        public ActionResult SaveSecretary(SecretaryInfoVM secretary)
        {
            if (string.IsNullOrEmpty(secretary.UserId))
            {
                var p = db.Users.Find(secretary.UserId);
                p.FullName = secretary.FullName;
                p.UserName = secretary.UserName;
                db.Entry(p).State = EntityState.Modified;
                db.SaveChanges();
                return Json("تم تعديل البيانات بنجاح", JsonRequestBehavior.AllowGet);
            }
            else
            {
                var p = new SecretaryInfoVM();
                p.FullName = secretary.FullName;
                p.UserName = secretary.UserName;
                db.Entry(p).State = EntityState.Added;
                db.SaveChanges();
                return Json("تمت إضافة البيانات بنجاح", JsonRequestBehavior.AllowGet);
            }
        }

        public async Task<ActionResult> AddSecretary(AddSecretaryVM model)
        {
            if (ModelState.IsValid)
            {
                var user = new ApplicationUser
                {
                    UserName = model.UserName,
                    Email = model.UserName,
                    FullName = model.FullName,
                };

                var result = await UserManager.CreateAsync(user, model.Password);
                if (result.Succeeded)
                {
                    result = await UserManager.AddToRoleAsync(user.Id, "Secretary");
                    return RedirectToAction("Index");
                }
            }
            return View(model);
        }
    }

}