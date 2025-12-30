<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Dokter</title>
    <link rel="stylesheet" href="{{ asset('css/caridokterstyle.css') }}">
    <!-- Untuk font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="head">
            <a href="{{ route('home') }}"><</a>
            <h2>Pencarian Dokter</h2>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal Kunjungan</label>
            <input type="date" id="tanggal">
        </div>
        <div class="form-group">
            <label for="jam">Jam Kunjungan</label>
            <input type="time" id="jam">
        </div>
        <div class="form-group">
            <label for="name">Layanan</label>
            <select id="name">
                <option value="Cardiology">Cardiology</option>
                <option value="Neurology">Neurology</option>
                <option value="Pediatrics">Pediatrics</option>
                <option value="Orthopedics">Orthopedics</option>
                <option value="Dermatology">Dermatology</option>
                <!-- Tambah layanan lainnya sesuai kebutuhan -->
            </select>
        </div>
        <button id="cariButton">Cari</button>
    </div>
    <!-- Hasil pencarian dokter -->
    <div class="dokter-container" id="dokterContainer">
        <!-- Dokter akan muncul di sini setelah pencarian -->
    </div>
    <script src="{{ asset('js/caridokter.js') }}"></script>
</body>
</html>