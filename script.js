const locations = [
    { city: "New York", country: "USA", timezone: "America/New_York" },
    { city: "London", country: "UK", timezone: "Europe/London" },
    { city: "Tokyo", country: "Japan", timezone: "Asia/Tokyo" },
    { city: "New Delhi", country: "India", timezone: "Asia/Kolkata" },
    { city: "Sydney", country: "Australia", timezone: "Australia/Sydney" },
    { city: "Paris", country: "France", timezone: "Europe/Paris" }
];

const clockElements = [];
const uiElements = {};

function initializeApp() {
    // Cache UI elements
    uiElements.clockContainer = document.getElementById('clock-container');
    uiElements.gameContainer = document.getElementById('game-container');
    uiElements.showClocksBtn = document.getElementById('show-clocks');
    uiElements.showGameBtn = document.getElementById('show-game');
    uiElements.canvas = document.getElementById('snake-canvas');
    uiElements.scoreEl = document.getElementById('game-score');
    uiElements.highScoreEl = document.getElementById('high-score');
    uiElements.startBtn = document.getElementById('start-game');
    uiElements.pauseBtn = document.getElementById('pause-game');
    uiElements.ctx = uiElements.canvas.getContext('2d');

    initializeClocks();
    setupNavigation();
    setupGame();
}

function initializeClocks() {
    locations.forEach((loc, index) => {
        const card = document.createElement('div');
        card.className = "bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-xl transform transition-all hover:scale-105";
        card.innerHTML = `
            <h2 class="text-xl font-semibold text-slate-300">${loc.city}, ${loc.country}</h2>
            <p id="time-${index}" class="text-4xl font-mono font-bold mt-4 text-emerald-400">--:--:--</p>
            <p id="date-${index}" class="text-sm text-slate-400 mt-2">---, --- --, ----</p>
        `;
        uiElements.clockContainer.appendChild(card);

        // Cache the elements
        clockElements.push({
            timeEl: document.getElementById(`time-${index}`),
            dateEl: document.getElementById(`date-${index}`),
            timezone: loc.timezone
        });
    });
}

function updateClocks() {
    if (uiElements.clockContainer.classList.contains('hidden')) return;

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

// Navigation
function setupNavigation() {
    uiElements.showClocksBtn.addEventListener('click', () => {
        uiElements.clockContainer.classList.remove('hidden');
        uiElements.gameContainer.classList.add('hidden');
        updateNavButtons(uiElements.showClocksBtn, uiElements.showGameBtn);
        stopGame();
    });

    uiElements.showGameBtn.addEventListener('click', () => {
        uiElements.clockContainer.classList.add('hidden');
        uiElements.gameContainer.classList.remove('hidden');
        updateNavButtons(uiElements.showGameBtn, uiElements.showClocksBtn);
    });
}

function updateNavButtons(activeBtn, inactiveBtn) {
    activeBtn.classList.remove('bg-slate-700', 'hover:bg-slate-600');
    activeBtn.classList.add('bg-blue-600', 'hover:bg-blue-500');

    inactiveBtn.classList.remove('bg-blue-600', 'hover:bg-blue-500');
    inactiveBtn.classList.add('bg-slate-700', 'hover:bg-slate-600');
}

// Snake Game
let score = 0;
let snake = [{x: 10, y: 10}];
let food = {x: 15, y: 15};
let dx = 0;
let dy = 0;
let nextDx = 0;
let nextDy = 0;
let gameInterval = null;
let isPaused = false;
const gridSize = 20;
const tileCount = 20; // 400/20

function setupGame() {
    uiElements.startBtn.addEventListener('click', startGame);
    uiElements.pauseBtn.addEventListener('click', togglePause);
    window.addEventListener('keydown', handleKeyPress);
    loadHighScore();
    drawPlaceholder();
}

function loadHighScore() {
    const savedScore = localStorage.getItem('snakeHighScore');
    if (savedScore) {
        uiElements.highScoreEl.textContent = savedScore;
    }
}

function drawPlaceholder() {
    const { ctx, canvas } = uiElements;
    ctx.fillStyle = '#1e293b';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#64748b';
    ctx.font = '20px Inter';
    ctx.textAlign = 'center';
    ctx.fillText('Press "Start New Game" to play', canvas.width / 2, canvas.height / 2);
}

function startGame() {
    console.log("Game starting...");
    score = 0;
    isPaused = false;
    uiElements.pauseBtn.textContent = 'Pause';
    uiElements.pauseBtn.classList.remove('hidden');
    uiElements.scoreEl.textContent = score;
    snake = [{x: 10, y: 10}];
    nextDx = 1;
    nextDy = 0;
    dx = 1;
    dy = 0;
    spawnFood();
    if (gameInterval) clearInterval(gameInterval);
    gameInterval = setInterval(gameLoop, 100);
}

function togglePause() {
    if (!gameInterval) return;
    isPaused = !isPaused;
    uiElements.pauseBtn.textContent = isPaused ? 'Resume' : 'Pause';
    if (isPaused) {
        drawPauseScreen();
    }
}

function drawPauseScreen() {
    const { ctx, canvas } = uiElements;
    ctx.fillStyle = 'rgba(30, 41, 59, 0.5)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#fbbf24';
    ctx.font = 'bold 30px Inter';
    ctx.textAlign = 'center';
    ctx.fillText('PAUSED', canvas.width / 2, canvas.height / 2);
}

function stopGame() {
    if (gameInterval) {
        clearInterval(gameInterval);
        gameInterval = null;
    }
    uiElements.pauseBtn.classList.add('hidden');
}

function spawnFood() {
    food = {
        x: Math.floor(Math.random() * tileCount),
        y: Math.floor(Math.random() * tileCount)
    };
    if (snake.some(segment => segment.x === food.x && segment.y === food.y)) {
        spawnFood();
    }
}

function gameLoop() {
    if (isPaused) return;
    updateSnake();
    if (checkCollision()) {
        stopGame();
        drawGameOver();
        return;
    }
    drawGame();
}

function drawGameOver() {
    const { ctx, canvas } = uiElements;
    ctx.fillStyle = 'rgba(30, 41, 59, 0.8)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#f43f5e';
    ctx.font = 'bold 30px Inter';
    ctx.textAlign = 'center';
    ctx.fillText('GAME OVER', canvas.width / 2, canvas.height / 2 - 20);
    ctx.fillStyle = '#f8fafc';
    ctx.font = '20px Inter';
    ctx.fillText(`Final Score: ${score}`, canvas.width / 2, canvas.height / 2 + 20);
}

function updateSnake() {
    dx = nextDx;
    dy = nextDy;
    const head = {x: snake[0].x + dx, y: snake[0].y + dy};
    snake.unshift(head);
    if (head.x === food.x && head.y === food.y) {
        score += 10;
        uiElements.scoreEl.textContent = score;
        checkHighScore();
        spawnFood();
    } else {
        snake.pop();
    }
}

function checkHighScore() {
    const currentHighScore = parseInt(localStorage.getItem('snakeHighScore') || '0');
    if (score > currentHighScore) {
        localStorage.setItem('snakeHighScore', score);
        uiElements.highScoreEl.textContent = score;
    }
}

function checkCollision() {
    const head = snake[0];
    if (head.x < 0 || head.x >= tileCount || head.y < 0 || head.y >= tileCount) return true;
    for (let i = 1; i < snake.length; i++) {
        if (snake[i].x === head.x && snake[i].y === head.y) return true;
    }
    return false;
}

function drawGame() {
    const { ctx, canvas } = uiElements;
    // Clear canvas
    ctx.fillStyle = '#1e293b';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Draw food
    ctx.fillStyle = '#f43f5e';
    ctx.fillRect(food.x * gridSize + 2, food.y * gridSize + 2, gridSize - 4, gridSize - 4);

    // Draw snake
    snake.forEach((segment, index) => {
        ctx.fillStyle = index === 0 ? '#a855f7' : '#c084fc';
        ctx.fillRect(segment.x * gridSize + 1, segment.y * gridSize + 1, gridSize - 2, gridSize - 2);
    });
}

function handleKeyPress(e) {
    switch(e.key) {
        case 'ArrowUp': case 'w': case 'W': if (dy !== 1) { nextDx = 0; nextDy = -1; } break;
        case 'ArrowDown': case 's': case 'S': if (dy !== -1) { nextDx = 0; nextDy = 1; } break;
        case 'ArrowLeft': case 'a': case 'A': if (dx !== 1) { nextDx = -1; nextDy = 0; } break;
        case 'ArrowRight': case 'd': case 'D': if (dx !== -1) { nextDx = 1; nextDy = 0; } break;
    }
}

// Initialize and then update every second
initializeApp();
updateClocks();
setInterval(updateClocks, 1000);
