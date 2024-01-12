<?php
$db = mysqli_connect('localhost', 'root', '', 'penerbangan');

function tambah($data){
    global $db;
    $username = $data["username"];
    $password = $data["password"];
    $query = "INSERT INTO user VALUES ('','$username','$password')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function kursitransaksi($jadwal, $kelas){
    global $db;
    $query = "SELECT kursi FROM transaksi WHERE id_jadwal = $jadwal AND id_kelas = $kelas";
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function harga(){
    global $db;
    $query = "UPDATE transaksi AS t
    join (SELECT id_rute, id from jadwal) as j on t.id_jadwal = j.id
    join (SELECT harga, id from rute) as r on r.id = j.id_rute
    join (SELECT harga_kelas, id from kelas) as k on t.id_kelas = k.id
    set t.harga = r.harga + k.harga_kelas
    ";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function hapustransaksi($id){
    global $db;
    $query = "DELETE FROM transaksi WHERE id = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function hapustiket($id){
    global $db;
    $query = "DELETE FROM tiket WHERE id_transaksi = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function insertransaksi($id_jadwal, $id_user){
    global $db;
    $id_kelas = 1;
    $no_kursi = 1;
    $penumpang_query = mysqli_query($db, "SELECT id FROM penumpang ORDER BY id DESC LIMIT 1");
    $penumpang = mysqli_fetch_assoc($penumpang_query);
    $query = "INSERT INTO transaksi VALUES ('', '$id_jadwal', '$id_user', '{$penumpang['id']}', '', 'Diproses', '$id_kelas', '$no_kursi')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function Addtiket($id_transaksi){
    global $db;
    $kode = rand(1000040600, 9999999999);
    $query = "INSERT INTO tiket VALUES ('', '$id_transaksi', '$kode')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function jointiket($key){
    global $db;
    $query = "SELECT transaksi.id AS kunci, rute.harga AS hk, transaksi.harga, b1.lokasi_bandara AS locasal, b1.kode_bandara AS asal, b2.lokasi_bandara AS loctujuan, b2.kode_bandara AS tujuan, transaksi.kursi, transaksi.id_user, transaksi.id_jadwal, tiket.kode_tiket, jadwal.jam_keberangkatan, jadwal.tanggal_keberangkatan, pesawat.kode_pesawat, penumpang.nama_penumpang, kelas.harga_kelas, kelas.nama_kelas, rute.id_bandara_Asal, rute.id_bandara_tujuan, jadwal.id_rute, transaksi.id_kelas, jadwal.id_pesawat
    FROM tiket 
    INNER JOIN transaksi ON tiket.id_transaksi = transaksi.id
    INNER JOIN jadwal ON transaksi.id_jadwal = jadwal.id
    INNER JOIN penumpang ON transaksi.id_penumpang = penumpang.id
    INNER JOIN kelas ON transaksi.id_kelas = kelas.id
    INNER JOIN rute ON jadwal.id_rute = rute.id 
    INNER JOIN bandara b1 ON rute.id_bandara_asal = b1.id
    INNER JOIN bandara b2 ON rute.id_bandara_tujuan = b2.id
    INNER JOIN pesawat ON jadwal.id_pesawat = pesawat.id
    WHERE transaksi.id = '$key'
    ";
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tampiltransaksi(){
    global $db;
    $query = "SELECT transaksi.id, transaksi.id_kelas, transaksi.id_jadwal, transaksi.id_user, transaksi.status_pembayaran, transaksi.kursi, kelas.nama_kelas, rute.harga AS hargaawal,transaksi.harga, kelas.harga_kelas, penumpang.nama_penumpang, penumpang.no_ktp, jadwal.id_pesawat, pesawat.nama_pesawat, pesawat.id_maskapai, maskapai.nama_maskapai, transaksi.id, b1.nama_bandara AS asal, b2.nama_bandara AS tujuan, b1.lokasi_bandara AS lokal, b2.lokasi_bandara AS loktu, jadwal.tanggal_keberangkatan AS tanggal, jadwal.jam_keberangkatan AS waktu_keberangkatan
    FROM transaksi
    INNER JOIN jadwal ON transaksi.id_jadwal = jadwal.id
    INNER JOIN kelas ON transaksi.id_kelas = kelas.id
    INNER JOIN penumpang ON transaksi.id_penumpang = penumpang.id
    INNER JOIN rute ON jadwal.id_rute = rute.id
    INNER JOIN pesawat ON jadwal.id_pesawat = pesawat.id
    INNER JOIN maskapai ON pesawat.id_maskapai = maskapai.id
    INNER JOIN bandara b1 ON rute.id_bandara_asal = b1.id
    INNER JOIN bandara b2 ON rute.id_bandara_tujuan = b2.id
    ORDER BY transaksi.id ASC
    ";
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function jdl()
{
    global $db;
    $query = "SELECT jadwal.id, rute.harga,  pesawat.nama_pesawat, b1.nama_bandara AS bandara_asal, b2.nama_bandara AS bandara_tujuan, jadwal.jam_keberangkatan, jadwal.tanggal_keberangkatan
            FROM jadwal
            INNER JOIN pesawat ON jadwal.id_pesawat = pesawat.id
            INNER JOIN rute ON jadwal.id_rute = rute.id
            INNER JOIN bandara b1 ON rute.id_bandara_asal = b1.id
            INNER JOIN bandara b2 ON rute.id_bandara_tujuan = b2.id
            ";
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function rute($query)
{
    global $db;
    //ambil data dari tiap elemen dalam form
    $asal = $_POST["asal"];
    $tujuan = $_POST["tujuan"];
    $query = "SELECT * FROM rute WHERE id_bandara_asal = '$asal' AND id_bandara_tujuan = '$tujuan'";
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function lihatriwayat($id)
{
    global $db;
    $query = "SELECT * FROM transaksi WHERE id = '$id'";
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function editransaksi($k){
    global $db;
    //ambil transaksi terakhir
    $q = "SELECT * FROM transaksi ORDER BY id DESC LIMIT 1";
    $t = mysqli_query($db, $q);
    $trans = mysqli_fetch_assoc($t);
    $id = $trans["id"];
    $q = "SELECT * FROM kelas WHERE nama_kelas = '$k'";
    $k = mysqli_query($db, $q);
    $kelas = mysqli_fetch_assoc($k);
    $kelas = $kelas["id"];
    $query = "UPDATE `transaksi` SET `id_kelas` = $kelas WHERE `transaksi`.`id` = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}


function editkursi($k){
    global $db;
    //ambil transaksi terakhir
    $q = "SELECT id FROM transaksi ORDER BY id DESC LIMIT 1";
    $t = mysqli_query($db, $q);
    $trans = mysqli_fetch_assoc($t);
    $trans = $trans["id"];
    $query = "UPDATE transaksi SET kursi = $k WHERE id = $trans";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}


function riwayat($id)
{
    global $db;
    $query = "SELECT * FROM transaksi WHERE id_user = '$id'";
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function jadwal($rute)
{
    global $db;
    $id_rute = $rute[0]["id"];
    $query = "SELECT * FROM jadwal WHERE id_rute = '$id_rute'";
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tampilkanjadwal($jd)
{
    global $db;
    $id_jadwal = [];
    foreach ($jd as $key => $value) {
        $id_jadwal[] = $value["id"];
    }
    $query = "SELECT jadwal.id, pesawat.nama_pesawat, b1.nama_bandara AS bandara_asal, b2.nama_bandara AS bandara_tujuan, jadwal.jam_keberangkatan, jadwal.tanggal_keberangkatan, rute.harga
    FROM jadwal
    INNER JOIN pesawat ON jadwal.id_pesawat = pesawat.id
    INNER JOIN rute ON jadwal.id_rute = rute.id
    INNER JOIN bandara b1 ON rute.id_bandara_asal = b1.id
    INNER JOIN bandara b2 ON rute.id_bandara_tujuan = b2.id
    WHERE jadwal.id IN (" . implode(',', $id_jadwal) . ")";
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahpenumpang($data)
{
    global $db;
    //ambil data dari tiap elemen dalam form
    $nama = $data["nama_penumpang"];
    $no_ktp = $data["no_ktp"];
    $no_telp = $data["no_telp"];
    //query insert data
    $query = "INSERT INTO penumpang VALUES ('','$_SESSION[id]','$no_telp','$no_ktp','$nama')";
    mysqli_query($db, $query); //untuk menjalankan query insert data
    //simpan data hasil query (id, id_username, no_telp, no_ktp dan nama) di var $penumpang

    return mysqli_affected_rows($db);
}




?>