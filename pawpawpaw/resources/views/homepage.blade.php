<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="{{ asset('css/homepagestyle.css') }}">
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
                    <li><a href="{{ route('caridokter') }}">Reservasi</a></li>
                    <li><a href="{{ route('feedback') }}">Feedback</a></li>
                    <li><a href="notif.html" class="icon"><img src="img/notif.png" alt="Notifikasi"></a></li>
                    <li><a href="#profile" class="icon"><img src="img/profil.png" alt="Profil"></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Selamat Datang!</h1>
                <p>Sobat Hospity, ada yang bisa kami bantu?</p>
                <a href="{{ route('caridokter') }}" class="cta-button">Mau Reservasi!</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="img/heroimg1.png" alt="Hero Image">
        </div>
    </section>
    <section id="about" class="about-section">
        <div class="about-content">
            <h1>Apa itu Hospity?</h1>
            <p>Hospity adalah sebuah platform reservasi dan antrean online rumah sakit. Aplikasi ini menawarkan berbagai kemudahan dalam administrasi rumah sakit dan mempermudah Anda mendapatkan nomor antrean serta pemantauan antrean secara real-time, mengurangi waktu Anda yang terbuang sia-sia. Kami menawarkan kemudahan didalam hidup Anda.</p>
        </div>
        <img src="img/doc.png" alt="Dokter" class="about-image-left">
        <img src="img/stetoskop.png" alt="Stetoskop" class="about-image-right">
    </section>
    <section id="kata-mereka">
        <div class="section-title">
            <h1>Apa Kata Mereka Tentang Hospity?</h1>
        </div>
        <div class="comments-container">
            <!-- Komentar 1 -->
            <div class="comment-row">
                <div class="profile">
                    <img src="img/reviewer1.png" alt="Profile 1">
                </div>
                <div class="comment-box">
                    <p>"Aplikasi yang sangat membantu!"</p>
                    <span class="commenter-name">Serena Harper</span>
                </div>
            </div>
            <!-- Komentar 2 -->
            <div class="comment-row">
                <div class="profile">
                    <img src="img/reviewer2.png" alt="Profile 2">
                </div>
                <div class="comment-box">
                    <p>"Saya bisa menghemat waktu dalam antrean."</p>
                    <span class="commenter-name">Eleana Jones</span>
                </div>
            </div>
            <!-- Komentar 3 -->
            <div class="comment-row">
                <div class="profile">
                    <img src="img/reviewer3.png" alt="Profile 3">
                </div>
                <div class="comment-box">
                    <p>"Sejak rilis, aplikasi ini sudah membantu saya berkali-kali."</p>
                    <span class="commenter-name">Ali Hasan</span>
                </div>
            </div>            
        </div>
        <!-- Dekorasi Tanda Tanya -->
        <div class="decorations">
            <span class="question-mark">?</span>
            <span class="question-mark">?</span>
            <span class="question-mark">?</span>
            <span class="question-mark">?</span>
            <span class="question-mark">?</span>
            <span class="question-mark">?</span>
        </div>
    </section>
    <section class="doctors-section">
        <h1>Lihat Dokter Kita!</h1>
        <div class="doctors-container">
            <!-- Dokter 1 -->
            <div class="doctor">
                <img src="img/doctor1.png" alt="Doctor 1" class="doctor-photo">
                <h3 class="doctor-name">Dr. John Doe</h3>
                <p class="doctor-bio">Dokter spesialis jantung dengan pengalaman 10 tahun.</p>
            </div>
            <!-- Dokter 2 -->
            <div class="doctor">
                <img src="img/doctor2.png" alt="Doctor 2" class="doctor-photo">
                <h3 class="doctor-name">Dr. Emily Carter M.D</h3>
                <p class="doctor-bio">Dokter spesialis kulit dengan keahlian dalam perawatan kulit.</p>
            </div>
            <!-- Dokter 3 -->
            <div class="doctor">
                <img src="img/doctor3.png" alt="Doctor 3" class="doctor-photo">
                <h3 class="doctor-name">Dr. Clara Johnson Sp.A</h3>
                <p class="doctor-bio">Dokter spesialis anak yang peduli terhadap kesehatan anak-anak.</p>
            </div>
            <!-- Tambahkan dokter lainnya sesuai kebutuhan -->
        </div>
    </section>        
    <section id="motto">
        <h1>Lebih Dekat Dengan Sehat</h1>
        <h1>Dengan Satu Kali Klik!</h1>
    </section>

    <footer class="footer">
        <div class="footer-container">
            <!-- Kolom 1: Logo -->
            <div class="footer-logo">
                <img src="img/logosimbol.png" alt="Logo" class="footer-logo-img">
            </div>
            <!-- Kolom 2: Kontak -->
            <div class="footer-contact">
                <h4>Kontak</h4>
                <ul>
                    <li>Bantuan</li>
                    <li>Kebijakan</li>
                    <li>Syarat & Ketentuan</li>
                </ul>
            </div>
            <!-- Kolom 3: Tentang Kami -->
            <div class="footer-about">
                <h4>Tentang Kami</h4>
                <ul>
                    <li>Berita</li>
                    <li>Komunitas</li>
                    <li>Membership & Benefit</li>
                </ul>
            </div>
            <!-- Kolom 4: Alamat -->
            <div class="footer-address">
                <h4>Alamat</h4>
                <p>Lt. 4, Gedung F
                    Fakultas Ilmu Komputer
                    Universitas Brawijaya
                    Malang, 59956</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&#169; 2024 Hospity | Hospity adalah brand yang diciptakan untuk keperluan penugasan projek akhir.</p>
        </div>
    </footer>    
</body>
</html>