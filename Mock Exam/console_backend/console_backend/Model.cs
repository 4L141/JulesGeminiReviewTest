using Newtonsoft.Json;
using System.Collections.Generic;

namespace ConsoleBackend
{
    public class Request
    {
        [JsonProperty("Action")]
        public string Action { get; set; }

        [JsonProperty("id")]
        public int id { get; set; }

        [JsonProperty("first_name")]
        public string first_name { get; set; }

        [JsonProperty("last_name")]
        public string last_name { get; set; }

        [JsonProperty("username")]
        public string username { get; set; }

        [JsonProperty("email")]
        public string email { get; set; }

        [JsonProperty("phone")]
        public string phone { get; set; }

        [JsonProperty("password")]
        public string password { get; set; }

        // Admin fields
        [JsonProperty("table")]
        public string table { get; set; }

        [JsonProperty("primary_key")]
        public string primary_key { get; set; }

        [JsonProperty("primary_value")]
        public string primary_value { get; set; }

        // NEW: generic column/value map
        [JsonProperty("data")]
        public Dictionary<string, object> data { get; set; }

        //Bookings

        [JsonProperty("service")]
        public string service { get; set; }

        [JsonProperty("user_id")]
        public int user_id { get; set; }

        [JsonProperty("date")]
        public string date { get; set; }

        [JsonProperty("time")]
        public string time { get; set; }

        [JsonProperty("schedule_date")]
        public string schedule_date { get; set; }

    }

    public class Response
    {
        [JsonProperty("Status")]
        public string Status { get; set; }

        [JsonProperty("Message")]
        public string Message { get; set; }

        [JsonProperty("User")]
        public UserData User { get; set; }

        [JsonProperty("UsersList")]
        public List<Dictionary<string, object>> UsersList { get; set; }

        // Admin responses
        [JsonProperty("Tables")]
        public List<string> Tables { get; set; }

        [JsonProperty("Rows")]
        public List<Dictionary<string, object>> Rows { get; set; }

        [JsonProperty("Columns")]
        public List<Dictionary<string, string>> Columns { get; set; }

        [JsonProperty("AvailableSlots")]
        public List<string> AvailableSlots { get; set; }

    }

    public class UserData
    {
        [JsonProperty("id")]
        public int id { get; set; }

        [JsonProperty("email")]
        public string email { get; set; }

        [JsonProperty("role")]
        public string role { get; set; }

    }
}
