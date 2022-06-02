<?php
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');

if (isset($_GET['Kirim'])) {

	$periode 	 = test_input($_POST['periode']);
	$id_pelajaran= test_input($_POST['jurusan']);
	$guru 	 	 = test_input($_POST['guru']);
	$waktu 	 	 = test_input($_POST['waktu']);
	$hari 	 	 = test_input($_POST['semester']);
	if ($guru != '' && $id_pelajaran != 0 && $periode != 0 ) {
		$Insert = mysqli_query($conn,"select * from tb_jadwal_penilaian_mata_pelajaran where id_guru='".$guru."' and id_kelas='".$periode."' and id_pelajaran='".$id_pelajaran."' and hari='".$hari."' and pukul='".$waktu."' and actice='1'");
		if (mysqli_num_rows($Insert) > 0) {
			$respone = [
				'status' => 'error',
				'message'=> 'Data Sudah Ada....!',
			];
		}else{
			$Insert = mysqli_query($conn,"INSERT INTO `tb_jadwal_penilaian_mata_pelajaran`(`id`, `id_pelajaran`, `id_kelas`, `id_guru`, `hari`, `pukul`, `actice`) VALUES ('','$id_pelajaran','$periode','$guru','$hari','$waktu','1')");

			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil..!',
			];
		}
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Form Kosong..!',
		];
	}
	echo json_encode($respone);


}elseif(isset($_GET['Matikan'])){

	$id 	= test_input($_POST['id']);

	if ($id != '') {
		$Insert = mysqli_query($conn,"UPDATE `tb_jadwal_penilaian_mata_pelajaran` SET actice='2' WHERE id='".$id."'");
		$respone = [
			'status' => 'success',
			'message'=> 'Berhasil Mengubah Data..!',
		];
	}else{

		$respone = [
			'status' => 'error',
			'message'=> 'Gagal..!',
		];
	}
	echo json_encode($respone);

}elseif(isset($_GET['DeleteTotal'])){

	$id 	= test_input($_POST['id']);

	if ($id != '') {
		$Insert = mysqli_query($conn,"DELETE from `tb_jadwal_penilaian_mata_pelajaran`  WHERE id='".$id."'");
		$respone = [
			'status' => 'success',
			'message'=> 'Berhasil Menghapus Data..!',
		];
	}else{

		$respone = [
			'status' => 'error',
			'message'=> 'Gagal..!',
		];
	}
	echo json_encode($respone);

}elseif(isset($_GET['Repair'])){

	$id 	= test_input($_POST['id']);

	if ($id != '') {
		$Insert = mysqli_query($conn,"UPDATE `tb_jadwal_penilaian_mata_pelajaran` SET actice='1' WHERE id='".$id."'");
		$respone = [
			'status' => 'success',
			'message'=> 'Berhasil Mengubah Data..!',
		];
	}else{

		$respone = [
			'status' => 'error',
			'message'=> 'Gagal..!',
		];
	}
	echo json_encode($respone);


}elseif (isset($_GET['Update'])) {

	$id 	 	 = test_input($_POST['id']);
	$periode 	 = test_input($_POST['periode']);
	$id_pelajaran= test_input($_POST['jurusan']);
	$guru 	 	 = test_input($_POST['guru']);
	$waktu 	 	 = test_input($_POST['waktu']);
	$hari 	 	 = test_input($_POST['semester']);
	if ($guru != '' && $id_pelajaran != 0 && $periode != 0 ) {
		$Insert = mysqli_fetch_array(mysqli_query($conn,"select * from tb_jadwal_penilaian_mata_pelajaran where id='".$id."'"));
		if ($guru == $Insert['id_guru'] && $id_pelajaran == $Insert['id_pelajaran'] && $periode == $Insert['id_kelas'] && $waktu == $Insert['pukul'] && $hari == $Insert['hari']) {
			$respone = [
				'status' => 'error',
				'message'=> 'Tidak Ada Perubahan Data....!',
			];
		}elseif ($guru == $Insert['id_guru'] && $periode == $Insert['id_kelas'] && $id_pelajaran != $Insert['id_pelajaran'] &&  $waktu != $Insert['pukul'] && $hari != $Insert['hari'] ) {
			$InsertDataCek = mysqli_query($conn,"select * from tb_jadwal_penilaian_mata_pelajaran where id_pelajaran='$id_pelajaran' and pukul='$waktu' and hari='$hari' and id_kelas='$periode' ");
			if (mysqli_num_rows($InsertDataCek) > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Data Sudah Ada ..!',
				];
			}else{
				$Insert = mysqli_query($conn,"UPDATE `tb_jadwal_penilaian_mata_pelajaran` set id_pelajaran='$id_pelajaran',hari='$hari',pukul='$waktu' where id='".$id."'");
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil..!',
				];
			}
		}elseif ($guru != $Insert['id_guru'] && $id_pelajaran == $Insert['id_pelajaran'] && $periode == $Insert['id_kelas'] && $waktu == $Insert['pukul'] && $hari == $Insert['hari'] ) {
			$InsertDataCek = mysqli_query($conn,"select * from tb_jadwal_penilaian_mata_pelajaran where id_guru='$guru' and id_pelajaran='$id_pelajaran' and id_kelas='$periode' and pukul='$waktu' and hari='$hari'");
			if (mysqli_num_rows($InsertDataCek) > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Data Sudah Ada ..!',
				];
			}else{
				$Insert = mysqli_query($conn,"UPDATE `tb_jadwal_penilaian_mata_pelajaran` set id_guru='$guru' where id='".$id."'");
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil..!',
				];
			}
		}elseif($guru == $Insert['id_guru'] && $periode['id_kelas'] != $Insert['id_kelas']){
			$Insert = mysqli_query($conn,"UPDATE `tb_jadwal_penilaian_mata_pelajaran` set id_pelajaran='$id_pelajaran',hari='$hari',pukul='$waktu',id_kelas='$periode' where id='".$id."'");
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil..!',
				];
		}


	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Form Kosong..!',
		];
	}
	echo json_encode($respone);

}else{

}
