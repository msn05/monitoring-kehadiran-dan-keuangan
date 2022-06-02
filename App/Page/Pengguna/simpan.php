<?php
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');

if (isset($_GET['Reset'])) {
	$id = test_input($_POST['id']);
	$HashD 	 	 = password_hash("123456",PASSWORD_DEFAULT);
	if ($id != '') {
		$Insert = mysqli_query($conn,"UPDATE `tb_users` set password_users='$HashD' where id_users='".$id."'");
		if ($Insert == true) {
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil',
			];
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Gagal',
			];
		}
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Terjadi Kesalahan',
		];
	}
	echo json_encode($respone);


}else{

}
