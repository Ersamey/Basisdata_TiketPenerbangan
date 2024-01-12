<?php

require 'function.php';
//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    //ambil data dari tiap elemen dalam form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    $query = "SELECT username FROM user WHERE username = '$username'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) !== 1) {
        if ($password !== $password2) {
            echo "<script>
            alert('konfirmasi password tidak sesuai');
            </script>";
            // return false;
        } else {
            if (tambah($_POST) > 0) {
                echo "
                <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'home.php';
                </script>";
            } else {
                echo "data gagal ditambahkan";
            }
        }
    } else {
        echo "<script>
        alert('username sudah terdaftar');
        </script>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regis</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <style>
        body {
            background-color: #45AAD6;
            padding: 20px;
            color: #000;
            border-radius: 8px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        h1 {
            color: #fff;
            font-size: 36px;
            margin-top: 100px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        label {
            text-align: left;
            display: block;
            width: calc(100% - 20px);
            margin: 5px auto;
            padding: 10px;
            font-family: 'Poppins', sans-serif;
        }

        input {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 20px;
            background-color: #45AAD6;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
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

        a {
            display: block;
            color: #fff;
            margin-top: 20px;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #2E7DA4;
        }

    </style>
</head>

<body>
    <div class="image-container">
        <a href="index.php">
            <img src="panah.png" alt="panah">
        </a>
    </div>
    <h1>Silahkan Registrasi</h1>
    <form action="" method="post">
        <label for="username">Masukan Username : </label>
        <input type="text" name="username">
        <br>
        <label for="password">Masukan Password : </label>
        <input type="password" name="password">
        <br>
        <label for="password2">Konfirmasi Password : </label>
        <input type="password" name="password2">
        <br>
        <button type="submit" name="submit">Daftar</button>
        <br>
    </form>
    <br>
    <a href="index.php">Sudah punya akun, Masuk!</a>
</body>

</html>