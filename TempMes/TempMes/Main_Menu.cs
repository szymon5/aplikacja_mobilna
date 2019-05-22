using System;
using System.Threading;
using Android.App;
using Android.Content;
using Android.OS;
using Android.Runtime;
using Android.Support.Design.Widget;
using Android.Support.V7.App;
using Android.Views;
using Android.Widget;

namespace TempMes
{
    [Activity(Label = "@string/app_name", Theme = "@style/AppTheme.NoActionBar", MainLauncher = true)]
    public class Main_Menu : AppCompatActivity
    {
        private Button login;
        private Button createAcc;
        private Button exit;
        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);
            Xamarin.Essentials.Platform.Init(this, savedInstanceState);
            SetContentView(Resource.Layout.main_menu);

            login = FindViewById<Button>(Resource.Id.btnLogin);
            createAcc = FindViewById<Button>(Resource.Id.btnCreateAccount);
            exit = FindViewById<Button>(Resource.Id.btnExit);

            login.Click += (s, e) =>
            {
                FragmentTransaction fragment = FragmentManager.BeginTransaction();
                LoginDialog loginDialog = new LoginDialog();
                loginDialog.Show(fragment, "loginDialog");
                loginDialog.OnLoginComplete += LoginDialog_OnLoginComplete;
            };
            createAcc.Click += (s, e) =>
            {
                FragmentTransaction fragment = FragmentManager.BeginTransaction();
                CreateAccountDialog createAccountDialog = new CreateAccountDialog();
                createAccountDialog.OnCreateAccountComplete += CreateAccountDialog_OnCreateAccountComplete;
                createAccountDialog.Show(fragment, "createAccountDialog");
            };
            exit.Click += (s, e) =>
            {
                System.Environment.Exit(0);
            };
        }
        private void CreateAccountDialog_OnCreateAccountComplete(object sender, OnCreateAccountEventArgs e)
        {
            Toast.MakeText(this, "Account Created Successfully", ToastLength.Short).Show();
        }

        private void LoginDialog_OnLoginComplete(object sender, OnLoginDialogEventArgs e)
        {
            if (StatusReader.log_status == "online")
            {
                Intent nextActivity = new Intent(this, typeof(userAccount));
                StartActivity(nextActivity);
            }
            else
            {
                Toast.MakeText(this, "Login Failed", ToastLength.Short).Show();
            }
        }

        public override bool OnCreateOptionsMenu(IMenu menu)
        {
            MenuInflater.Inflate(Resource.Menu.menu_main, menu);
            return true;
        }

        public override bool OnOptionsItemSelected(IMenuItem item)
        {
            int id = item.ItemId;
            if (id == Resource.Id.action_settings)
            {
                return true;
            }

            return base.OnOptionsItemSelected(item);
        }

        private void FabOnClick(object sender, EventArgs eventArgs)
        {
            View view = (View) sender;
            Snackbar.Make(view, "Replace with your own action", Snackbar.LengthLong)
                .SetAction("Action", (Android.Views.View.IOnClickListener)null).Show();
        }
        public override void OnRequestPermissionsResult(int requestCode, string[] permissions, [GeneratedEnum] Android.Content.PM.Permission[] grantResults)
        {
            Xamarin.Essentials.Platform.OnRequestPermissionsResult(requestCode, permissions, grantResults);

            base.OnRequestPermissionsResult(requestCode, permissions, grantResults);
        }
	}
}

