using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace MyClinic.Models
{
    public class ListOfReceiptVoucherVM
    {
        public int RecID { get; set; }
        public int RecSerial { get; set; }
        public string PatientName { get; set; }
        public string Notes { get; set; }
        public int Amount { get; set; }
        public string AddedDate { get; set; }
    }

    public class ReceiptVoucherInfoVM
    {
        public int RecID { get; set; }

        [Display(Name = "Patient Name")]
        public int PatientId { get; set; }

        [Display(Name = "Amount")]
        public int Amount { get; set; }

        [Display(Name = "Notes")]
        public string Notes { get; set; }
    }

    public class ListOfPaymentVoucherVM
    {
        public int RecID { get; set; }
        public int RecSerial { get; set; }
        public string Notes { get; set; }
        public int Amount { get; set; }
        public string AddedDate { get; set; }
    }

    public class PaymentVoucherInfoVM
    {
        public int RecID { get; set; }

        [Display(Name = "Amount")]
        public int Amount { get; set; }

        [Display(Name = "Notes")]
        public string Notes { get; set; }
    }

    public class ReceiptVoucherVM
    {
        public string RecSerial { get; set; }
        public string PatientName { get; set; }
        public string AddedDate { get; set; }
        public string AddedBy { get; set; }
        public string PrintBy { get; set; }
        public string RecNotes { get; set; }
        public int RecAmount { get; set; }
        public string Currency { get; set; }
    }
}