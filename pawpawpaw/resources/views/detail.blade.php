<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi</title>
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <!-- Untuk font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="detail-container">
        <!-- Bagian Kiri: Informasi Dokter -->
        <div class="dokter-info">
            <!-- <img id="dokterFoto" src="img/doctor-placeholder.png" alt="Foto Dokter"> -->
            <h1 id="informasiDokter">Informasi Dokter</h1>
            <h2> Nama Dokter </h2>
            <p id="dokterNama">Nama Dokter</p>
            <h2> Spesialisasi </h2>
            <p id="dokterSpesialis">Spesialisasi tidak tersedia</p>
            <h2> Poli </h2>
            <p id="dokterPoli">Poli tidak tersedia</p>
        </div>

        <!-- Bagian Kanan: Form Input Pasien -->
        <div class="reservasi-box">
            <form id="reservasiForm">
                <label for="nama">Nama</label>
                <input type="text" id="nama" class="input-field" name="nama" placeholder="Masukkan nama Anda" required>

                <label for="tanggalKunjungan">Tanggal Kunjungan</label>
                <input type="date" id="tanggalKunjungan" name="tanggalKunjungan" required>

                <label for="jamKunjungan">Jam Kunjungan</label>
                <input type="time" id="jamKunjungan" name="jamKunjungan" placeholder="HH:mm:ss" required>

                <!-- <label for="tanggalLahir">Tanggal Lahir</label>
                <input type="date" id="tanggalLahir" name="tanggalLahir" required>

                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" placeholder="Masukkan alamat Anda" required></textarea> -->

                <!-- Tambahkan pembungkus di sekitar tombol -->
                <div class="button-container">
                    <button type="button" id="reservasiButton">Reservasi</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/detail.js') }}"></script>
</body>
</html>