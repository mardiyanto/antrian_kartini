<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian Dipanggil</title>
    <style>
        .loket {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Nomor Antrian yang Sedang Dipanggil</h1>
    <div id="antrian-container"></div>

    <script>
        // Fungsi untuk mendapatkan data antrian terbaru
        function fetchAntrianDipanggil() {
            fetch('get_antrian_dipanggil.php')
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('antrian-container');
                    container.innerHTML = ''; // Kosongkan kontainer

                    if (data.length > 0) {
                        data.forEach(item => {
                            const loketDiv = document.createElement('div');
                            loketDiv.classList.add('loket');
                            loketDiv.innerHTML = `
                                <h2>Loket ${item.loket}</h2>
                                <p>Nomor Antrian: <strong>${item.nomor_antrian}</strong></p>
                                <p>Waktu Panggilan: <strong>${item.waktu_panggilan}</strong></p>
                            `;
                            container.appendChild(loketDiv);
                        });
                    } else {
                        container.innerHTML = '<p>Belum ada nomor antrian yang dipanggil.</p>';
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Panggil fungsi setiap 5 detik untuk memperbarui data
        setInterval(fetchAntrianDipanggil, 5000);

        // Panggilan pertama saat halaman dimuat
        fetchAntrianDipanggil();
    </script>
</body>
</html>
