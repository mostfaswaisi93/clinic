using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace MyClinic.Models
{
    public class Ref
    {
        [Key]
        public int RefID { get; set; }

        public int RefTableNo { get; set; }

        public int RefTableIndex { get; set; }

        public string DescArb { get; set; }

        public string DescEng { get; set; }

    }
}