<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
require 'function.php';
$rows = jdl();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal</title>
    <style>
        body {
            background-color: #45AAD6;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #fff;
            font-size: 36px;
            margin-top: 100px;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 90%;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #45AAD6;
            color: #fff;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #45AAD6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
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
        <a href="home.php">
            <img src="panah.png" alt="panah">
        </a>
    </div>
    <h1>Berikut Jadwal Penerbangan Go2Fly</h1>
    <table>
        <tr>
            <th>No</th>
            <th>Asal</th>
            <th>Tujuan</th>
            <th>Pesawat</th>
            <th>Waktu</th>
            <th>Kelas</th>
            <th>Harga</th>
            <th>Pesan</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td>
                    <?= $i; ?>
                </td>
                <td>
                    <?= $row["bandara_asal"]; ?>
                </td>
                <td>
                    <?= $row["bandara_tujuan"]; ?>
                </td>
                <td>
                    <?= $row["nama_pesawat"]; ?>
                </td>
                <td>
                    <?= $row["tanggal_keberangkatan"]; ?>
                </td>
                <td>
                    <?= $row["jam_keberangkatan"]; ?>
                </td>
                <td>
                    <?= $row["harga"]; ?>
                </td>
                <td><a class="button" href="pesan.php?id=<?= $row["id"]; ?>">Pesan</a></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>