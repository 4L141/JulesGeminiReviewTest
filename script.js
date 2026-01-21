const locations = [
    { city: "New York", country: "USA", timezone: "America/New_York" },
    { city: "London", country: "UK", timezone: "Europe/London" },
    { city: "Tokyo", country: "Japan", timezone: "Asia/Tokyo" },
    { city: "New Delhi", country: "India", timezone: "Asia/Kolkata" },
    { city: "Sydney", country: "Australia", timezone: "Australia/Sydney" }
];

const clockElements = [];

function initializeClocks() {
    const container = document.getElementById('clock-container');

    locations.forEach((loc, index) => {
        const card = document.createElement('div');
        card.className = "bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-xl transform transition-all hover:scale-105";
        card.innerHTML = `
            <h2 class="text-xl font-semibold text-slate-300">${loc.city}, ${loc.country}</h2>
            <p id="time-${index}" class="text-4xl font-mono font-bold mt-4 text-emerald-400">--:--:--</p>
            <p id="date-${index}" class="text-sm text-slate-400 mt-2">---, --- --, ----</p>
        `;
        container.appendChild(card);

        // Cache the elements
        clockElements.push({
            timeEl: document.getElementById(`time-${index}`),
            dateEl: document.getElementById(`date-${index}`),
            timezone: loc.timezone
        });
    });
}

function updateClocks() {
    const now = new Date();

    clockElements.forEach((el) => {
        const timeOptions = {
            timeZone: el.timezone,
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        };

        const dateOptions = {
            timeZone: el.timezone,
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };

        const timeString = new Intl.DateTimeFormat('en-US', timeOptions).format(now);
        const dateString = new Intl.DateTimeFormat('en-US', dateOptions).format(now);

        el.timeEl.textContent = timeString;
        el.dateEl.textContent = dateString;
    });
}

// Initialize and then update every second
initializeClocks();
updateClocks();
setInterval(updateClocks, 1000);
