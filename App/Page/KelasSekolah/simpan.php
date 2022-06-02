<?php
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');

if (isset($_GET['Kirim'])) {
	$kelas 		 	 = test_input($_POST['kelas']);
	$jurusan 		 = test_input($_POST['jurusan']);
	$periode 		 = test_input($_POST['periode']);
	$Semester 		 = test_input($_POST['semester']);
	$PostData  		 = date('Y-m-d H:i:s');
	if (!empty($kelas) && $jurusan != 0 && $periode != 0 && $Semester != 0 ) {
		$DataCekEmail   = mysqli_query($conn,"SELECT nama_kelas,id_jurusan,semester,id_periode,remove_data from tb_kelas where nama_kelas='".$kelas."' and id_jurusan='".$jurusan."' and id_periode='".$periode."' and semester='".$Semester."'");
		if (preg_match('/^[0-9\-]/', $kelas)){
			if (mysqli_num_rows($DataCekEmail) > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Data Sudah Ada....!',
				];
			}else{
				$Insert = mysqli_query($conn,"INSERT INTO `tb_kelas`(`id_kelas`, `nama_kelas`, `id_jurusan`, `id_periode`, `semester`, `created`, `remove_data`) VALUES ('','$kelas','$jurusan','$periode','$Semester','$PostData','1')");
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
				'message'=> 'Harap Isi Dengan Angka..!',
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
		$Insert = mysqli_query($conn,"UPDATE `tb_kelas` set remove_data='2'where id_kelas='".$id."'");
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

}elseif (isset($_GET['Repair'])) {
	$id = test_input($_POST['id']);
	if ($id != '') {
		$Insert = mysqli_query($conn,"UPDATE `tb_kelas` set remove_data='1'where id_kelas='".$id."'");
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

	$id             = test_input($_POST['id']);
	$kelas          = test_input($_POST['kelas']);
	$jurusan        = test_input($_POST['jurusan']);
	$periode        = test_input($_POST['periode']);
	$semester       = test_input($_POST['semester']);
	$PostData   	= date('Y-m-d H:i:s');
	if (!empty($id)) {
		$DataCekEmail   = mysqli_query($conn,"SELECT nama_kelas,id_jurusan,id_periode,semester,remove_data from tb_kelas where nama_kelas='".$kelas."' and id_jurusan='".$jurusan."' and id_periode='".$periode."' and semester='".$semester."'  AND remove_data='2'");
		if (preg_match('/^[0-9\-]/', $kelas)){

			if (mysqli_num_rows($DataCekEmail) > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Data Sudah Ada....!',
				];
			}else{

				$Insert = mysqli_query($conn,"UPDATE `tb_kelas` set nama_kelas='".$kelas."',id_periode='".$periode."',id_jurusan='".$jurusan."',semester='".$semester."', created='".$PostData."' where id_kelas='".$id."'");
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

}
