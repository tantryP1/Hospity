<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Antrian</title>
    <link rel="stylesheet" href="{{ asset('css/pengelolaan.css') }}">
    <!-- Untuk font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="filter-container">
            <input type="date" id="filter-tanggal" placeholder="Pilih Tanggal">
            <input type="time" id="filter-jam" placeholder="Pilih Jam">
            <button id="apply-filter">Filter</button>
        </div>
    </header>
    <section id="daftar-antrian">
        <!-- Box antrian akan dimuat di sini -->
    </section>

    <script src="{{ asset('js/pengelolaan.js') }}"></script>
</body>
</html>