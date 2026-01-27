using ConsoleBackend;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;

public static class AdminService
{
    private static readonly string[] AllowedTables = { "users", "products", "schedules", "energy_usage", "carbon_usage" };

    private static bool IsValidTable(string table)
    {
        return AllowedTables.Contains(table.ToLower());
    }

    public static Response ListTables()
    {
        var tables = new List<string>();

        using (var conn = Database.GetConnection())
        {
            conn.Open();
            var cmd = new MySqlCommand("SHOW TABLES", conn);
            using (var reader = cmd.ExecuteReader())
            {
                while (reader.Read())
                {
                    tables.Add(reader.GetString(0));
                }
            }
        }

        return new Response
        {
            Status = "success",
            Tables = tables
        };
    }

    public static Response DescribeTable(string table)
    {
        if (!IsValidTable(table))
        {
            return new Response { Status = "error", Message = "Invalid table name" };
        }

        var columns = new List<Dictionary<string, string>>();

        using (var conn = Database.GetConnection())
        {
            conn.Open();
            var cmd = new MySqlCommand($"DESCRIBE `{table}`", conn);
            using (var reader = cmd.ExecuteReader())
            {
                while (reader.Read())
                {
                    columns.Add(new Dictionary<string, string>
                    {
                        { "Field", reader["Field"].ToString() },
                        { "Type", reader["Type"].ToString() },
                        { "Key", reader["Key"].ToString() }
                    });
                }
            }
        }

        return new Response
        {
            Status = "success",
            Columns = columns
        };
    }

    public static Response SelectAll(string table)
    {
        if (!IsValidTable(table))
        {
            return new Response { Status = "error", Message = "Invalid table name" };
        }

        var rows = new List<Dictionary<string, object>>();

        using (var conn = Database.GetConnection())
        {
            conn.Open();
            var cmd = new MySqlCommand($"SELECT * FROM `{table}`", conn);
            using (var reader = cmd.ExecuteReader())
            {
                while (reader.Read())
                {
                    var row = new Dictionary<string, object>();
                    for (int i = 0; i < reader.FieldCount; i++)
                    {
                        row[reader.GetName(i)] = reader.GetValue(i);
                    }
                    rows.Add(row);
                }
            }
        }

        return new Response
        {
            Status = "success",
            Rows = rows
        };
    }

    public static Response UpdateRow(Request request)
    {
        if (!IsValidTable(request.table))
        {
            return new Response { Status = "error", Message = "Invalid table name" };
        }

        var setParts = new List<string>();

        foreach (var key in request.data.Keys)
        {
            // Note: column names should also be validated/escaped if they come from user input
            // For now we assume keys in 'data' are safe or we should at least backtick them
            setParts.Add($"`{key}`=@{key}");
        }

        string sql = $"UPDATE `{request.table}` SET {string.Join(",", setParts)} " +
                     $"WHERE `{request.primary_key}`=@pk";

        try
        {
            using (var conn = Database.GetConnection())
            {
                conn.Open();
                var cmd = new MySqlCommand(sql, conn);

                foreach (var pair in request.data)
                {
                    cmd.Parameters.AddWithValue("@" + pair.Key, pair.Value);
                }

                cmd.Parameters.AddWithValue("@pk", request.primary_value);
                cmd.ExecuteNonQuery();
            }

            return new Response { Status = "success", Message = "Row updated" };
        }
        catch (Exception ex)
        {
            return new Response { Status = "error", Message = ex.Message };
        }
    }

    public static Response DeleteRow(Request request)
    {
        if (!IsValidTable(request.table))
        {
            return new Response { Status = "error", Message = "Invalid table name" };
        }

        string sql = $"DELETE FROM `{request.table}` WHERE `{request.primary_key}`=@pk";

        try
        {
            using (var conn = Database.GetConnection())
            {
                conn.Open();
                var cmd = new MySqlCommand(sql, conn);
                cmd.Parameters.AddWithValue("@pk", request.primary_value);
                cmd.ExecuteNonQuery();
            }

            return new Response { Status = "success", Message = "Row deleted" };
        }
        catch (MySqlException ex) when (ex.Number == 1451)
        {
            return new Response
            {
                Status = "error",
                Message = "Cannot delete record due to related data"
            };
        }
        catch (Exception ex)
        {
            return new Response { Status = "error", Message = ex.Message };
        }
    }
}
