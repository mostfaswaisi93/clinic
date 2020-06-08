namespace MyClinic.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class _in : DbMigration
    {
        public override void Up()
        {
            CreateTable(
                "dbo.Appointments",
                c => new
                    {
                        AppointmentId = c.Int(nullable: false, identity: true),
                        PatientId = c.Int(nullable: false),
                        ServiceID = c.Int(nullable: false),
                        DoctorId = c.String(maxLength: 128),
                        AppointmentDate = c.DateTime(nullable: false, storeType: "date"),
                        AppointmentTime = c.DateTime(nullable: false),
                        AppointmentNotes = c.String(),
                        DoctorNotes = c.String(),
                        AddedBy = c.String(maxLength: 128),
                        AddedDate = c.DateTime(nullable: false),
                        IsDelete = c.Boolean(nullable: false),
                        IsCancel = c.Boolean(nullable: false),
                        RequestAmount = c.Int(nullable: false),
                    })
                .PrimaryKey(t => t.AppointmentId)
                .ForeignKey("dbo.AspNetUsers", t => t.AddedBy)
                .ForeignKey("dbo.Patients", t => t.PatientId, cascadeDelete: true)
                .ForeignKey("dbo.Services", t => t.ServiceID, cascadeDelete: true)
                .ForeignKey("dbo.AspNetUsers", t => t.DoctorId)
                .Index(t => t.PatientId)
                .Index(t => t.ServiceID)
                .Index(t => t.DoctorId)
                .Index(t => t.AddedBy);
            
            CreateTable(
                "dbo.AspNetUsers",
                c => new
                    {
                        Id = c.String(nullable: false, maxLength: 128),
                        FullName = c.String(nullable: false, maxLength: 100),
                        Specialization = c.String(maxLength: 200),
                        Email = c.String(maxLength: 256),
                        EmailConfirmed = c.Boolean(nullable: false),
                        PasswordHash = c.String(),
                        SecurityStamp = c.String(),
                        PhoneNumber = c.String(),
                        PhoneNumberConfirmed = c.Boolean(nullable: false),
                        TwoFactorEnabled = c.Boolean(nullable: false),
                        LockoutEndDateUtc = c.DateTime(),
                        LockoutEnabled = c.Boolean(nullable: false),
                        AccessFailedCount = c.Int(nullable: false),
                        UserName = c.String(nullable: false, maxLength: 256),
                    })
                .PrimaryKey(t => t.Id)
                .Index(t => t.UserName, unique: true, name: "UserNameIndex");
            
            CreateTable(
                "dbo.AspNetUserClaims",
                c => new
                    {
                        Id = c.Int(nullable: false, identity: true),
                        UserId = c.String(nullable: false, maxLength: 128),
                        ClaimType = c.String(),
                        ClaimValue = c.String(),
                    })
                .PrimaryKey(t => t.Id)
                .ForeignKey("dbo.AspNetUsers", t => t.UserId, cascadeDelete: true)
                .Index(t => t.UserId);
            
            CreateTable(
                "dbo.AspNetUserLogins",
                c => new
                    {
                        LoginProvider = c.String(nullable: false, maxLength: 128),
                        ProviderKey = c.String(nullable: false, maxLength: 128),
                        UserId = c.String(nullable: false, maxLength: 128),
                    })
                .PrimaryKey(t => new { t.LoginProvider, t.ProviderKey, t.UserId })
                .ForeignKey("dbo.AspNetUsers", t => t.UserId, cascadeDelete: true)
                .Index(t => t.UserId);
            
            CreateTable(
                "dbo.AspNetUserRoles",
                c => new
                    {
                        UserId = c.String(nullable: false, maxLength: 128),
                        RoleId = c.String(nullable: false, maxLength: 128),
                    })
                .PrimaryKey(t => new { t.UserId, t.RoleId })
                .ForeignKey("dbo.AspNetUsers", t => t.UserId, cascadeDelete: true)
                .ForeignKey("dbo.AspNetRoles", t => t.RoleId, cascadeDelete: true)
                .Index(t => t.UserId)
                .Index(t => t.RoleId);
            
            CreateTable(
                "dbo.Patients",
                c => new
                    {
                        PatientId = c.Int(nullable: false, identity: true),
                        FullName = c.String(nullable: false, maxLength: 250),
                        Address = c.String(),
                        Phone = c.String(nullable: false),
                        Birthdate = c.DateTime(),
                        Gender = c.Int(nullable: false),
                        Notes = c.String(),
                        DoctorId = c.String(maxLength: 128),
                        AddedBy = c.String(maxLength: 128),
                        AddedDate = c.DateTime(nullable: false),
                    })
                .PrimaryKey(t => t.PatientId)
                .ForeignKey("dbo.AspNetUsers", t => t.AddedBy)
                .ForeignKey("dbo.Refs", t => t.Gender, cascadeDelete: true)
                .ForeignKey("dbo.AspNetUsers", t => t.DoctorId)
                .Index(t => t.Gender)
                .Index(t => t.DoctorId)
                .Index(t => t.AddedBy);
            
            CreateTable(
                "dbo.Refs",
                c => new
                    {
                        RefID = c.Int(nullable: false, identity: true),
                        RefTableNo = c.Int(nullable: false),
                        RefTableIndex = c.Int(nullable: false),
                        DescArb = c.String(),
                        DescEng = c.String(),
                    })
                .PrimaryKey(t => t.RefID);
            
            CreateTable(
                "dbo.Services",
                c => new
                    {
                        ServiceID = c.Int(nullable: false, identity: true),
                        Name = c.String(nullable: false),
                        Price = c.Int(nullable: false),
                    })
                .PrimaryKey(t => t.ServiceID);
            
            CreateTable(
                "dbo.Profiles",
                c => new
                    {
                        ProfileID = c.Int(nullable: false, identity: true),
                        ClinicName = c.String(),
                        ClinicAddress = c.String(),
                        ClinicTelNumber = c.String(),
                        ClinicPhoneNumber = c.String(),
                    })
                .PrimaryKey(t => t.ProfileID);
            
            CreateTable(
                "dbo.Receipts",
                c => new
                    {
                        RecID = c.Int(nullable: false, identity: true),
                        RecSerial = c.Int(nullable: false),
                        RecType = c.String(maxLength: 1),
                        PatientID = c.Int(),
                        Amount = c.Int(nullable: false),
                        Notes = c.String(),
                        AddedDate = c.DateTime(nullable: false),
                        AddedBy = c.String(maxLength: 128),
                    })
                .PrimaryKey(t => t.RecID)
                .ForeignKey("dbo.Patients", t => t.PatientID)
                .ForeignKey("dbo.AspNetUsers", t => t.AddedBy)
                .Index(t => new { t.RecSerial, t.RecType }, unique: true, name: "RecSerial")
                .Index(t => t.PatientID)
                .Index(t => t.AddedBy);
            
            CreateTable(
                "dbo.AspNetRoles",
                c => new
                    {
                        Id = c.String(nullable: false, maxLength: 128),
                        Name = c.String(nullable: false, maxLength: 256),
                        Discriminator = c.String(nullable: false, maxLength: 128),
                    })
                .PrimaryKey(t => t.Id)
                .Index(t => t.Name, unique: true, name: "RoleNameIndex");
            
            CreateTable(
                "dbo.Settings",
                c => new
                    {
                        SetID = c.Int(nullable: false, identity: true),
                        CurrencyName = c.String(),
                    })
                .PrimaryKey(t => t.SetID);
            
            CreateTable(
                "dbo.Transactions",
                c => new
                    {
                        TransID = c.Int(nullable: false, identity: true),
                        PatientID = c.Int(),
                        TransType = c.String(maxLength: 1),
                        Amount = c.Int(nullable: false),
                        AddedDate = c.DateTime(nullable: false),
                        Notes = c.String(),
                    })
                .PrimaryKey(t => t.TransID)
                .ForeignKey("dbo.Patients", t => t.PatientID)
                .Index(t => t.PatientID);
            
        }
        
        public override void Down()
        {
            DropForeignKey("dbo.Transactions", "PatientID", "dbo.Patients");
            DropForeignKey("dbo.AspNetUserRoles", "RoleId", "dbo.AspNetRoles");
            DropForeignKey("dbo.Receipts", "AddedBy", "dbo.AspNetUsers");
            DropForeignKey("dbo.Receipts", "PatientID", "dbo.Patients");
            DropForeignKey("dbo.Appointments", "DoctorId", "dbo.AspNetUsers");
            DropForeignKey("dbo.Appointments", "ServiceID", "dbo.Services");
            DropForeignKey("dbo.Appointments", "PatientId", "dbo.Patients");
            DropForeignKey("dbo.Patients", "DoctorId", "dbo.AspNetUsers");
            DropForeignKey("dbo.Patients", "Gender", "dbo.Refs");
            DropForeignKey("dbo.Patients", "AddedBy", "dbo.AspNetUsers");
            DropForeignKey("dbo.Appointments", "AddedBy", "dbo.AspNetUsers");
            DropForeignKey("dbo.AspNetUserRoles", "UserId", "dbo.AspNetUsers");
            DropForeignKey("dbo.AspNetUserLogins", "UserId", "dbo.AspNetUsers");
            DropForeignKey("dbo.AspNetUserClaims", "UserId", "dbo.AspNetUsers");
            DropIndex("dbo.Transactions", new[] { "PatientID" });
            DropIndex("dbo.AspNetRoles", "RoleNameIndex");
            DropIndex("dbo.Receipts", new[] { "AddedBy" });
            DropIndex("dbo.Receipts", new[] { "PatientID" });
            DropIndex("dbo.Receipts", "RecSerial");
            DropIndex("dbo.Patients", new[] { "AddedBy" });
            DropIndex("dbo.Patients", new[] { "DoctorId" });
            DropIndex("dbo.Patients", new[] { "Gender" });
            DropIndex("dbo.AspNetUserRoles", new[] { "RoleId" });
            DropIndex("dbo.AspNetUserRoles", new[] { "UserId" });
            DropIndex("dbo.AspNetUserLogins", new[] { "UserId" });
            DropIndex("dbo.AspNetUserClaims", new[] { "UserId" });
            DropIndex("dbo.AspNetUsers", "UserNameIndex");
            DropIndex("dbo.Appointments", new[] { "AddedBy" });
            DropIndex("dbo.Appointments", new[] { "DoctorId" });
            DropIndex("dbo.Appointments", new[] { "ServiceID" });
            DropIndex("dbo.Appointments", new[] { "PatientId" });
            DropTable("dbo.Transactions");
            DropTable("dbo.Settings");
            DropTable("dbo.AspNetRoles");
            DropTable("dbo.Receipts");
            DropTable("dbo.Profiles");
            DropTable("dbo.Services");
            DropTable("dbo.Refs");
            DropTable("dbo.Patients");
            DropTable("dbo.AspNetUserRoles");
            DropTable("dbo.AspNetUserLogins");
            DropTable("dbo.AspNetUserClaims");
            DropTable("dbo.AspNetUsers");
            DropTable("dbo.Appointments");
        }
    }
}
