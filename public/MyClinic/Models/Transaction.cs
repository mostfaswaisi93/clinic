using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace MyClinic.Models
{
    public class Transaction
    {
        [Key]
        public int TransID { get; set; }

        public Patient Patient { get; set; }

        public int? PatientID { get; set; }

        [MaxLength(1)]
        public string TransType { get; set; }

        public int Amount { get; set; }

        public DateTime AddedDate { get; set; }

        public string Notes { get; set; }
    }
}