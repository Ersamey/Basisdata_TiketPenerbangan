<?php
session_start();
if (isset($_SESSION["login"])) {
    header("Location: home.php");
    exit;
}
require 'function.php';
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row["password"]) {
            $_SESSION["login"] = true;
            $_SESSION["username"] = $username; //simpan username ke session
            //simpan id ke session
            $_SESSION["id"] = $row["id"];
            
            header("Location: home.php");
            exit;
        } else {
            $error_message = "Incorrect password. Please try again.";
        }
    } else {
        $error_message = "Username not found. Please check your username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerbangan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <style>
        body {
            background-color: #45AAD6;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-family: 'Poppins', Arial, sans-serif;
            background-image: url(pesawat.png);
            background-size: 500px;
            background-repeat: no-repeat;
            background-position-y: 100px;
            background-position-x: 20px;
        }

        .bentuk {
             
        }

        h1 {
            color: #fff;
            font-size: 50px;
            margin-bottom: 100px;
        }

        h2 {
            color: #fff;
            font-size: 30px;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        form:hover {
            transform: scale(1.02);
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
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #45AAD6;
        }

        button {
            padding: 12px 24px;
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
    <h1>Welcome to Go2Fly!</h1>
    <h2>Silahkan Login</h2>

    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

    <form action="" method="post">
        <label for="username">Username: </label>
        <input type="text" name="username" required>
        <label for="password">Password: </label>
        <input type="password" name="password" required>
        <button type="submit" name="submit">Login</button>
    </form>

    <a href="regis.php">Belum punya akun? Daftar</a>
</body>

</html>