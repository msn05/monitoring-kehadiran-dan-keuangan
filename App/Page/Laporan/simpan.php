<?php
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');

$keteranganBK = test_input($_POST['KeteranganBk']);
$kelas 		  = test_input($_POST['kelas']);

$tahun 		  = test_input($_POST['tahun']);
$bulan		  = test_input($_POST['bulan']);
if ($kelas != 0 && $tahun != 0 && $bulan != 0 ) {
	if ($keteranganBK == 1) {
		$Insert = mysqli_query($conn,"select a.id_siswa,a.tanggal,b.id_siswa,b.id_kelas from tb_absensi as a inner join tb_siswa as b on a.id_siswa=b.id_siswa where a.id_siswa and year(a.tanggal)='".$tahun."' and month(a.tanggal)='".$bulan."' and b.id_kelas='".$kelas."'");
		if (mysqli_num_rows($Insert) > 0) {
			$respone = [
				'status' => 'success',
				'message'=> 'Silakan Klik Ok..',
			];
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Tidak Ada Data...',
			];
		}
	}elseif($keteranganBK == 2){

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
	}elseif($keteranganBK == 3){
		$Insert = mysqli_query($conn,"select a.id_siswa,a.tanggal,b.id_siswa,b.id_kelas from tb_nilai as a inner join tb_siswa as b on a.id_siswa=b.id_siswa where a.id_siswa and year(a.tanggal)='".$tahun."' and month(a.tanggal)='".$bulan."' and b.id_kelas='".$kelas."'");
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
	}
}else{
	$respone = [
		'status' => 'error',
		'message'=> 'Form Kosong..!',
	];
}
echo json_encode($respone);
