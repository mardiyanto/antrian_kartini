
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid p-3 bg-success text-white">
        <h3>Monitor Antrian Pendaftaran</h3>
        <p>Loket <?= $loket ?> | Tanggal: <?= date('d M Y') ?></p>
    </div>

    <div class="container mt-3">
        <div class="row">
            <!-- Video -->
            <div class="col-md-8">
            <video class="embed-responsive-item" src="vid-4.mp4" controls width="800" auto height="447" loop></video>
            </div>
            <!-- Antrian -->
            <div class="col-md-4">
               <div id="antrian-container"></div>
            </div>
        </div>
        <div class="row">
             <div class="col-md-4">
               <div class="card mb-3 text-center">
                    <div class="card-header bg-warning text-white">ANTRIAN SELANJUTNYA</div>
                    <div class="card-body">
                        <h1 class="display-4"><?= $next_antrian ?></h1>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header bg-primary text-white">TOTAL ANTRIAN</div>
                    <div class="card-body">
                        <h1 class="display-5"><?= $total_antrian ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="container-fluid text-center mt-5 p-3 bg-success text-white">
        <p>Selamat datang di sistem antrian loket <?= $loket ?></p>
    </footer>
</body>
</html>
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
                <div class="card mb-3 text-center">
                    <div class="card-header bg-info text-white"><strong>ANTRIAN LOKET ${item.loket}</strong></div>
                    <div class="card-body">
                        <h1 class="display-3"> ${item.nomor_antrian}</h1>
                    </div>
                </div>
                            `;
                            container.appendChild(loketDiv);
                        });
                    } else {
                        container.innerHTML = `
                <div class='card mb-3 text-center'>
                    <div class='card-header bg-info text-white'>ANTRIAN</div>
                    <div class='card-body'>
                        <h1 class='display-3'>Belum ada nomor antrian yang dipanggil.</h1>
                    </div>
                </div>`;
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Panggil fungsi setiap 5 detik untuk memperbarui data
        setInterval(fetchAntrianDipanggil, 5000);

        // Panggilan pertama saat halaman dimuat
        fetchAntrianDipanggil();
    </script>