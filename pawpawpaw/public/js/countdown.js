document.addEventListener("DOMContentLoaded", function () {
    const path = window.location.pathname;
    const pathSegments = path.split('/');
    const currentQueue = pathSegments[pathSegments.length - 1];

    console.log("Full Path:", window.location.pathname);
    console.log("Path Segments:", pathSegments);
    console.log("Current Queue:", currentQueue);

    let currentServing = 1; // Simulasi antrean yang sedang berjalan
    let nextQueue = currentServing + 1; // Simulasi antrean berikutnya
    // Update antrean di elemen HTML
    document.getElementById('current-queue').textContent = currentQueue;
    document.getElementById('current-serving').textContent = currentServing;
    document.getElementById('next-queue').textContent = nextQueue;
    // Fungsi untuk memperbarui antrean secara simulasi
    function updateQueues() {
        document.getElementById('current-serving').textContent = currentServing++;
        document.getElementById('next-queue').textContent = nextQueue++;
    }
    // Simulasi update setiap 5 detik
    setInterval(updateQueues, 7000);
    let waitingTimeInSeconds = 3900; // 1 jam 5 menit
    function formatTime(seconds) {
        const hrs = Math.floor(seconds / 3600);
        const mins = Math.floor((seconds % 3600) / 60);
        const secs = seconds % 60;
        return `${hrs.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }
    function updateWaitingTime() {
        if (waitingTimeInSeconds > 0) {
            waitingTimeInSeconds--;
            document.getElementById('waiting-time').textContent = formatTime(waitingTimeInSeconds);
        }
    }
    // Update waiting time every second
    setInterval(updateWaitingTime, 1000);
});