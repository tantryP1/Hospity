<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Untuk font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <title>Feedback Form</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EEF5FF;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        textarea {
            width: 560px;
            height: 150px;
            background-color: #b4d4ff;
            margin-top: 10px;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #B4D4FF;
            border-radius: 10px;
            resize: none;
            position: relative;
        }

        .textarea-container {
            position: relative;
        }

        .word-count {
            position: absolute;
            bottom: 10px;
            right: 50px;
            font-size: 0.7em;
            color: #00449E;
            pointer-events: none;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 15px 0;
            justify-content: center;
        }

        .tag {
            background-color: #FFF;
            color: #00449E;
            border: 1px solid #00449E;
            border-radius: 20px;
            padding: 8px 15px;
            font-size: 0.9em;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .tag:hover {
            background-color: #ddd;
        }

        .tag.selected {
            background-color: #00449E;
            color: #fff;
        }

        .submit-button {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 20px auto 0;
            background-color: #176B87;
            color: #FFF;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #0d3b4b;
        }

        h1 {
            color: #176B87;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Apa Tanggapanmu Tentang Hospity?</h1>
        <form id="feedbackForm">
            @csrf
            <div class="textarea-container">
                <textarea id="feedback" placeholder="Tulis disini ..." maxlength="300" oninput="updateWordCount()"></textarea>
                <div class="word-count" id="wordCount">0/300 Kata</div>
            </div>
            <!-- Tag untuk memilih id_doctor -->
            <div class="tags">
                <div class="tag" data-id="1" onclick="selectDoctor(this)">Cardiology</div>
                <div class="tag" data-id="2" onclick="selectDoctor(this)">Neurology</div>
                <div class="tag" data-id="3" onclick="selectDoctor(this)">Pediatrics</div>
                <div class="tag" data-id="4" onclick="selectDoctor(this)">Orthopedics</div>
                <div class="tag" data-id="5" onclick="selectDoctor(this)">Dermatology</div>
            </div>
            <p id="selectedDoctor" style="margin-top: 10px; color: #176B87; text-align:center">Tidak ada dokter yang dipilih.</p>
            <button class="submit-button" type="submit">Kirim</button>
        </form>
    </div>
    <script src="{{ asset('js/feedback.js') }}"></script>
</body>
</html>
