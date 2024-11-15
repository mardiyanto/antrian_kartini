let queues = { A: 1, B: 1, F: 1 };
let lastCalled = { A: 0, B: 0, F: 0 };

function updateQueueDisplay() {
    document.getElementById("noAntrianLoketA").innerText = queues.A;
    document.getElementById("noAntrianLoketB").innerText = queues.B;
    document.getElementById("noAntrianLoketF").innerText = queues.F;
}

// Fungsi untuk memanggil nomor antrian berikutnya
function nextQueue(loket) {
    queues[loket]++;
    lastCalled[loket] = queues[loket];
    updateQueueDisplay();
}

// Fungsi untuk memperbarui waktu
function updateTime() {
    const now = new Date();
    const dateString = now.toLocaleDateString("id-ID", { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    const timeString = now.toLocaleTimeString("id-ID", { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });

    document.getElementById("date-time").innerText = dateString;
    document.getElementById("time").innerText = timeString;
}

// Perbarui waktu setiap detik
setInterval(updateTime, 1000);

// Memulai antrian
updateQueueDisplay();
