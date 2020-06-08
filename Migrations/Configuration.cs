namespace MyClinic.Migrations
{
    using Microsoft.AspNet.Identity;
    using Microsoft.AspNet.Identity.EntityFramework;
    using Models;
    using System;
    using System.Collections.Generic;
    using System.Data.Entity;
    using System.Data.Entity.Migrations;
    using System.Linq;

    internal sealed class Configuration : DbMigrationsConfiguration<MyClinic.Models.ApplicationDbContext>
    {
        public Configuration()
        {
            AutomaticMigrationsEnabled = false;
        }

        protected override void Seed(MyClinic.Models.ApplicationDbContext context)
        {
            //  This method will be called after migrating to the latest version.

            var refs = new List<Ref>
                {
                    new Ref{ RefID = 1, RefTableIndex = 0, RefTableNo = 1,  DescArb = "== «·Ã‰” ==", DescEng = "== Gender ==" },
                    new Ref { RefID = 2, RefTableIndex = 1, RefTableNo = 1, DescArb = "–ﬂ—", DescEng = "Male" },
                    new Ref { RefID = 3, RefTableIndex = 2, RefTableNo = 1, DescArb = "√‰ÀÏ", DescEng = "Female" },
                };
            refs.ForEach(s => context.Refs.AddOrUpdate(s));
            context.SaveChanges();

            var profile = new Profile
            {
                ProfileID = 1,
                ClinicName = "⁄Ì«œ… ›Ì“ÌÊ › ",
                ClinicAddress = "‘«—⁄ «·‰’— - „ﬁ«»· ” »”",
                ClinicPhoneNumber = "0599123123 - 0569123123",
                ClinicTelNumber = "082814141"
            };
            context.Profiles.AddOrUpdate(profile);
            context.SaveChanges();


            var setting = new Setting
            {
                SetID = 1,
                CurrencyName = "‘Ìﬂ·"
            };
            context.Settings.AddOrUpdate(setting);
            context.SaveChanges();

            var manager = new UserManager<ApplicationUser>(new UserStore<ApplicationUser>(new ApplicationDbContext()));
            var roleManager = new RoleManager<IdentityRole>(new RoleStore<IdentityRole>(new ApplicationDbContext()));

            if (context.Users.Count() == 0)
            {
                var user = new ApplicationUser()
                {
                    UserName = "admin",
                    Email = "admin@admin.com",
                    EmailConfirmed = true,
                    FullName = "admin"
                };
                manager.Create(user, "Administrator");

                if (roleManager.Roles.Count() == 0)
                {
                    roleManager.Create(new IdentityRole { Id = "1", Name = "Doctor" });
                    roleManager.Create(new IdentityRole { Id = "2", Name = "Secretary" });
                }

                var adminUser = manager.FindByName("admin");
                manager.AddToRoles(adminUser.Id, new string[] { "Doctor" });
            }
            else
            {
                var user = new ApplicationUser()
                {
                    UserName = "secretary",
                    Email = "secretary@secretary.com",
                    EmailConfirmed = true,
                    FullName = "secretary"
                };
                manager.Create(user, "secretary");

                if (roleManager.Roles.Count() == 0)
                {
                    roleManager.Create(new IdentityRole { Id = "1", Name = "Doctor" });
                    roleManager.Create(new IdentityRole { Id = "2", Name = "Secretary" });
                }

                var adminUser = manager.FindByName("secretary");
                manager.AddToRoles(adminUser.Id, new string[] { "Secretary" });
            }

        }
    }
}
