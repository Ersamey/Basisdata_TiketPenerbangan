<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require 'function.php';
$id = $_SESSION["id"];
$rw = riwayat($id); //transaksi yang dilakukan user
$trans = tampiltransaksi();
$rows = [];
foreach ($trans as $row) {
    if ($row["id_user"] == $id) {
        $rows[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <style>
        body {
            background-color: #45AAD6;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-family: 'Poppins', Arial, sans-serif; /* Updated font-family */
        }

        h1 {
            color: #fff;
            font-size: 36px;
            margin-top: 100px;
            margin-bottom: -200px; /* Menambah margin-bottom */
        }

        table {
            margin: 0 auto 20px;
            border-collapse: collapse;
            width: 80%;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 8px solid #297EB5;
            padding: 3px;
            position: relative;
        }

        th {
            background-color: #45AAD6;
            color: #fff;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .a {
            text-align: right;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #45AAD6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-right: 30px;
        }

        .button:hover {
            background-color: #2E7DA4;
        }

        .atribut {
            text-align: left;
            margin-left: 85px;
            margin-top: 10px;
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

        .image-container2 {
            position: absolute;
            left: -20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .image-container2 img {
            width: 130px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="image-container">
        <a href="home.php">
            <img src="panah.png" alt="panah">
        </a>
    </div>
    <h1>Ini adalah Riwayat Pemesanan Tiket Kamu</h1>
    <table border="3">
        <?php foreach ($rows as $row): ?>
            <tr>
                <td>
                    <div class="image-container2">
                        <img src="pesawatkecil.png" alt="pesawat">
                    </div>
                    <div class="atribut">
                        <?= $row["asal"]; ?> -
                        <?= $row["tujuan"]; ?>
                        <br>
                        <?= $row["tanggal"]; ?> -
                        <?= $row["waktu_keberangkatan"]; ?>
                        <?= $row["id"]; ?>
                    </div>
                    <br>
                    <label for="status"><?= $row["status_pembayaran"]; ?></label>
                    <br>
                    
    
                    <?php
                      
                    if ($row["status_pembayaran"] == "Berhasil"): ?>
                        <div class="a">
                            <a class="button" href="tiket.php?id=<?= $row["id"]?>" >Lihat Tiket </a>
                        </div>
                    <?php else: ?>
                        <div class="a">
                            <a class="button" href="bayar.php?id=<?= $row["id"]?>" >Bayar</a>
                            <form method="post" action="">
                        <button type="submit" onclick="confirmCancellation(<?= $row['id'] ?>)" name="batal" value="<?= $row["id"] ?>">Batal</button>
                    </form>

                    <?php
                    if (isset($_POST["batal"])) {
                        $id_transaksi = $_POST["batal"];
                        ?>
                        <script>
                        function confirmCancellation(id) {
                            var yakin = confirm("Apakah anda yakin ingin membatalkan tiket?");
                            if (yakin) {
                                // User confirmed, perform cancellation
                                window.location.href = 'riwayat.php?batal=' + id;
                            }
                        }
                        </script>
                           <?php
                            $ht = hapustiket($id_transaksi);
                            $batal = hapustransaksi($id_transaksi);
                            if ($batal > 0) {
                                echo "<script>
                                    alert('Tiket berhasil dibatalkan');
                                    window.location.href = 'riwayat.php'; // Redirect to the same page after cancellation
                                   </script>";
                            } else {
                                echo "<script>
                                    alert('Tiket gagal dibatalkan');
                                    </script>";
                            }
                        }
                            ?>
                        </div>
                        <?php
                        $bayar = Addtiket($row["id"])
                        ?>
                    <?php endif; ?>
                </td>
            </tr>
            <br>
        <?php endforeach; ?>
    </table>
</body>

</html>

