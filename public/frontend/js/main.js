function startCountdown(duration) {
    let timer = duration,
        hours,
        minutes,
        seconds;
    setInterval(function () {
        hours = Math.floor(timer / 3600);
        minutes = Math.floor((timer % 3600) / 60);
        seconds = timer % 60;
        document.getElementById("hours").textContent = String(hours).padStart(
            2,
            "0"
        );
        document.getElementById("minutes").textContent = String(
            minutes
        ).padStart(2, "0");
        document.getElementById("seconds").textContent = String(
            seconds
        ).padStart(2, "0");
        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}
window.onload = function () {
    let timeInSeconds = 7 * 3600 + 50 * 60 + 15; // 7 giờ, 50 phút, 15 giây
    startCountdown(timeInSeconds);
};

// search
document.getElementById("openSearch").addEventListener("click", function () {
    document.getElementById("searchOverlay").style.display = "flex";
});

document.getElementById("closeSearch").addEventListener("click", function () {
    document.getElementById("searchOverlay").style.display = "none";
});
