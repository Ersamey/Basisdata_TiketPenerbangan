<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
require 'function.php';
$tr = tampiltransaksi();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <style>
        body {
            background-color: #3498db;
            border-radius: 8px;
            text-align: center;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1 {
            color: #fff;
            font-size: 36px;
            margin-top: 100px;
            margin-bottom: 20px;
        }

        h2 {
            color: #fff;
            font-size: 30px;
            margin-top: 50px;
            margin-bottom: 20px;
        }

        form {
            max-width: 450px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .select-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        label {
            display: block;
            margin-bottom: 20px;
            font-size: 20px;
            color: #000;
        }

        .harga_kelas {
            display: block;
            margin-bottom: 20px;
            font-size: 20px;
            color: #fff;
        }


        .kelas {
            flex: 1;
        }

        select,
        button {
            display: block;
            width: calc(100% - 20px);
            margin: 10px auto;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        select,
        button {
            cursor: pointer;
        }

        button {
            background-color: #45AAD6;
            color: #fff;
            border: none;
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
            margin-left: 5px;
        }

        .image-container:hover {
            transform: scale(1.2);
        }

        #seat-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        #seat-container label {
            width: 50px;
            height: 50px;
            margin: 5px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        #seat-container label.selected {
            background-color: #3498db;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="image-container">
        <a href="home.php">
            <img src="panah.png" alt="panah">
        </a>
    </div>
    <h1>Pilih Kelas Anda</h1>

    <form action="" method="post">
        <label for="kelas">Pilih Kelas:</label>
        <select name="kelas" id="kelas">
            <option value="eksekutif">Eksekutif</option>
            <option value="bisnis">Bisnis</option>
            <option value="ekonomi">Ekonomi</option>
        </select>
        <button type="submit">Pilih</button>
    </form>
    <?php
    $rows = tampiltransaksi();
    $row = $rows[count($rows) - 1];

  ?>
    <?php
    if (isset($_POST["kelas"])) {
        $kelas = $_POST["kelas"];
        $maks = 0;
            
        if ($kelas == "eksekutif") {
            $edit = editransaksi($kelas);
            $kt = kursitransaksi($row["id_jadwal"], 1);
            harga();
            $q = "SELECT * FROM kelas WHERE id = 1";
            $k = mysqli_query($db, $q);
            $kls = mysqli_fetch_assoc($k);
            ?>
            <label for="">Tambahan : <?= $kls["harga_kelas"] ?></label><br>
            <h2>Silahkan Pilih Kursi</h2>
            <?php
            $pesawat = $row["id_pesawat"];
            $q = "SELECT * FROM pesawat WHERE id = $pesawat";
            $p = mysqli_query($db, $q);
            $psw = mysqli_fetch_assoc($p);
            $q = "SELECT * FROM kategori INNER JOIN pesawat ON kategori.id = pesawat.id_kategori";
            $k = mysqli_query($db, $q);
            $kat = mysqli_fetch_assoc($k);
            $maks = $kat["kapasitas_eksekutif"];
            ?>
            <div id="seat-container">
                <form action="transaksi.php" method="post">
                <?php
                    for ($j = 1; $j <= $maks; $j++) {
                        $skip = 0;
                        for ($i = 0; $i < count($kt); $i++) {
                            if ($j == $kt[$i]["kursi"]) {
                                $skip = 1;
                                break;
                            } 
                        }
                        if ($skip == 0) {
                            echo '<label><input type="radio" name="selected_seat" value="' . $j . '">' . $j . '</label>';
                        }
                    }
                ?>
                    <button type="submit">Pilih</button>
                </form>
            </div>
        <?php
        } else if ($kelas == "bisnis") {
            $edit = editransaksi($kelas);
            $kt = kursitransaksi($row["id_jadwal"], 2);
            harga();
            $q = "SELECT * FROM kelas WHERE id = 2";
            $k = mysqli_query($db, $q);
            $kls = mysqli_fetch_assoc($k);
            ?>
            <label for="">Tambahan : <?= $kls["harga_kelas"] ?></label><br>
            <h2>Silahkan Pilih Kursi</h2>
            <?php
            $pesawat = $row["id_pesawat"];
            $q = "SELECT * FROM pesawat WHERE id = $pesawat";
            $p = mysqli_query($db, $q);
            $psw = mysqli_fetch_assoc($p);
            $q = "SELECT * FROM kategori INNER JOIN pesawat ON kategori.id = pesawat.id_kategori";
            $k = mysqli_query($db, $q);
            $kat = mysqli_fetch_assoc($k);
            $maks = $kat["kapasitas_bisnis"];
             ?>
            <div id="seat-container">
                <form action="transaksi.php" method="post">
                <?php
                    for ($j = 1; $j <= $maks; $j++) {
                        $skip = 0;
                        for ($i = 0; $i < count($kt); $i++) {
                            if ($j == $kt[$i]["kursi"]) {
                                $skip = 1;
                                break;
                            } 
                        }
                        if ($skip == 0) {
                            echo '<label><input type="radio" name="selected_seat" value="' . $j . '">' . $j . '</label>';
                        }
                    }
                ?>
                    <button type="submit">Pilih</button>
                </form>
            </div>
        <?php
        } else if ($kelas == "ekonomi") {
            $edit = editransaksi($kelas);
            $kt = kursitransaksi($row["id_jadwal"], 3);
            harga();
            $q = "SELECT * FROM kelas WHERE id = 3";
            $k = mysqli_query($db, $q);
            $kls = mysqli_fetch_assoc($k);
            ?>
            <label for="">Tambahan : <?= $kls["harga_kelas"] ?></label><br>
            <h2>Silahkan Pilih Kursi</h2>
            <?php
            $pesawat = $row["id_pesawat"];
            $q = "SELECT * FROM pesawat WHERE id = $pesawat";
            $p = mysqli_query($db, $q);
            $psw = mysqli_fetch_assoc($p);
            $q = "SELECT * FROM kategori INNER JOIN pesawat ON kategori.id = pesawat.id_kategori";
            $k = mysqli_query($db, $q);
            $kat = mysqli_fetch_assoc($k);
            $maks = $kat["kapasitas_ekonomi"];
            ?>
            <div id="seat-container">
                <form action="transaksi.php" method="post">
                <?php
                    for ($j = 1; $j <= $maks; $j++) {
                        $skip = 0;
                        for ($i = 0; $i < count($kt); $i++) {
                            if ($j == $kt[$i]["kursi"]) {
                                $skip = 1;
                                break;
                            } 
                        }
                        if ($skip == 0) {
                            echo '<label><input type="radio" name="selected_seat" value="' . $j . '">' . $j . '</label>';
                        }
                    }
                ?>
                    <button type="submit">Pilih</button>

                </form>
            </div>
        <?php
        }
    }
    ?>

</body>

</html>