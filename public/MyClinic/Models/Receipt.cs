using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace MyClinic.Models
{
    public class Receipt
    {
        [Key]
        public int RecID { get; set; }

        [Index("RecSerial", IsUnique = true, Order = 1)]
        public int RecSerial { get; set; }

        [MaxLength(1)]
        [Index("RecSerial", IsUnique = true, Order = 2)]
        public string RecType { get; set; }

        public int? PatientID { get; set; }

        public Patient Patient { get; set; }

        public int Amount { get; set; }

        public string Notes { get; set; }

        public DateTime AddedDate { get; set; }

        public ApplicationUser UserAddedBy { get; set; }
        [ForeignKey("UserAddedBy")]
        public string AddedBy { get; set; }
    }
}