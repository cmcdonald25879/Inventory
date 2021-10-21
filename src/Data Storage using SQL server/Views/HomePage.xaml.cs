using System;
using System.Windows;
using System.Windows.Controls;
using Data_Storage_using_SQL_server.Controller.BusinessLogic;

namespace Data_Storage_using_SQL_server.Views
{
    /// <summary>
    /// Interaction logic for HomePage.xaml
    /// </summary>
    public partial class HomePage : Page
    {
        public HomePage()
        {
            InitializeComponent();
        }

        private void btnExecute_Click(object sender, RoutedEventArgs e)
        {
            try
            {
                // Initialization.
                string varLoginID = this.txt_Login.Text;

                // Verification.
                if (string.IsNullOrEmpty(varLoginID))
                {
                    // Display Message
                    MessageBox.Show("This field can not be empty. Please Enter Full Name", "Fail", MessageBoxButton.OK, MessageBoxImage.Error);

                    // Info
                    return;
                }

                // Save Info.
                string varPasswordInput = this.txt_Password.Text;
                if (String.Equals(HomeBusinessLogic.returnPasswordHash(varLoginID), varPasswordInput))
                {
                    MessageBox.Show("Login Successful", "Login Prompt", MessageBoxButton.OK, MessageBoxImage.Information);
                }
                else
                {
                    MessageBox.Show("Login Failed", "Login Prompt", MessageBoxButton.OK, MessageBoxImage.Information);
                }
            }
            catch (Exception ex)
            {
                Console.Write(ex);

                // Display Message
                
            }
        }
    }
}
