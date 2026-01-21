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
        card.className = "relative overflow-hidden bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-xl transform transition-all hover:scale-105 duration-500";
        card.innerHTML = `
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <h2 class="text-xl font-semibold text-slate-300">${loc.city}, ${loc.country}</h2>
                    <p id="date-${index}" class="text-sm text-slate-400 mt-1">---, --- --, ----</p>
                </div>
                <div id="icon-${index}" class="text-slate-400"></div>
            </div>
            <div class="relative z-10">
                <p id="time-${index}" class="text-5xl font-mono font-bold mt-6 text-emerald-400 drop-shadow-md">--:--:--</p>
                <div class="flex items-center mt-4">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse mr-2"></span>
                    <span class="text-xs uppercase tracking-widest text-slate-500 font-semibold">Live</span>
                </div>
            </div>
            <div id="bg-glow-${index}" class="absolute -right-10 -bottom-10 w-40 h-40 rounded-full blur-3xl opacity-20 transition-all duration-1000"></div>
        `;
        container.appendChild(card);

        clockElements.push({
            cardEl: card,
            timeEl: document.getElementById(`time-${index}`),
            dateEl: document.getElementById(`date-${index}`),
            iconEl: document.getElementById(`icon-${index}`),
            glowEl: document.getElementById(`bg-glow-${index}`),
            timezone: loc.timezone,
            currentStatus: null // 'day' or 'night'
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

        const hourOptions = {
            timeZone: el.timezone,
            hour: 'numeric',
            hour12: false
        };

        const timeString = new Intl.DateTimeFormat('en-US', timeOptions).format(now);
        const dateString = new Intl.DateTimeFormat('en-US', dateOptions).format(now);
        const hour = parseInt(new Intl.DateTimeFormat('en-US', hourOptions).format(now));

        el.timeEl.textContent = timeString;
        el.dateEl.textContent = dateString;

        const isDay = hour >= 6 && hour < 18;
        const status = isDay ? 'day' : 'night';

        if (el.currentStatus !== status) {
            el.currentStatus = status;
            if (isDay) {
                el.iconEl.innerHTML = '<i data-lucide="sun" class="text-amber-400"></i>';
                el.glowEl.className = "absolute -right-10 -bottom-10 w-40 h-40 rounded-full blur-3xl opacity-20 transition-all duration-1000 bg-yellow-400";
                el.timeEl.classList.remove('text-emerald-400');
                el.timeEl.classList.add('text-amber-400');
            } else {
                el.iconEl.innerHTML = '<i data-lucide="moon" class="text-blue-400"></i>';
                el.glowEl.className = "absolute -right-10 -bottom-10 w-40 h-40 rounded-full blur-3xl opacity-20 transition-all duration-1000 bg-blue-500";
                el.timeEl.classList.remove('text-amber-400');
                el.timeEl.classList.add('text-emerald-400');
            }
            if (window.lucide) {
                lucide.createIcons();
            }
        }
    });
}

initializeClocks();
updateClocks();
setInterval(updateClocks, 1000);
