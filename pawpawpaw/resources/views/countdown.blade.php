<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Untuk font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <title>Antrean Pasien</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            padding: 20px;
            border-radius: 10px;
            width: 40%;
        }

        .box.left {
            background-color: #dceeff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .waiting-time-container {
            background-color: #00449E;
            color: white;
            padding-top: 5px;
            padding-right: 40px;
            padding-left: 40px;
            margin-top: 5px;
            border-radius: 45px;
            font-size: 1.5em;
            text-align: center;
            z-index: 2;
            position: relative;
        }

        .waiting-time-container p:first-child {
            font-size: 1em;
            font-weight: normal;
        }

        .waiting-time-container h2 {
            margin: 0;
        }

        .box.right {
            display: grid;
            grid-template-rows: 1fr 1fr;
            gap: 20px;
        }

        .box1, .box2 {
            background-color: #dceeff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin: 0 0 10px;
            color: #00449E;
        }

        p {
            margin: 5px 0;
            font-size: 18px;
        }

        #current-queue {
            font-size: 5em;
            font-weight: bold;
            color: #00449E;
        }

        #next-queue, #current-serving {
            font-size: 2.5em;
            font-weight: bold;
            color: #00449E;
        }
        #waiting-time {
            color: #f0f8ff;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding-bottom: 1%;
        }
        .waiting-time-container #teks-khusus {
            font-size: 15px;
            word-spacing: 10px;
            padding: 0;
            margin-top: -5px;
            font-weight: lighter;
            
        }
        #spesifik {
            color: #00449E;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box left">
            <h2>Antrean Nomor</h2>
            <p id="current-queue">18</p>
            <p id="spesifik">Estimasi Waktu Tunggu</p>
            <div class="waiting-time-container">
                <h2 id="waiting-time">01:05:00</h2>
                <p id="teks-khusus">hr min sec</p>
            </div>
        </div>
        <div class="box right">
            <div class="box1">
                <p>Antrean yang Akan Datang</p>
                <p id="next-queue">2</p>
            </div>
            <div class="box2">
                <p>Antrean yang Sedang Berlangsung</p>
                <p id="current-serving">1</p>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/countdown.js') }}"></script>
</body>
</html>
