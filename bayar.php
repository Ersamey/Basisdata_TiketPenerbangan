<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <style>
        body {
            background-color: #45AAD6;
            padding: 20px;
            border-radius: 8px;
            font-family: 'Poppins', Arial, sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h1 {
            text-align: center;
            color: #fff;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #45AAD6;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #2E7DA4;
        }

        .image-container {
            float: left;
            display: inline-block;
            padding: 10px 25px;
            border: 1px solid transparent;
            border-radius: 5px;
            transition: transform .4s;
        }

        .image-container img {
            width: 30%;
            height: auto;
            margin-top: ;
            margin-left: -25px;
        }

        .image-container:hover {
            transform: scale(1.2);
        }

    </style>
</head>

<body>
    <div class="image-container">
        <a href="riwayat.php">
            <img src="panah.png" alt="panah">
        </a>
    </div>
    <h1>Silahkan Lakukan Pembayaran</h1>
    <form action="riwayat.php" method="post">
        <label for="nomortransaksi">Nomor Transaksi</label>
        <input type="text" name="kodetiket" id="kodetiket" required>

        <label for="buktipembayaran">Unggah Bukti Pembayaran</label>
        <input type="file">

        <button type="submit">Bayar</button>
    </form>
</body>

</html>
