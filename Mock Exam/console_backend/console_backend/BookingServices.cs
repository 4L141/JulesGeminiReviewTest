using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;

namespace ConsoleBackend
{
    public static class BookingService
    {
        private static readonly string[] AllowedServices =
        {
            "consultation",
            "installation"
        };

        private static readonly string[] AllSlots =
        {
            "08:00:00",
            "12:00:00",
            "15:00:00"
        };

        public static Response GetAvailableSlots(Request req)
        {
            var available = new List<string>(AllSlots);

            using var conn = Database.GetConnection();
            conn.Open();

            var cmd = new MySqlCommand(
                "SELECT TIME_FORMAT(schedule_date, '%H:%i:%s') FROM schedules WHERE DATE(schedule_date)=@date",
               conn

             );

            cmd.Parameters.AddWithValue("@date", req.date);
            var reader = cmd.ExecuteReader();

            while (reader.Read())
            {
                string booked = reader.GetString(0);
                available.Remove(booked);
            }

            return new Response
            {
                Status = "success",
                AvailableSlots = available
            };
        }

        public static Response CreateBooking(Request req)
        {
            if (!AllowedServices.Contains(req.service.ToLower()))
            {
                return new Response
                {
                    Status = "error",
                    Message = "Invalid service type"
                };
            }

            using var conn = Database.GetConnection();
            conn.Open();

            string fullDateTime = $"{req.date} {req.time}";

            var check = new MySqlCommand(
                "SELECT COUNT(*) FROM schedules WHERE schedule_date=@dt",
                conn
            );

            check.Parameters.AddWithValue("@dt", fullDateTime);

            if (Convert.ToInt32(check.ExecuteScalar()) > 0)
                return new Response
                {
                    Status = "error",
                    Message = "Slot already booked"
                };

            var insert = new MySqlCommand(
                @"INSERT INTO schedules (user_id, service, schedule_date)
                VALUES (@uid, @service, @dt)",
                conn
            );

            insert.Parameters.AddWithValue("@uid", req.user_id);
            insert.Parameters.AddWithValue("@service", req.service.ToUpper());
            insert.Parameters.AddWithValue("@dt", fullDateTime);

            insert.ExecuteNonQuery();

            return new Response
            {
                Status = "success",
                Message = "Booking created"
            };
        }

        public static Response GetBookedTimes(string date)
        {
            using var conn = Database.GetConnection();
            conn.Open();
            var cmd = new MySqlCommand(
                "SELECT schedule_date FROM schedules WHERE DATE(schedule_date) = @d",
                conn
            );

            cmd.Parameters.AddWithValue("@d", date);

            var reader = cmd.ExecuteReader();
            var rows = new List<Dictionary<string, object>>();

            while (reader.Read())
            {
                rows.Add(new Dictionary<string, object>
                {
                    ["schedule_date"] = reader.GetDateTime("schedule_date")
                });
            }

            return new Response
            {
                Status = "success",
                Rows = rows
            };
        }

    }
}
