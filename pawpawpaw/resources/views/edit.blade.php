<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservasi</title>
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <!-- Untuk font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <a href="{{ route('admindashboard') }}" class="back-button">
            <
        </a>
        <img src="{{ asset('img/logoteks.png') }}" alt="Hospity Logo">
    </header>

    <!-- Kontainer Form Edit -->
    <div class="edit-container">
        <h2>Edit Reservasi</h2>
        <form id="editReservasiForm">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="poli">Poli:</label>
            <input type="text" id="poli" name="poli" required>

            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="jam">Jam:</label>
            <input type="time" id="jam" name="jam" required>

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>

    <script src="{{ asset('js/edit.js') }}"></script>
</body>
</html>