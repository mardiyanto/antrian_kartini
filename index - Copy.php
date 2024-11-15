
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
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <script>
    // Fungsi untuk memutar suara berdasarkan input pemanggilan
    function playVoice(input) {
        // Memisahkan input menjadi kata-kata untuk diproses satu per satu
        const parts = input.split(' ');
        const loket = parts[1]; // Loket berada di posisi kedua
        const antrian = parseInt(parts[2], 10); // Nomor antrian berada di posisi ketiga
        const audioFiles = [];

        // Menambahkan suara "antrian" di awal
        audioFiles.push("antrian");

        // Mendapatkan daftar file audio untuk nomor antrian
        audioFiles.push(...getWavFileNames(antrian));

        // Menambahkan suara "loket" dan nomor loket di akhir
        audioFiles.push("counter");
        audioFiles.push(loket);

        // Memutar setiap file audio secara berurutan
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

    // Fungsi untuk mendapatkan nama file WAV sesuai nomor
    function getWavFileNames(antrian) {
        const numberWords = {
            "1": "satu",
            "2": "dua",
            "3": "tiga",
            "4": "empat",
            "5": "lima",
            "6": "enam",
            "7": "tujuh",
            "8": "delapan",
            "9": "sembilan",
            "10": "sepuluh",
            "11": "sebelas",
            "12": "dua belas",
            "13": "tiga belas",
            "14": "empat belas",
            "15": "lima belas",
            "20": "puluh",
            "100": "seratus",
            "0": "nol"
        };

        let result = [];

        // Menangani angka ratusan
        if (antrian >= 100) {
            const hundreds = Math.floor(antrian / 100);
            const remainder = antrian % 100;
            
            if (hundreds === 1) {
                result.push("seratus"); // Khusus untuk "seratus"
            } else {
                result.push(numberWords[hundreds]);
                result.push("ratus");
            }
            
            if (remainder > 0) {
                result = result.concat(getWavFileNames(remainder));
            }
        } 
        // Menangani angka puluhan
        else if (antrian >= 20) {
            const tens = Math.floor(antrian / 10);
            const ones = antrian % 10;
            
            if (tens > 1) {
                result.push(numberWords[tens]);
            }
            result.push("puluh");
            
            if (ones > 0) {
                result.push(numberWords[ones]);
            }
        } 
        // Menangani angka di bawah 20 (termasuk belas)
        else if (antrian >= 10) {
            result.push(numberWords[antrian]); // Langsung ke nama file
        } 
        // Menangani angka satuan
        else {
            result.push(numberWords[antrian]);
        }

        return result;
    }
    </script>

<div class="container">
        <h1>Sistem Antrian Pendaftaran</h1>
        
        <!-- Loket 1 -->
        <div class="loket" id="loket1">
            <h2>Loket 1</h2>
            <p id="noAntrianLoket1">A300 2</p>
            <button onclick="playVoice('loket 1 300')">Panggil Loket 1, 125</button>
        </div>

        <!-- Loket 2 -->
        <div class="loket" id="loket2">
            <h2>Loket 2</h2>
            <p id="noAntrianLoket2">A300 5</p>
            <button onclick="playVoice('loket 2 989')">Panggil Loket 2, 305</button>
        </div>

        <!-- Loket 3 -->
        <div class="loket" id="loket3">
            <h2>Loket 3</h2>
            <p id="noAntrianLoket3">A300 7</p>
            <button onclick="playVoice('loket 3 21')">Panggil Loket 3, 21</button>
        </div>
    </div>
</body>
</html>