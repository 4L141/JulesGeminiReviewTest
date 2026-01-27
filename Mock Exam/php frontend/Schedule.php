<?php
include "load_header.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
</head>
<body>

<h2>Book Appointment</h2>

<label>Date:</label>
<input type="date" id="date">

<label>Time:</label>
<select id="time">
    <option value="">Select time</option>
</select>

<label>Service:</label>
<select id="service">
    <option value="consultation">Consultation</option>
    <option value="installation">Installation</option>
</select>


<button onclick="book()">Book</button>

<p id="msg"></p>

<script>
const date = document.getElementById("date");
const time = document.getElementById("time");
const service = document.getElementById("service");
const msg = document.getElementById("msg");

function loadSlots() {
    time.innerHTML = "<option value=''>Select time</option>";

    fetch("get_slots.php?date=" + date.value)
        .then(r => r.json())
        .then(slots => {
            slots.forEach(t => {
                let opt = document.createElement("option");
                opt.value = t;
                opt.text = t;
                time.appendChild(opt);
            });
        });
}

date.onchange = loadSlots;

function book() {
    const params = new URLSearchParams();
    params.append("date", date.value);    // This is the date from <input type="date">
    params.append("time", time.value);    // This is the time from the <select>
    params.append("service", service.value);

    fetch("create_booking.php", {
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: params.toString()
    })
    .then(r => r.text())
    .then(t => {
        msg.innerText = t;
        // Optional: clear form on success
    });
}
</script>


</body>
</html>
