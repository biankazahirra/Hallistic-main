<?php
$servername = "localhost";
$username = "root"; // Default username untuk XAMPP
$password = ""; // Default password untuk XAMPP
$database_name = "hallistic_db";

$koneksi = new mysqli($servername, $username, $password, $database_name);

if ($koneksi->connect_error) {
    die("Connection Failed: " . $koneksi->connect_error);
} else {
    echo "Connected successfully";
}

