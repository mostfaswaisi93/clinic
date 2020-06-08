using MyClinic.Models;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Web;
using static MyClinic.Common.uConst;

namespace MyClinic.Common
{
    public class ReceiptServices
    {
        public Result AddReceipt(ApplicationDbContext db, string recType, int patientID, int amount, string notes, string addedBy)
        {
            try
            {
                var receipt = new Receipt()
                {
                    RecType = recType,
                    RecSerial = GetNextRecNo(db, recType),
                    PatientID = patientID,
                    Amount = amount,
                    Notes = notes,
                    AddedBy = addedBy,
                    AddedDate = DateTime.Now
                };
                db.Entry(receipt).State = EntityState.Added;
                db.SaveChanges();
                return new Result(receipt.RecID, true);
            }
            catch (Exception e)
            {
                return new Result(false);
            }
        }

        public int GetNextRecNo(ApplicationDbContext db, string recType)
        {
            var rec = db.Receipts.Where(m => m.RecType == recType).Select(x => x.RecSerial).DefaultIfEmpty(0).Max();
            return rec + 1;
        }
    }
}