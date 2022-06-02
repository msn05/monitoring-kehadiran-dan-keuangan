<?php
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');

if (isset($_GET['Kirim'])) {
	$exampleInputEmail2 		 = test_input($_POST['nama']);
	$PostData  	= date('Y-m-d H:i:s');
	if (!empty($exampleInputEmail2)) {
		$DataCekEmail   = mysqli_query($conn,"SELECT nama_jurusan,remove_data from tb_jurusan where nama_jurusan='".$exampleInputEmail2."'  AND remove_data='2' or nama_jurusan='".$exampleInputEmail2."' and remove_data='1'");

		if (preg_match('/^[A-Za-z]/', $exampleInputEmail2)){

			if (mysqli_num_rows($DataCekEmail) > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Data Sudah Ada....!',
				];
			}else{
				$Insert = mysqli_query($conn,"INSERT INTO `tb_jurusan`(`id`, `nama_jurusan`, `created`, `remove_data`) VALUES ('','$exampleInputEmail2','$PostData','1')");
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
				'message'=> 'Harap Isi Dengan Huruf',
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
		$Insert = mysqli_query($conn,"UPDATE `tb_jurusan` set remove_data='2'where id='".$id."'");
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

		$DataCekEmail   = mysqli_query($conn,"SELECT nama_jurusan,remove_data from tb_jurusan where nama_jurusan='".$exampleInputEmail2."'  AND remove_data='2' or nama_jurusan='".$exampleInputEmail2."' and remove_data='1'");
		if (preg_match('/^[A-Za-z]/', $exampleInputEmail2)){

			if (mysqli_num_rows($DataCekEmail) > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Data Sudah Ada....!',
				];
			}else{

				$Insert = mysqli_query($conn,"UPDATE `tb_jurusan` set nama_jurusan='".$exampleInputEmail2."', created='".$PostData."' where id='".$id."'");
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

}else{
	$id = test_input($_POST['id']);
	if ($id != '') {
		$Insert = mysqli_query($conn,"UPDATE `tb_jurusan` set remove_data='1'where id='".$id."'");
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
}
