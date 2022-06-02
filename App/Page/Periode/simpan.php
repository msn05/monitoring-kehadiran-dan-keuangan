<?php
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');

if (isset($_GET['Kirim'])) {
	$exampleInputEmail2 		 = test_input($_POST['nama']);
	if (!empty($exampleInputEmail2)) {
		$DataCekEmail   = mysqli_query($conn,"SELECT periode from tb_periode where periode='".$exampleInputEmail2."'  ");

		if (preg_match('/^[0-9\-]/', $exampleInputEmail2)){

			if (mysqli_num_rows($DataCekEmail) > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Data Sudah Ada....!',
				];
			}else{
				$Insert = mysqli_query($conn,"INSERT INTO `tb_periode`(`id`, `periode`) VALUES ('','$exampleInputEmail2')");
				if ($Insert == true) {
					$respone = [
						'status' => 'success',
						'message'=> 'Berhasil',
					];
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'false....!',
					];
				}
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Harap Isi Dengan Angka ',
			];
		}
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'form kosong....!',
		];
	}
	echo json_encode($respone);


}elseif (isset($_GET['Delete'])) {
	$id = test_input($_POST['id']);
	if ($id != '') {
		$Insert = mysqli_query($conn,"DELETE from `tb_periode` where id='".$id."'");
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

}elseif(isset($_GET['Update'])){
	$id               			 = test_input($_POST['id']);
	$exampleInputEmail2          = test_input($_POST['nama']);
	$PostData   = date('Y-m-d H:i:s');
	if (!empty($exampleInputEmail2)) {

		$DataCekEmail   = mysqli_query($conn,"SELECT periode from tb_periode where periode='".$exampleInputEmail2."'");
		if (preg_match('/^[0-9\-]/', $exampleInputEmail2)){

			if (mysqli_num_rows($DataCekEmail) > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Data Sudah Ada....!',
				];
			}else{

				$Insert = mysqli_query($conn,"UPDATE `tb_periode` set periode='".$exampleInputEmail2."' where id='".$id."'");
				if ($Insert == true) {
					$respone = [
						'status' => 'success',
						'message'=> 'Berhasil',
					];
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Gagal....!',
					];
				}
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Harap Diisi Dengan Huruf..!',
			];
		}
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Tidak Boleh Kosong..!',
		];
	}
	echo json_encode($respone);

}
