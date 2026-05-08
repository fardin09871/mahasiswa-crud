<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mahasiswa_crud';

try {
    $koneksi = new mysqli($host, $username, $password, $database);
    $koneksi->set_charset("utf8");
} catch (Exception $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>