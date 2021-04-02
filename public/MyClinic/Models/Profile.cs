using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace MyClinic.Models
{
    public class Profile
    {
        [Key]
        public int ProfileID { get; set; }

        public string ClinicName { get; set; }

        public string ClinicAddress { get; set; }

        public string ClinicTelNumber { get; set; }

        public string ClinicPhoneNumber { get; set; }
    }
}