<?php  
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
require 'function.php';
$rows = jointiket( $_GET["id"]);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equuiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Tiket Pesawat</title>
        <style>
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
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="image-container">
        <a href="home.php">
            <img src="panah.png" alt="panah">
        </a>
    </div>
        <div class="ticket">
            <div class="ticket-header">
                <div class="head-logo">
                    Indonesia
                </div>
                <div class="head-flight">
                    Go2Fly
                </div>
            </div>

            <div class="ticket-body">

                <div class="locations">
                    <div class="loc-depart">
                        <?= $rows[0]["locasal"]; ?>
                        <h1><?= $rows[0]["asal"]; ?></h1>
                        <?= $rows[0]["jam_keberangkatan"]; ?>
                    </div>
                    <div calss="loc-directions">
                        <div class="arrow"></div>
                    </div>
                    <div class="loc-arrive">
                    <?= $rows[0]["loctujuan"]; ?>
                        <h1><?= $rows[0]["tujuan"]; ?></h1>
                        
                    </div>
                </div>

                <div class="body-info">
                    <div class="info">
                        <div class="info-name">
                            Passenger 
                            <h2><?= $rows[0]["nama_penumpang"]; ?></h2>
                        </div>
                        <div class="info-seat">
                            Seat
                            <h2><?= $rows[0]["kursi"]; $rows[0]["nama_kelas"] ?></h2>
                        </div>
                    </div>
                    <div class="flight">
                        <div class="flight-info">
                            Flight
                            <h2>ID <?= $rows[0]["kode_tiket"]; ?></h2>
                        </div>
                        <div class="flight-depart-date">
                            Depart Date
                            <h2><?= $rows[0]["tanggal_keberangkatan"]; ?></h2>
                        </div>
                        <div class="flight-depart-time">
                            Depart Time
                            <h2><?= $rows[0]["jam_keberangkatan"]; ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ticket-bottom">
                <div class="bottom-info">
                    <div class="depart">
                        <div>
                            Airplane Code
                            <h2><?= $rows[0]["kode_pesawat"]; ?></h2>
                        </div>
                        <div>
                            Boarding
                            <h2><?= $rows[0]["jam_keberangkatan"]; ?></h2>
                        </div>
                    </div>

                    <div class="depart-barcode"></div>
               
                </div>

            </div>

        </div>
    </body>
</html>