using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace MyClinic.Models
{
    public class ListOfPatientVM
    {
        public int PatientId { get; set; }

        [Display(Name = "Full Name")]
        public string FullName { get; set; }

        [Display(Name = "Phone Number")]
        public string Phone { get; set; }

        [Display(Name = "Address")]
        public string Address { get; set; }

    }

    public class PatientInfoVM
    {
        public int PatientId { get; set; }

        [Display(Name = "Full Name"), Required]
        [StringLength(250)]
        public string FullName { get; set; }
        public string Address { get; set; }
        [Required]
        public string Phone { get; set; }

        public string Birthdate { get; set; }

        [Required]
        public int Gender { get; set; }
        public string Notes { get; set; }

        [Display(Name = "Doctor Name")]
        public string DoctorId { get; set; }
    }
}