document.addEventListener('DOMContentLoaded', () => {
    const dateInput = document.getElementById("date");
    const timeSelect = document.getElementById("time");
    const serviceSelect = document.getElementById("service");
    const msgElement = document.getElementById("msg");
    const bookBtn = document.getElementById("bookBtn");

    if (dateInput) {
        dateInput.addEventListener('change', () => {
            timeSelect.innerHTML = "<option value=''>Select time</option>";

            fetch("get_slots.php?date=" + dateInput.value)
                .then(r => r.json())
                .then(slots => {
                    slots.forEach(t => {
                        let opt = document.createElement("option");
                        opt.value = t;
                        opt.text = t;
                        timeSelect.appendChild(opt);
                    });
                });
        });
    }

    if (bookBtn) {
        bookBtn.addEventListener('click', () => {
            const params = new URLSearchParams();
            params.append("date", dateInput.value);
            params.append("time", timeSelect.value);
            params.append("service", serviceSelect.value);

            fetch("create_booking.php", {
                method: "POST",
                headers: {"Content-Type":"application/x-www-form-urlencoded"},
                body: params.toString()
            })
            .then(r => r.text())
            .then(t => {
                msgElement.innerText = t;
            });
        });
    }
});
