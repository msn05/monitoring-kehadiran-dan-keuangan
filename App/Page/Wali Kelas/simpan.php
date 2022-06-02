<?php
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');

if (isset($_GET['Kirim'])) {
	$guru 		 	 = test_input($_POST['guru']);
	$jurusan 		 = test_input($_POST['jurusan']);
	$PostData  		 = date('Y-m-d H:i:s');

	if ($guru != 0 && $jurusan != 0 ) {
		$DataCekEmail   = mysqli_query($conn,"SELECT id_guru,id_kelas,active from tb_wali_kelas where id_guru='".$guru."' and id_kelas='".$jurusan."' and active='1' or id_guru='".$guru."' and active='1' or id_kelas='".$jurusan."' and active='1'");
		if (mysqli_num_rows($DataCekEmail) > 0) {
			$respone = [
				'status' => 'error',
				'message'=> 'Maaf Guru / Kelas Tersebut Sudah Ada dan Status Masih Aktif..! / Klik Tombol Reset Terlebih Dahulu',
			];
		}else{
			$Insert = mysqli_query($conn,"INSERT INTO `tb_wali_kelas`(`id`, `id_guru`, `id_kelas`, `created`, `active`) VALUES ('','$guru','$jurusan','$PostData','1')");
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
			'message'=> 'form kosong....!',
		];
	}
	echo json_encode($respone);


}elseif (isset($_GET['Reset'])) {
	$id = test_input($_POST['id']);
	if ($id != '') {
		$Insert = mysqli_query($conn,"DELETE FROM tb_wali_kelas where id='".$id."'");
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

}elseif (isset($_GET['Update'])) {
	$id 		= test_input($_POST['id']);
	$jurusan 	= test_input($_POST['jurusan']);
	$guru 		= test_input($_POST['guru']);
	if ($id != '') {

		if ($jurusan != 0 && $guru != 0) {


			$DataGet = mysqli_fetch_array(mysqli_query($conn,"select * from tb_wali_kelas where id='".$id."'"));

			if ($guru == $DataGet['id_guru'] && $jurusan == $DataGet['id_kelas']) {
				$respone = [
					'status' => 'error',
					'message'=> 'Tidak Ada yang diubah...!',
				];
			}else{
				if ($guru == $DataGet['id_guru'] && $jurusan != $DataGet['id_kelas']) {
					$DataCekNya   = mysqli_query($conn,"SELECT id_kelas,active from tb_wali_kelas where  id_kelas='".$jurusan."' and active='1' ");
					if (mysqli_num_rows($DataCekNya) > 0 ) {
						$respone = [
							'status' => 'error',
							'message'=> 'Kelas Sudah Ada Gurunya.!',
						];

					}else{
						$Insert = mysqli_query($conn,"UPDATE `tb_wali_kelas` set id_kelas='$jurusan' where id='".$id."'");
						$respone = [
							'status' => 'success',
							'message'=> 'Berhasil.!',
						];

					}

				}elseif($guru != $DataGet['id_guru'] && $jurusan == $DataGet['id_kelas']){
					$DataCekNyaGuru   = mysqli_query($conn,"SELECT id_guru,active from tb_wali_kelas where  id_guru='".$guru."' and active='1' ");
					if (mysqli_num_rows($DataCekNyaGuru) > 0 ) {
						$respone = [
							'status' => 'error',
							'message'=> 'Guru Sudah Ada Kelas.!',
						];
					}else{
						$Insert = mysqli_query($conn,"UPDATE `tb_wali_kelas` set id_guru='$guru' where id='".$id."'");
						$respone = [
							'status' => 'success',
							'message'=> 'Berhasil.!',
						];
					}
				}else{
					$DataCekNyaGuruID   = mysqli_query($conn,"SELECT id_guru,id_kelas,active from tb_wali_kelas where  id_guru='".$guru."' and id_kelas='".$jurusan."' and active='1' ");
					if (mysqli_num_rows($DataCekNyaGuruID) > 0 ) {
						$respone = [
							'status' => 'error',
							'message'=> 'Sudah Ada...!',
						];
					}else{
						$Insert = mysqli_query($conn,"UPDATE `tb_wali_kelas` set id_guru='$guru',id_kelas='$jurusan' where id='".$id."'");
						$respone = [
							'status' => 'success',
							'message'=> 'Berhasil.!',
						];
					}
				}
			}


		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Tidak boleh Kosong...!',
			];
		}
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
