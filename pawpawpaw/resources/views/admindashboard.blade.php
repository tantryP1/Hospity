<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage Admin</title>
    <link rel="stylesheet" href="{{ asset('css/homepagestyleadmin.css') }}">
    <!-- Untuk font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/logoteks.png" alt="Logo Hospity" />
        </div>
        <div class="search-container">
            <input type="text" id="search-box" placeholder="Cari nama pasien">
            <button id="search-button">Search</button>
        </div>
    </header>
    <section id="daftar-antrian">
        <div id="antrian-container">
            <!-- Data pasien akan di-generate oleh JavaScript -->
        </div>
    </section>
    <script src="{{ asset('js/homepageadmin.js') }}"></script>
</body>
</html>