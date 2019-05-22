using System;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.Linq;
using System.Net;
using System.Text;

using Android.App;
using Android.Content;
using Android.OS;
using Android.Runtime;
using Android.Views;
using Android.Widget;
using Newtonsoft.Json;

namespace TempMes
{
    public class OnLoginDialogEventArgs : EventArgs
    {
        public string login;
        public string password;

        public OnLoginDialogEventArgs(string login,string password)
        {
            this.login = login;
            this.password = password;
        }
    }
    public class LoginDialog : DialogFragment
    {
        private EditText etlogin;
        private EditText etpassword;
        private Button btnlogin;
        private List<StatusReader> statusReader;

        public event EventHandler<OnLoginDialogEventArgs> OnLoginComplete;

        public override View OnCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState)
        {
            base.OnCreateView(inflater, container, savedInstanceState);

            var view = inflater.Inflate(Resource.Layout.LoginDialog, container, false);

            etlogin = view.FindViewById<EditText>(Resource.Id.etDialogLogin);
            etpassword = view.FindViewById<EditText>(Resource.Id.etDialogPassword);
            btnlogin = view.FindViewById<Button>(Resource.Id.btnDialogLogin);
            

            btnlogin.Click += (s, e) =>
            {
                WebClient webClient = new WebClient();
                Uri uri = new Uri(URLAddresses.LOGIN_PHP);
                NameValueCollection parameters = new NameValueCollection();
                parameters.Add("user_login", etlogin.Text);
                parameters.Add("user_password", etpassword.Text);
                webClient.UploadValuesAsync(uri, parameters);
                webClient.UploadValuesCompleted += WebClient_UploadValuesCompleted;
            };
            return view;
        }

        private void WebClient_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            WebClient client = new WebClient();
            Uri _uri = new Uri(URLAddresses.GET_STATUS_TO_LOGIN);
            client.DownloadDataAsync(_uri);
            client.DownloadDataCompleted += Client_DownloadDataCompleted;
        }

        private void Client_DownloadDataCompleted(object sender, DownloadDataCompletedEventArgs e)
        {
            string json = Encoding.UTF8.GetString(e.Result);
            statusReader = JsonConvert.DeserializeObject<List<StatusReader>>(json);
            StatusReader.log_status = statusReader[0].u_status;
            OnLoginComplete.Invoke(this, new OnLoginDialogEventArgs(etlogin.Text, etpassword.Text));
        }
    }
}