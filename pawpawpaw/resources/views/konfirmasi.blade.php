<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi</title>
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

        .konfirmasi-container {
            position: absolute;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            display: flex; /* Menggunakan flexbox */
            flex-direction: column; /* Menyusun elemen secara vertikal */
            justify-content: center; /* Memusatkan konten secara vertikal */
            align-items: center; /* Memusatkan konten secara horizontal */
        }

        .done {
            width: 300px;
            height: auto;
        }

        h1 {
            text-align: center;
            font-weight: 500;
            font-size: 70px;
            margin: 0;
            color: #00449E;
        }

        p {
            color: #00449E;
            font-size: 20px;
            font-weight: 300;
            text-align: center;
            margin: 5px;
        }

        .detail-btn {
            width: 55%;
            padding: 10px 20px;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 20px;
            text-align: center;
            color: #FFF;
            background-color: #176B87;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px; /* Memberikan jarak antara tombol dengan input */
        }

        .detail-btn:hover {
            color: #EEF5FF; /* Warna teks hover */
            background-color: #5A94E1; /* Warna latar belakang hover */
        }
    </style>
</head>
<body>
    <div class="konfirmasi-container">
        <img src="{{ asset('img/done.png') }}" alt="Logo Hospity" class="done">
        <h1>Selamat!</h1>
        <p>Reservasi Anda telah berhasil dibuat.</p>
        <p>Silahkan periksa detail reservasi Anda disini.</p>
        <a href="{{ url('/qr/' . $id) }}" class="detail-btn">Detail Reservasi</a>
    </div>

    <!-- Blob decorations -->
    <!-- Menambahkan gambar blob-->
    <img src="{{ asset('img/blobleft.png') }}" class="blob-left" alt="Blob Left">
    <img src="{{ asset('img/blobright.png') }}" class="blob-right" alt="Blob Right">
</body>
</html>