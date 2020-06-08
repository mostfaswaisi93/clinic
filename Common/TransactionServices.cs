using MyClinic.Models;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Web;
using static MyClinic.Common.uConst;

namespace MyClinic.Common
{
    public class TransactionServices
    {
        public Result AddTransction(ApplicationDbContext db, int? PatientID, string TransType, int Amount, string Notes)
        {
            try
            {
                var transaction = new Transaction()
                {
                    PatientID = PatientID,
                    TransType = TransType,
                    AddedDate = DateTime.Now,
                    Amount = Amount,
                    Notes = Notes
                };
                db.Entry(transaction).State = EntityState.Added;
                db.SaveChanges();
                return new Result(transaction.TransID, true);
            }
            catch
            {
                return new Result(false);
            }
        }
    }
}