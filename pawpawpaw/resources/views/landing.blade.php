<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Untuk font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Welcome to Hospity!</title>
    <style>
        /* Atur halaman */
        body {
            display: flex; /* Menggunakan Flexbox */
            flex-direction: column; /* Tata elemen secara vertikal */
            justify-content: center; /* Pusatkan secara horizontal */
            align-items: center; /* Menyusun secara vertikal */
            height: 100vh; /* Tinggi halaman penuh */
            margin: 0; /* Hilangkan margin bawaan */
            background-color: #EEF5FF; /* Ubah warna background menjadi biru muda */
        }

        /* Atur gambar */
        img {
            max-width: 35%; /* Batas ukuran gambar */
            margin-bottom: 20px; /* Jarak antara gambar dan tombol */
        }

        /* Atur tombol */
        .buttons {
            display: flex; /* Tata tombol secara horizontal */
            flex-direction: column; /* Tata tombol secara vertikal */
            gap: 15px; /* Jarak antara tombol */
            width: 100%; /* Sesuaikan lebar tombol */
            max-width: 250px; /* Maksimal lebar tombol */
        }

        button {
            padding: 10px 20px; /* Ukuran tombol */
            font-family: 'Poppins', sans-serif; /* Gunakan font Poppins */
            font-weight: 600; /* Ketebalan font */
            font-size: 23px; /* Ukuran teks tombol */
            color: #00449E; /* Warna teks */
            background-color: #86B6F6; /* Warna latar belakang tombol */
            border: none; /* Hilangkan border */
            border-radius: 30px; /* Sudut melengkung */
            cursor: pointer; /* Ubah kursor menjadi tangan saat hover */
            transition: background-color 0.3s ease; /* Animasi saat hover */
        }

        button:hover {
            color: #00387C; /* Warna teks hover */
            background-color: #5A94E1; /* Warna latar belakang hover */
        }

    </style>
</head>
<body>
    <!-- Logo -->
    <img src="{{ asset('img/logo.png') }}" alt="Logo Hospity">

    <!-- Tombol Login dan Sign Up -->
    <div class="buttons">
        <button onclick="window.location.href='<?php echo route('loginpage'); ?>'">Login</button>
        <button onclick="window.location.href='<?php echo route('signup'); ?>'">Sign Up</button>
    </div>
</body>
</html>