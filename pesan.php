<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
?>
<?php
$idjdl = $_GET["id"]; //id jadwal yang dipilih
$id_user = $_SESSION["id"];


require 'function.php';
if (isset($_POST["submit"])) {
    if ($_POST["no_ktp"] == "" || $_POST["nama_penumpang"] == "" || $_POST["no_telp"] == "") {
        echo "<script>
        alert('Data tidak boleh kosong!');
        </script>";
    } else {
        if (tambahpenumpang($_POST) > 0) {
            $trans = insertransaksi($idjdl, $id_user); //insert ke tabel transaksi
            $upharga = harga();
            echo "
            <script>
                var yakin = confirm('Apaka data sudah sesuai?');
                if(yakin === true){
                    document.location.href = 'kursi.php';
                } 
            </script>";
        } else {
            echo "data gagal ditambahkan";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #45AAD6;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #fff;
            margin-top: 100px;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            width: calc(100% - 20px);
            margin: 5px auto;
            padding: 10px;
            font-family: 'Poppins', sans-serif;
        }

        input,
        button {
            display: block;
            width: calc(100% - 20px);
            margin: 5px auto;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-family: 'Poppins', sans-serif;
        }

        input[type="text"] {
            width: calc(100% - 22px);
        }

        button {
            background-color: #45AAD6;
            color: #fff;
            border: none;
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
            margin-left: 5px;
        }

        .image-container:hover {
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <div class="image-container">
        <a href="pesantiket.php">
            <img src="panah.png" alt="panah">
        </a>
    </div>
    <h1>Silahkan Isi Data Penumpang</h1>
    <form action="" method="post">
        <label for="no_ktp">NIK: </label>
        <input type="text" name="no_ktp">
        <br>
        <label for="nama_penumpang">Nama : </label>
        <input type="text" name="nama_penumpang">
        <br>
        <label for="no_telp">No HP : </label>
        <input type="text" name="no_telp">
        <br>
        <button type="submit" name="submit">Pesan</button>
    </form>
</body>

</html>
