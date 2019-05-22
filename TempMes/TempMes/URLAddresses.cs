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
    public static class URLAddresses
    {
        public static readonly string CREATE_ACCOUNT_PHP = "http://szymi05.nazwa.pl/mobile/CreateAccount.php";
        public static readonly string LOGIN_PHP = "http://szymi05.nazwa.pl/mobile/login.php";
        public static readonly string GET_STATUS_TO_LOGIN = "http://szymi05.nazwa.pl/mobile/getUserStatus.php";
    }
}