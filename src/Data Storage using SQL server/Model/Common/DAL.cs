using System;
using System.Data;
using System.Data.SqlClient;

namespace Data_Storage_using_SQL_server.Model.DAL
{
    public class DAL
    {
        private static string varResults;
        public static String executeQuery(string query)
        {
            // Initialization.
            int rowCount = 0;
            string strConn = 
                "Server=MSEDGEWIN10;" +
                "Initial Catalog=ERP;" + 
                "User id=RCON;" +
                "Password=Password;";
            SqlConnection sqlConnection = new SqlConnection(strConn);
            SqlCommand sqlCommand = new SqlCommand();

            try
            {
                // Settings.
                sqlCommand.CommandText = query;
                sqlCommand.CommandType = CommandType.Text;
                sqlCommand.Connection = sqlConnection;
                sqlCommand.CommandTimeout = 12 * 3600; //// Setting timeeout for longer queries to 12 hours.

                // Open.
                sqlConnection.Open();

                // Result.
                rowCount = sqlCommand.ExecuteNonQuery();
                varResults = (String)sqlCommand.ExecuteScalar();

                // Close.
                sqlConnection.Close();
            }
            catch (Exception ex)
            {
                // Close.
                sqlConnection.Close();

                throw ex;
            }

            return varResults ;
        }
    }
}
