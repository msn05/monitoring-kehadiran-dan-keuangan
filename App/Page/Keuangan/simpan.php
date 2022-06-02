<?php
session_start();
$Users = $_SESSION['id'];
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');

if (isset($_GET['Kirim'])) {
	$kelas = test_input($_POST['kelas']);
	$tahun = test_input($_POST['tahun']);
	$bulan = test_input($_POST['bulan']);
	if ($kelas != 0 && $tahun != 0 && $bulan != 0) {
		$Insert = mysqli_query($conn,"select a.id_siswa,a.tanggal,b.id_siswa,b.id_kelas from tb_keuangan as a inner join tb_siswa as b on a.id_siswa=b.id_siswa where a.id_siswa and year(a.tanggal)='".$tahun."' and month(a.tanggal)='".$bulan."' and b.id_kelas='".$kelas."'");
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
	$nominal  = $_POST['nominal'];

	for ($i=0; $i <count($nominal) ; $i++) { 

		$DataCekNya = mysqli_query($conn,"select id_siswa,tanggal from tb_keuangan where id_siswa='".$id_siswa[$i]."' and tanggal='".$tanggal."'");

		if (mysqli_num_rows($DataCekNya) > 0) {
			$Insert = mysqli_query($conn,"UPDATE `tb_keuangan` SET nominal='$nominal[$i]' WHERE id_siswa='".$id_siswa[$i]."'");
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil Mengubah Data..!',
			];
		}else{

			$Insert = mysqli_query($conn,"INSERT INTO `tb_keuangan`(`id`, `id_siswa`, `tanggal`, `nominal`, `id_guru`, `keterangan`) VALUES ('','$id_siswa[$i]','$tanggal','$nominal[$i]','$Users','Telah Membayarkan')");
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil..!',
			];
		}
	}
	echo json_encode($respone);


}else{

}
