using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Android.App;
using Android.Content;
using Android.OS;
using Android.Runtime;
using Android.Views;
using Android.Widget;

namespace TempMes
{
    public class StatusReader
    {
        public string u_status { get; set; }
        public string u_email { get; set; }
        public static string log_status;
    }
}