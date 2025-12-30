<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hospity</title>
    <!-- Untuk font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #EEF5FF;
            font-family: 'Poppins', sans-serif;
            position: relative; /* Agar gambar bisa diposisikan relatif terhadap body */
        }

        /* Logo di pojok kiri atas halaman */
        .logo {
            position: absolute;
            top: 25px; /* Jarak dari atas */
            left: 25px; /* Jarak dari kiri */
            width: 200px; /* Ukuran logo */
            height: auto;
        }

        /* Hero Image di pojok kanan dengan efek gradasi transparansi */
        .fade-image {
            position: absolute;
            right: 0; /* Posisi dari kanan */
            width: 370px; /* Ukuran gambar */
            height: auto; /* Menyesuaikan tinggi gambar */
            object-fit: cover; /* Agar gambar tetap memenuhi area */
            mask-image: linear-gradient(to left, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%); /* Gradasi transparansi */
            -webkit-mask-image: linear-gradient(to left, rgba(255, 255, 255, 1) 40%, rgba(255, 255, 255, 0) 100%); /* Masking untuk browser WebKit */
        }

        .login-container {
            position: absolute;
            left: 15%; /* Posisi dari kiri */
            padding: 30px;
            width: 100%;
            max-width: 400px;
            display: flex; /* Menggunakan flexbox */
            flex-direction: column; /* Menyusun elemen secara vertikal */
            justify-content: center; /* Memusatkan konten secara vertikal */
            align-items: center; /* Memusatkan konten secara horizontal */
        }

        h1 {
            text-align: center;
            font-weight: 800; /* Ketebalan font */
            font-size: 50px; /* Ukuran teks tombol */
            color: #176B87;
        }

        p {
            color: #00449E;
        }

        label {
            font-size: 18px; /* Ukuran teks label */
            color: #00449E; /* Warna teks label */
            margin-bottom: 0px; /* Jarak antara label dan input */
            display: block; /* Menampilkan label di baris baru */
        }

        .input-field {
            font-family: 'Poppins', sans-serif;
            width: 100%;
            height: 30px;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #B4D4FF;
            border: none;
            border-radius: 15px;
            font-size: 16px;
        }

        /* Warna teks placeholder */
        .input-field::placeholder {
            color: #00449E; /* Mengubah warna placeholder */
            opacity: 0.5; /* Agar placeholder tipis tipis */
        }

        /* Gaya saat input field mendapat fokus */
        .input-field:focus {
            outline: none; /* Menghilangkan outline yang muncul saat elemen mendapat fokus */
            border: 1px solid #86B6F6; /* Ganti warna border saat fokus */
            color: #00449E; /* Warna teks tetap sama */
            background-color: #E1EFFF; /* Warna latar belakang berubah sedikit lebih terang saat fokus */
        }

        /* Menjaga warna teks tetap setelah kehilangan fokus */
        .input-field:not(:focus) {
            color: #00449E; /* Menjaga warna teks tetap biru setelah fokus hilang */
        }

        .login-btn {
            width: 110%;
            padding: 10px 20px; /* Ukuran tombol */
            font-family: 'Poppins', sans-serif; /* Gunakan font Poppins */
            font-weight: 600; /* Ketebalan font */
            font-size: 23px; /* Ukuran teks tombol */
            background-color: #86B6F6;
            color: #00449E;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px; /* Memberikan jarak antara tombol dengan input */
        }

        .login-btn:hover {
            color: #00387C; /* Warna teks hover */
            background-color: #5A94E1; /* Warna latar belakang hover */
        }

        .signup-link {
            text-align: center;
            margin-top: 15px;
        }

        .signup-link a {
            color: #00449E;
            text-decoration: none;
            font-size: 16px;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Logo di pojok kiri -->
    <img src="img/logoteks.png" alt="Logo Hospity" class="logo">

    <!-- Hero image yang tetap di pojok kanan dan menghilang -->
    <img src="img/heroimg.png" alt="Logo Hospity" class="fade-image">

    <!-- Form Login -->
    <div class="login-container">
        <h1>Login</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="input-field" placeholder="" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="input-field" placeholder="" required>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <div class="signup-link">
            <p>Don't have an account? <a href="{{ route('signup') }}">Sign up</a></p>
        </div>
    </div>
</body>
</html>
