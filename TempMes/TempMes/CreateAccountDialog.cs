using System;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading;
using Android.App;
using Android.Content;
using Android.OS;
using Android.Runtime;
using Android.Views;
using Android.Widget;

namespace TempMes
{
    public class OnCreateAccountEventArgs : EventArgs
    {
        public string nick, login, password, email;
        public OnCreateAccountEventArgs() { }
        public OnCreateAccountEventArgs(string nick,string login,string password,string email)
        {
            this.nick = nick;
            this.login = login;
            this.password = password;
            this.email = email;
        }
    }
    public class CreateAccountDialog : DialogFragment
    {
        private EditText nick, login, password, email;
        private Button createAcc;
        public event EventHandler<OnCreateAccountEventArgs> OnCreateAccountComplete;

        public override View OnCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState)
        {
            base.OnCreateView(inflater, container, savedInstanceState);

            var view = inflater.Inflate(Resource.Layout.CreateAccountDialog,container,false);

            nick = view.FindViewById<EditText>(Resource.Id.etDialog_CNick);
            login = view.FindViewById<EditText>(Resource.Id.etDialog_CLogin);
            password = view.FindViewById<EditText>(Resource.Id.etDialog_CPassword);
            email = view.FindViewById<EditText>(Resource.Id.etDialog_CEmail);
            createAcc = view.FindViewById<Button>(Resource.Id.btnDialogCreateAccount);

            createAcc.Click += CreateAcc_Click;


            return view;
        }

        private void CreateAcc_Click(object sender, EventArgs e)
        {
            WebClient client = new WebClient();
            Uri uri = new Uri(URLAddresses.CREATE_ACCOUNT_PHP);
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("Nick", nick.Text);
            parameters.Add("Login", login.Text);
            parameters.Add("Password", password.Text);
            parameters.Add("Email", email.Text);
            client.UploadValuesCompleted += Client_UploadValuesCompleted;
            client.UploadValuesAsync(uri, parameters);
            
        }

        private void Client_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            if(OnCreateAccountComplete != null)
            {
                OnCreateAccountComplete.Invoke(this, new OnCreateAccountEventArgs());
            }
            this.Dismiss();
        }
    }
}