using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace MyClinic.Common
{
    public static class CommonServices
    {
        public static string ConvertRecSerialToString(int RecSerial)
        {
            return RecSerial.ToString().PadLeft(6, '0');
        }
    }
}