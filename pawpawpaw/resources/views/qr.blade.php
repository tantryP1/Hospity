<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
    <!-- Untuk font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #EEF5FF; /* Latar belakang halaman */
            font-family: 'Poppins', sans-serif;
        }

        .qr-container {
            text-align: center;
            padding: 20px;
            background-color: #FFFFFF;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .qr-code {
            margin-bottom: 20px;
        }

        .qr-code img {
            height: auto;
            width: 300px;
        }

        .btn-detail {
            display: inline-block;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: 500;
            color: #FFFFFF;
            background-color: #176B87;
            border: none;
            border-radius: 30px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-detail:hover {
            background-color: #5A94E1;
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
    </style>
</head>
<body>
    <div class="qr-container">
        <!-- QR Code Placeholder -->
        <div class="qr-code" id="qrcode">
            <img src="{{ asset('qrcodes/' . $id . '.png') }}" alt="QR Code" />
        </div>
        <!-- Detail Button -->
        <a href="{{ url('/countdown/' . $id) }}" class="btn-detail">Detail Antrean</a>
    </div>
    <!-- Blob decorations -->
    <!-- Menambahkan gambar blob-->
    <img src="{{ asset('img/blobleft.png') }}" class="blob-left" alt="Blob Left">
    <img src="{{ asset('img/blobright.png') }}" class="blob-right" alt="Blob Right">
</body>
</html>