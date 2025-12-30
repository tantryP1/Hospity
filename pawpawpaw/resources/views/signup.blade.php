<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Hospity</title>
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
            position: relative;
        }

        /* Logo di pojok kiri atas halaman */
        .logo {
            position: absolute;
            top: 25px; /* Jarak dari atas */
            left: 25px; /* Jarak dari kiri */
            width: 200px; /* Ukuran logo */
            height: auto;
        }

        /* Blob decoration */
        .blob-left {
            position: absolute;
            bottom: 0;
            left: 0px; /* Menentukan jarak dari sisi kiri */
            z-index: -1;
            width: 350px;  /* Ukuran gambar blob kiri */
            height: auto;
        }

        .blob-right {
            position: absolute;
            bottom: 0;
            right: 0px; /* Menentukan jarak dari sisi kanan */
            z-index: -1;
            width: 350px;  /* Ukuran gambar blob kanan */
            height: auto;
        }

        .signup-container {
            position: absolute;
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
            font-weight: 800;
            font-size: 70px;
            margin: 10px 0;
            color: #176B87;
        }

        p {
            color: #00449E;
        }

        .input-field {
            font-family: 'Poppins', sans-serif;
            width: 100%;
            height: 20px;
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

        .signup-btn {
            width: 110%;
            padding: 10px 20px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 23px;
            color: #00449E;
            background-color: #86B6F6;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 15px; /* Memberikan jarak antara tombol dengan input */
        }

        .signup-btn:hover {
            color: #00387C; /* Warna teks hover */
            background-color: #5A94E1; /* Warna latar belakang hover */
        }

        .login-link {
            text-align: center;
            margin-top: 5px;
        }

        .login-link a {
            color: #00449E;
            text-decoration: none;
            font-size: 16px;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Logo di pojok kiri -->
    <img src="img/logoteks.png" alt="Logo Hospity" class="logo">

    <!-- Form Signup -->
    <div class="signup-container">
        <h1>Sign Up</h1>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input type="text" class="input-field" name="nama" placeholder="Full Name" required>
            <input type="text" class="input-field" name="nik" placeholder="NIK" required>
            <input type="text" class="input-field" name="no_telp" placeholder="Phone Number" required>
            <input type="email" class="input-field" name="email" placeholder="Email" required>
            <input type="password" class="input-field" name="password" placeholder="Password" required>
            <button type="submit" class="signup-btn">Sign Up</button>
        </form>
        <div class="login-link">
            <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>

    <!-- Blob decorations -->
    <!-- Menambahkan gambar blob-->
    <img src="img/blobleft.png" class="blob-left" alt="Blob Left">
    <img src="img/blobright.png" class="blob-right" alt="Blob Right">
</body>
</html>
