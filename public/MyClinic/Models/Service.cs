using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace MyClinic.Models
{
    public class Service
    {
        public int ServiceID { get; set; }

        [Display(Name = "Service Name"), Required]

        public string Name { get; set; }

        [Display(Name = "Service Price"), Required]

        public int Price { get; set; }

    }
}