using System;
using System.Collections.Generic;
using BCrypt.Net;
using MySql.Data.MySqlClient;

namespace ConsoleBackend
{
    public static class UserService
    {
        // ------------------- SignUp -------------------
        public static Response SignUp(Request req)
        {
            try
            {
                using (var conn = Database.GetConnection())
                {
                    conn.Open();
                    var checkCmd = new MySqlCommand("SELECT COUNT(*) FROM users WHERE email=@email", conn);
                    checkCmd.Parameters.AddWithValue("@email", req.email);
                    int exists = Convert.ToInt32(checkCmd.ExecuteScalar());

                    if (exists > 0)
                        return new Response { Status = "error", Message = "Email address already exists" };

                    string hashed = BCrypt.Net.BCrypt.HashPassword(req.password);

                    var cmd = new MySqlCommand(
                        "INSERT INTO users (first_name, last_name, username, email, phone, password, reg_date) " +
                        "VALUES (@first_name, @last_name, @username, @email, @phone, @password, NOW())",
                        conn
                    );

                    cmd.Parameters.AddWithValue("@first_name", req.first_name);
                    cmd.Parameters.AddWithValue("@last_name", req.last_name);
                    cmd.Parameters.AddWithValue("@username", req.username);
                    cmd.Parameters.AddWithValue("@phone", req.phone);
                    cmd.Parameters.AddWithValue("@email", req.email);
                    cmd.Parameters.AddWithValue("@password", hashed);
                    cmd.ExecuteNonQuery();

                    return new Response { Status = "success", Message = "Registration successful" };
                }
            }
            catch (Exception ex)
            {
                return new Response { Status = "error", Message = ex.Message };
            }
        }

        // ------------------- LOGIN -------------------
        public static Response Login(Request req)
        {
            try
            {
                using (var conn = Database.GetConnection())
                {
                    conn.Open();
                    var cmd = new MySqlCommand(
                        "SELECT id, email, password, role FROM users WHERE email=@email",
                        conn
                    );

                    cmd.Parameters.AddWithValue("@email", req.email);
                    var reader = cmd.ExecuteReader();

                    if (!reader.Read())
                        return new Response { Status = "error", Message = "User not found" };

                    string storedHash = reader.GetString("password");

                    if (!BCrypt.Net.BCrypt.Verify(req.password, storedHash))
                        return new Response { Status = "error", Message = "Incorrect password" };

                    return new Response
                    {
                        Status = "success",
                        Message = "Login successful",
                        User = new UserData
                        {
                            id = reader.GetInt32("id"),
                            email = reader.GetString("email"),
                            role = reader.GetString("role")
                        }
                    };
                }
            }
            catch (Exception ex)
            {
                return new Response { Status = "error", Message = ex.Message };
            }
        }

    }
}
