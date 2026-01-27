using MySql.Data.MySqlClient;

namespace ConsoleBackend
{
    public static class Database
    {
        private static string connectionString = "server=localhost;user=root;password=;database=RolsaTechnologies;";

        public static MySqlConnection GetConnection()
        {
            var conn = new MySqlConnection(connectionString);
            return conn;
        }
    }
}
