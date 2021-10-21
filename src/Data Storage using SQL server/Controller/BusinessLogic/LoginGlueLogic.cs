using Data_Storage_using_SQL_server.Model.DAL;
using System;

namespace Data_Storage_using_SQL_server.Controller.BusinessLogic
{
    public class HomeBusinessLogic
    {
        public static void SaveInfo(string fullname)
        {
            try
            {
                // Query.
                string query = "INSERT INTO [Users] ([ID], [LAST_NAME], [FIRST_NAME], [Department], [Approval_Group])" +
                                " Values (1, '" + fullname + "', 'Jason', 835, 1)";

                // Execute.
                DAL.executeQuery(query);
            }
            catch (Exception ex)
            {
                throw ex;
            }
        }
        public static string returnPasswordHash(string login)
        {
            try
            {
                string query = "SELECT [Pwd_Hash] FROM Users WHERE LoginID = '" + login + "';";
                return(DAL.executeQuery(query));

            }
            catch (Exception ex)
            {
                throw ex;
            }
        }
    }
}