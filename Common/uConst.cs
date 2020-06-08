using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace MyClinic.Common
{
    public class uConst
    {
        public class Result
        {
            public int ID { get; set; }
            public string Desc { get; set; }
            public bool IsSuccess { get; set; }

            public Result(bool isSuccess)
            {
                IsSuccess = isSuccess;
            }

            public Result(int id, bool isSuccess)
            {
                ID = id;
                IsSuccess = isSuccess;
            }

            public Result(int id, string desc, bool isSuccess)
            {
                ID = id;
                Desc = desc;
                IsSuccess = isSuccess;
            }
        }
    }
}