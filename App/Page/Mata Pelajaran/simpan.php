<?php
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');

if (isset($_GET['Kirim'])) {
	$exampleInputEmail2 		 = test_input($_POST['nama']);
	$exampleInputEmail1 		 = test_input($_POST['kode']);
	if (!empty($exampleInputEmail2) && !empty($exampleInputEmail1)) {
		if (preg_match('/^[0-9\s]/', $exampleInputEmail1)){
			$DataCekEmail1   = mysqli_query($conn,"SELECT kode_mata_pelajaran,nama_pelajaran from tb_mata_pelajaran where kode_mata_pelajaran='".$exampleInputEmail1."' ");
			if (mysqli_num_rows($DataCekEmail1) > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Kode Sudah Digunakan Pada Mata Pelajaran Lain.!',
				];
			}else{
				if (preg_match('/^[A-Za-z\s]/', $exampleInputEmail2)){
					$DataCekEmail2   = mysqli_query($conn,"SELECT nama_pelajaran,active from tb_mata_pelajaran where nama_pelajaran='".$exampleInputEmail2."'  AND active='1' ");
					if (mysqli_num_rows($DataCekEmail2) > 0) {
						$respone = [
							'status' => 'error',
							'message'=> 'Mata Pelajaran Sudah Ada ....!',
						];
					}else{
						$Insert = mysqli_query($conn,"INSERT INTO `tb_mata_pelajaran`(`id_pelajaran`,`kode_mata_pelajaran`, `nama_pelajaran`, `active`) VALUES ('','$exampleInputEmail1','$exampleInputEmail2','1')");
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
						'message'=> 'Harap Isi Dengan Angka',
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
		$Insert = mysqli_query($conn,"UPDATE `tb_mata_pelajaran` set active='2'where id_pelajaran='".$id."'");
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
	$nama          = test_input($_POST['nama']);
	$kode          = test_input($_POST['kode']);
	$DataCekEmail1   = mysqli_fetch_array(mysqli_query($conn,"SELECT * from tb_mata_pelajaran where id_pelajaran='".$id."'"));

	if ($kode == $DataCekEmail1['kode_mata_pelajaran']){
		if ($nama == $DataCekEmail1['nama_pelajaran']) {
			$respone = [
				'status' => 'error',
				'message'=> 'Tidak Ada Yang Diubah ..!',
			];
		}else{
			$DataCekEmail   = mysqli_query($conn,"SELECT nama_pelajaran,active,id_pelajaran from tb_mata_pelajaran where nama_pelajaran='".$nama."' and active='1'");
			if (mysqli_num_rows($DataCekEmail) > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Data Sudah Ada....!',
				];
			}else{
				$Insert = mysqli_query($conn,"UPDATE `tb_mata_pelajaran` set nama_pelajaran='".$nama."' where id_pelajaran='".$id."'");
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
		}
	}else{
		$DataCekEmail4   = mysqli_query($conn,"SELECT kode_mata_pelajaran from tb_mata_pelajaran where kode_mata_pelajaran='".$kode."' and active='1'");
		if (mysqli_num_rows($DataCekEmail4) > 0) {
			$respone = [
				'status' => 'error',
				'message'=> 'Kode Sudah Digunakan .. !',
			];
		}else{
			$Insert = mysqli_query($conn,"UPDATE `tb_mata_pelajaran` set kode_mata_pelajaran='".$kode."' where id_pelajaran='".$id."'");
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
	}


	echo json_encode($respone);


}elseif (isset($_GET['Repair'])) {
	$id = test_input($_POST['id']);
	if ($id != '') {
		$Insert = mysqli_query($conn,"UPDATE `tb_mata_pelajaran` set active='1'where id_pelajaran='".$id."'");
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

}elseif (isset($_GET['Deletes'])) {
	$id = test_input($_POST['id']);
	if ($id != '') {
		$Insert = mysqli_query($conn,"DELETE from `tb_mata_pelajaran` where id_pelajaran='".$id."'");
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
