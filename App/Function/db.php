<?php
$dbhost   	= "localhost";
$dbuser 	= "websit17_website";
$dbpass 	= "Akamsi1234567890";
$dbname 	= "websit17_smalalans";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// cek koneksi
if ($conn->connect_error) {
	die('Koneksi Database Gagal : '.$conn->connect_error);
}
?>