using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace MyClinic.Models
{

    public class Patient
    {
        [Key]
        public int PatientId { get; set; }

        [Display(Name = "Full Name"), Required]
        [StringLength(250)]
        public string FullName { get; set; }
        public string Address { get; set; }
        [Required]
        public string Phone { get; set; }
        [DataType(DataType.Date)]
        public DateTime? Birthdate { get; set; }

        public Ref Ref { get; set; }
        [ForeignKey("Ref")]
        public int Gender { get; set; }

        public string Notes { get; set; }

        public ApplicationUser Users { get; set; }
        [ForeignKey("Users")]
        public string DoctorId { get; set; }

        public ApplicationUser AddedUser { get; set; }
        [ForeignKey("AddedUser")]
        public string AddedBy { get; set; }

        public DateTime AddedDate { get; set; }

    }
}