<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Antrian Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0066CC;
            color: white;
            text-align: center;
        }

        .container {
            margin-top: 50px;
        }

        .loket {
            display: inline-block;
            margin: 20px;
            padding: 20px;
            background-color: #007BFF;
            border-radius: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin: 5px;
        }

        button:hover {
            background-color: #218838;
        }

        input[type="number"] {
            padding: 5px;
            font-size: 16px;
            width: 80px;
            border-radius: 5px;
            border: 1px solid #ccc;
            text-align: center;
        }
    </style>
</head>
<body>
<script>
    let queues = {};
    let lastCalled = {}; // Menyimpan nomor terakhir yang dipanggil untuk setiap loket

    // Perbarui nomor antrian dari database
    function loadLastQueue(loket) {
        fetch(`get_last_antrian.php?loket=${loket}`)
            .then(response => response.json())
            .then(data => {
                const lastQueue = data.last_antrian; // Ambil nomor terakhir dari database
                queues[loket] = lastQueue + 1; // Nomor berikutnya
                lastCalled[loket] = lastQueue; // Nomor terakhir yang dipanggil
                document.getElementById(`noAntrianLoket${loket}`).innerText = lastQueue; // Tampilkan nomor terakhir
            })
            .catch(error => {
                console.error("Error:", error);
            });
    }

    // Periksa semua loket saat halaman dimuat
    window.onload = function () {
        for (let loket = 1; loket <= 3; loket++) {
            loadLastQueue(loket);
        }
    };

    // Fungsi untuk memanggil nomor berikutnya
    function nextQueue(loket) {
        const currentQueue = queues[loket];
        playVoice(`loket ${loket} ${currentQueue}`);
        document.getElementById(`noAntrianLoket${loket}`).innerText = currentQueue;

        // Simpan nomor yang dipanggil terakhir
        lastCalled[loket] = currentQueue;

        // Simpan ke database
        saveToDatabase(loket, currentQueue);

        // Naikkan nomor antrian untuk panggilan berikutnya
        queues[loket]++;

        // Perbarui nomor di loket lainnya
        updateOtherQueues(loket);
    }

    // Fungsi untuk memperbarui nomor loket lainnya
    function updateOtherQueues(callingLoket) {
        for (let loket = 1; loket <= 3; loket++) {
            if (loket !== callingLoket) {
                queues[loket]++; // Tambahkan 1 ke nomor antrian loket lainnya
                document.getElementById(`noAntrianLoket${loket}`).innerText = queues[loket];
                
                // Simpan nomor yang diperbarui ke database
                saveToDatabase(loket, queues[loket] - 1); 
            }
        }
    }

    // Fungsi untuk menyimpan ke database
    function saveToDatabase(loket, antrian) {
        fetch('simpan_antrian.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ loket, antrian })
        }).then(response => {
            if (response.ok) {
                console.log("Nomor antrian disimpan.");
            } else {
                console.error("Gagal menyimpan nomor antrian.");
            }
        }).catch(error => {
            console.error("Error:", error);
        });
    }

    // Fungsi untuk memutar ulang nomor antrian terakhir
    function repeatQueue(loket) {
        const lastQueue = lastCalled[loket];
        if (lastQueue && lastQueue > 0) {
            playVoice(`loket ${loket} ${lastQueue}`);
        } else {
            alert("Belum ada nomor yang dipanggil untuk loket ini.");
        }
    }

    // Fungsi untuk memasukkan nomor manual
    function manualQueue(loket) {
        const manualInput = parseInt(prompt("Masukkan nomor antrian:"), 10);
        if (!isNaN(manualInput) && manualInput >= 1 && manualInput <= 999) {
            queues[loket] = manualInput + 1; // Update nomor antrian
            playVoice(`loket ${loket} ${manualInput}`);
            document.getElementById(`noAntrianLoket${loket}`).innerText = manualInput;

            // Simpan nomor manual sebagai nomor terakhir yang dipanggil
            lastCalled[loket] = manualInput;

            saveToDatabase(loket, manualInput); // Simpan ke database
        } else {
            alert("Nomor tidak valid. Harus antara 1 hingga 999.");
        }
    }

    // Fungsi untuk memutar suara
    function playVoice(input) {
        const parts = input.split(' ');
        const loket = parts[1];
        const antrian = parseInt(parts[2], 10);

        const audioFiles = [];
        audioFiles.push("antrian");
        audioFiles.push(...getWavFileNames(antrian));
        audioFiles.push("counter");
        audioFiles.push(loket);

        let index = 0;
        function playNext() {
            if (index < audioFiles.length) {
                const audio = new Audio(`suara/${audioFiles[index]}.wav`);
                audio.play();
                audio.onended = playNext;
                index++;
            }
        }
        playNext();
    }

    // Fungsi untuk menghasilkan nama file audio sesuai nomor
    function getWavFileNames(antrian) {
    const numberWords = {
        "1": "satu", "2": "dua", "3": "tiga", "4": "empat", "5": "lima",
        "6": "enam", "7": "tujuh", "8": "delapan", "9": "sembilan",
        "10": "sepuluh", "11": "sebelas", "20": "dua puluh",
        "100": "seratus", "0": "nol"
    };

    const result = [];

    if (antrian >= 100) {
        const hundreds = Math.floor(antrian / 100);
        if (hundreds === 1) {
            result.push("seratus");
        } else {
            result.push(numberWords[hundreds]);
            result.push("ratus");
        }
        const remainder = antrian % 100;
        if (remainder > 0) {
            result.push(...getWavFileNames(remainder));
        }
    } else if (antrian >= 20) {
        const tens = Math.floor(antrian / 10);
        result.push(numberWords[tens]);
        result.push("puluh");
        const ones = antrian % 10;
        if (ones > 0) {
            result.push(numberWords[ones]);
        }
    } else if (antrian >= 12) {
        const ones = antrian - 10;
        result.push(numberWords[ones]);
        result.push("belas");
    } else if (antrian > 0) {
        result.push(numberWords[antrian]);
    } else {
        result.push("nol");
    }

    return result;
}
</script>
    <div class="container">
        <h1>Sistem Antrian Pendaftaran</h1>

        <!-- Loket 1 -->
        <div class="loket" id="loket1">
            <h2>Loket 1</h2>
            <p id="noAntrianLoket1">1</p>
            <button onclick="nextQueue(1)">Next</button>
            <button onclick="repeatQueue(1)">Ulangi</button>
            <button onclick="manualQueue(1)">Input Manual</button>
        </div>

        <!-- Loket 2 -->
        <div class="loket" id="loket2">
            <h2>Loket 2</h2>
            <p id="noAntrianLoket2">1</p>
            <button onclick="nextQueue(2)">Next</button>
            <button onclick="repeatQueue(2)">Ulangi</button>
            <button onclick="manualQueue(2)">Input Manual</button>
        </div>

        <!-- Loket 3 -->
        <div class="loket" id="loket3">
            <h2>Loket 3</h2>
            <p id="noAntrianLoket3">1</p>
            <button onclick="nextQueue(3)">Next</button>
            <button onclick="repeatQueue(3)">Ulangi</button>
            <button onclick="manualQueue(3)">Input Manual</button>
        </div>
    </div>
</body>
</html>
