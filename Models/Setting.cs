using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace MyClinic.Models
{
    public class Setting
    {
        [Key]
        public int SetID { get; set; }
        public string CurrencyName { get; set; }
        
    }
}