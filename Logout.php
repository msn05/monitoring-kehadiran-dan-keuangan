<?php
session_start();
session_destroy();

require_once(__DIR__.'/App/Function/db.php');
require_once(__DIR__.'/App/Function/base_url.php');

// $name   = test_input($_POST['name']);
$name 		= $_SESSION['id']; 
if (!empty($name)) {
	unset($name);
	$respone = [
		'status' => 'success',
		'message'=> 'Anda Berhasil Keluar....!',
	];
}else{
	$respone = [
		'status' => 'error',
		'message'=> 'Terjadi Kesalahan....!',
	];
}
echo json_encode($respone);