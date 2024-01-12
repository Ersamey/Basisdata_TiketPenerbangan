<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <style>
        body {
            background-color: #45AAD6;
            padding: 20px;
            color: #fff;
            border-radius: 8px;
            font-family: 'Poppins', Arial, sans-serif;
            position: relative;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .user-info {
            text-align: left;
        }

        h1 {
            color: #fff;
            font-size: 24px;
            margin: 0;
        }

        h2 {
            color: #fff;
            font-size: 34px;
            margin-bottom: 20px;
        }

        .menu {
            text-align: center;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            color: #fff;
            background-color: #45AAD6;
            border: 2px solid #fff;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        a:hover {
            background-color: #fff;
            color: #45AAD6;
        }

        .logout-btn {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .logout-btn:hover {
            background-color: #dc3545;
            color: #fff;
            transform: scale(1.02);
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="user-info">
            <h1>Hallo <?= $_SESSION["username"] ?></h1>
        </div>
        <a href="logout.php" class="logout-btn">Keluar</a>
    </div>

    <div class="menu">
        <h2>Menu</h2>
        <a href="pesantiket.php">Pesan Tiket</a>
        <a href="riwayat.php">Lihat Riwayat</a>
        <a href="jadwal.php">Lihat Jadwal</a>
    </div>

</body>

</html>
