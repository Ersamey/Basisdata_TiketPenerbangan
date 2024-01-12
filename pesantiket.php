<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
?>
<?php
require 'function.php';

if (isset($_POST["submit"])) {
    $asal = $_POST["asal"];
    $tujuan = $_POST["tujuan"];
    // var_dump($asal);
    // var_dump($tujuan);
    if ($asal != $tujuan) {
        $rute = rute($_POST); //id rute yang dipilih
        // var_dump($rute);
        $jd = jadwal($rute); //beberapa jadwal yang tersedia sesuai rute
        // var_dump($jd);
        $showjadwal = tampilkanjadwal($jd);
    } else {
        echo "Jadwal tidak tersedia";
    }

    //  cek tombol pesan 
    // if(isset($_POST["pesan"])){
    //     var_dump($_POST);
    // }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rute</title>
    <!-- Add the Poppins font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <style>
        body {
            background-color: #45AAD6;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        h1 {
            text-align: center;
            color: #fff;
            margin-top: 100px;
        }

        form {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .select-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .asal,
        .tujuan {
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
            width: calc(100% - 20px);
        }

        button:hover {
            background-color: #2E7DA4;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 115%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            padding: auto;
            background-color: #2E7DA4;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            text-decoration: none;
            color: #fff;
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
    <h1>Silahkan Pilih Kota Asal dan Tujuan</h1>
    <!-- pilihan pada selection tidak berubah meskipun menekan submit -->
    <form action="" method="post">
        <div class="select-wrapper">
            <div class="asal">
                <label for="asal">Pilih Kota Asal</label>
                <select name="asal" id="asal">
                    <option value="1">Jakarta</option>
                    <option value="2">Bali</option>
                    <option value="3">Sulawesi Tengah</option>
                    <option value="4">Sumatera Barat</option>
                </select>
            </div>
            <div class="tujuan">
                <label for="tujuan">Pilih Kota Tujuan</label>
                <select name="tujuan" id="tujuan">
                    <option value="1">Jakarta</option>
                    <option value="2">Bali</option>
                    <option value="3">Sulawesi Tengah</option>
                    <option value="4">Sumatera Barat</option>
                </select>
            </div>
        </div>
        <br>
        <button type="submit" name="submit">Cari</button>
    </form>
    <br>
    <?php if (isset($showjadwal)): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Pesawat</th>
                <th>Bandara Asal</th>
                <th>Bandara Tujuan</th>
                <th>Jam Keberangkatan</th>
                <th>Tanggal Keberangkatan</th>
                <th>Harga</th>
                <th>Action</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($showjadwal as $row): ?>
                <tr>
                    <td>
                        <?= $i; ?>
                    </td>
                    <td>
                        <?= $row["nama_pesawat"]; ?>
                    </td>
                    <td>
                        <?= $row["bandara_asal"]; ?>
                    </td>
                    <td>
                        <?= $row["bandara_tujuan"]; ?>
                    </td>
                    <td>
                        <?= $row["jam_keberangkatan"]; ?>
                    </td>
                    <td>
                        <?= $row["tanggal_keberangkatan"]; ?>
                    </td>
                    <td>
                        <?= $row["harga"]; ?>
                    </td>
                    <td>
                        <!-- simpan $row[id] yang diklik ke $_get[rute]-->
                        <button>
                        <a href="pesan.php?id=<?= $row["id"]; ?>" name="rute" value= <?php $row["id"] ?> method="get">Pesan</a>
                    </td>
                        </button>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>

</html>