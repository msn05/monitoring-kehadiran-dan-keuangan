<?php
session_start();
$Users = $_SESSION['id'];
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');


if (isset($_GET['Kirim'])) {
	$kelas = test_input($_POST['kelas']);
	$tanggal = test_input(date('Y-m-d',strtotime($_POST['tanggal'])));
	if ($kelas != 0) {
		$Insert = mysqli_query($conn,"select a.id_siswa,a.tanggal,b.id_siswa,b.id_kelas from tb_absensi as a inner join tb_siswa as b on a.id_siswa=b.id_siswa where a.id_siswa and a.tanggal='".$tanggal."' and b.id_kelas='".$kelas."'");
		if (mysqli_num_rows($Insert) > 0) {
			$respone = [
				'status' => 'success',
				'message'=> 'Data Tersedia Ada..!',
			];
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Data Belum Ada..!',
			];
		}
	}else{
		$respone = [
			'status' => 'warning',
			'message'=> 'Form Kosong..!',
		];
	}
	echo json_encode($respone);


}elseif(isset($_GET['Update'])){



	$id_siswa = $_POST['id_siswa'];
	$tanggal  = $_POST['tanggal'];
	$radar  = $_POST['radar'];

	for ($i=0; $i <count($radar) ; $i++) { 

		$DataCekNya = mysqli_query($conn,"select id_siswa,tanggal from tb_absensi where id_siswa='".$id_siswa[$i]."' and tanggal='".$tanggal."'");

		if (mysqli_num_rows($DataCekNya) > 0) {
			$Insert = mysqli_query($conn,"UPDATE `tb_absensi` SET keterangan='$radar[$i]' WHERE id_siswa='".$id_siswa[$i]."' and tanggal='".$tanggal."'");
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil Mengubah Data..!',
			];
		}else{
			$Insert = mysqli_query($conn,"INSERT INTO `tb_absensi`(`id`, `id_siswa`, `tanggal`, `keterangan`, `id_guru`, `action_update`) VALUES ('','$id_siswa[$i]','$tanggal','$radar[$i]','$Users','1')");
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil..!',
			];
		}
	}
	echo json_encode($respone);


}else{

}
