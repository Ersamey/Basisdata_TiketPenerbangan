<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
require 'function.php';
$tr = tampiltransaksi();
$k = $_POST["selected_seat"];
$kursibaru = editkursi($k);

if (isset($_POST["batal"])) {
    $id = $_POST["id"];
    $batal = hapustransaksi($id);
    if ($batal > 0) {
        echo "<script>
        alert('Tiket berhasil dibatalkan');
        document.location.href = 'home.php';
        </script>";
    } else {
        echo "<script>
        alert('Tiket gagal dibatalkan');
        document.location.href = 'home.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaksi</title>
  <style>
    body {
      background-color: #45AAD6;
      border-radius: 8px;
      text-align: center;
      font-family: Arial, sans-serif;
      color: #fff;
    }

    h1 {
      font-size: 36px;
      margin-top: 100px;
      margin-bottom: 20px;
    }

    table {
      margin: 0 auto;
      width: 80%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #fff;
      padding: 10px;
      text-align: left;
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

    form {
      margin-top: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    input[type="file"] {
      margin-bottom: 10px;
    }

    button {
      background-color: #3498db;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #2980b9;
    }
  </style>
</head>

<body>
  <div class="image-container">
    <a href="home.php">
      <img src="panah.png" alt="panah">
    </a>
  </div>
  <h1>Rincian Pembelian</h1>

  <?php
  $rows = tampiltransaksi();
  $row = $rows[count($rows) - 1];
  ?>

  <table>
    <tr>
      <td>Nama Maskapai:</td>
      <td><?= $row["nama_maskapai"] ?></td>
    </tr>
    <tr>
      <td>Nama Pesawat:</td>
      <td><?= $row["nama_pesawat"] ?></td>
    </tr>
    <tr>
      <td>Tanggal Keberangkatan:</td>
      <td><?= $row["tanggal"] . ' ' . $row["waktu_keberangkatan"] ?></td>
    </tr>
    <tr>
      <td>Lokasi Keberangkatan:</td>
      <td><?= $row["lokal"] ?></td>
    </tr>
    <tr>
      <td>Bandara Asal:</td>
      <td><?= $row["asal"] ?></td>
    </tr>
    <tr>
      <td>Lokasi Tujuan:</td>
      <td><?= $row["loktu"] ?></td>
    </tr>
    <tr>
      <td>Bandara Tujuan:</td>
      <td><?= $row["tujuan"] ?></td>
    </tr>
    <tr>
      <td>Harga Awal:</td>
      <td><?= $row["hargaawal"] ?></td>
    </tr>
    <tr>
      <td>Kelas:</td>
      <td><?= $row["nama_kelas"] ?></td>
    </tr>
    <tr>
      <td>Tambahan:</td>
      <td><?= $row["harga_kelas"] ?></td>
    </tr>
    <tr>
      <td>Seat:</td>
      <td><?= $row["kursi"] ?></td>
    </tr>
    <tr>
      <td>Total Harga:</td>
      <td><?= $row["harga"] ?></td>
    </tr>
  </table>

  <form action="riwayat.php" method="post" enctype="multipart/form-data">
    <label for="bukti">Kirim bukti pembayaran</label> <br>
    <label for="tf">Ke Nomor Rekening berikut : 327101041413533</label>
    <br>
    <label for="tf">Atas Nama : Go2Fly</label>
    <br>
    <label for="tf">Sebesar : <?= $row["harga"] ?></label>
    <br>
    <button type="submit" name="bayar">Bayar</button>
    <form method="post" action="">
      <button type="submit" onclick="confirmCancellation(<?= $row['id'] ?>)" name="batal" value="<?= $row["id"] ?>">Batal</button>
    </form>
    
    <!-- jika memilih batal maka hapustransaksi($row[id] jika bayar addtiket) -->
    <?php
  if (isset($_POST["batal"])) {
    $id_transaksi = $_POST["batal"];
    ?>
    <script>
    function confirmCancellation(id) {
      var yakin = confirm("Apakah anda yakin ingin membatalkan tiket?");
      if (yakin) {
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
    <?php
    if (isset($_POST["bayar"])) {
      $id = $row["id"];
      $bayar = Addtiket($row["id"]);
      if ($bayar > 0) {
        echo "<script>
        alert('Tiket berhasil dibeli');
        document.location.href = 'riwayat.php';
        </script>";
      } else {
        echo "<script>
        alert('Tiket gagal dibeli');
        document.location.href = 'riwayat.php';
        </script>";
      }
    }
    ?>


  </form>
</body>

</html>

