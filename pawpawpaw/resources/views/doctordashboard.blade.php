<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage Dokter</title>
    <link rel="stylesheet" href="{{ asset('css/homepagestyledokter.css') }}">
    <!-- Untuk font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>
    <header id="main-header">
        <div class="header-container">
            <!-- Logo di kiri -->
            <img src="img/logosimbol.png" alt="Logo Hospity" class="logo">
    
            <!-- Menu dan ikon di kanan -->
            <nav class="nav-links">
                <ul>
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#jadwal">Reservasi</a></li>
                    <li><a href="#rating">Feedback</a></li>
                    <li><a href="#notifikasi" class="icon"><img src="img/notif.png" alt="Notifikasi"></a></li>
                    <li><a href="#profile" class="icon"><img src="img/profil.png" alt="Profil"></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="daftar-antrean">
        <h2>Selamat Datang, Dokter</h2>
        <div class="antrean-container">
            <h3>Antrean Menunggu Diselesaikan</h3>
            <script src="{{ asset('js/homepagedokter.js') }}"></script>
        </div>
    </section>
</body>
</html>