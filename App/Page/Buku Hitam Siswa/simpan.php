<?php
session_start();
$Users = $_SESSION['id'];
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');


if (isset($_GET['Kirim'])) {

	$kelas 			= test_input($_POST['kelas']);
	$KeteranganBk 	= test_input($_POST['KeteranganBk']);
	$bulan 			= test_input($_POST['bulan']);
	$tahun 			= test_input($_POST['tahun']);

	if ($kelas != 0) {
		
		if ($KeteranganBk != 0) {
			
			if ($KeteranganBk == 1) {
				$Insert = mysqli_query($conn,"select a.id_siswa,a.tanggal,b.id_siswa,b.id_kelas from tb_absensi as a inner join tb_siswa as b on a.id_siswa=b.id_siswa where a.id_siswa and year(a.tanggal)='".$tahun."' and month(a.tanggal)='".$bulan."' and b.id_kelas='".$kelas."'");
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
			}

		}


	}

	echo json_encode($respone);

}elseif (isset($_GET['KirimNilai'])) {

	$kelas 			= test_input($_POST['kelass']);
	$KeteranganBk 	= test_input($_POST['KeteranganBks']);
	$hari 			= test_input($_POST['hari']);
	$tanggal 			= test_input($_POST['tanggal']);


	if ($kelas != '0' && $KeteranganBK != '0' && $hari != '0' && $tanggal !='') {
			$Insert = mysqli_query($conn,"select * from tb_jadwal_penilaian_mata_pelajaran where id_kelas='".$kelas."' and hari='".$hari."'");
				if (mysqli_num_rows($Insert) > 0) {
					$respone = [
						'status' => 'success',
						'message'=> 'Data Tersedia Ada..!',
					];
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Maaf Tidak Mata Pelajaran Pada Kelas ini ..!',
					];
				}
				
			}else{
			
					$respone = [
						'status' => 'error',
						'message'=> 'Form Masih Ada yang Kosong ...!',
					];
				}
		

	echo json_encode($respone);


}elseif(isset($_GET['PanggilSiswa'])){

	$idSiswa  		= test_input($_POST['nama_id']);
	$nama_siswa  	= test_input($_POST['nama_siswa']);
	$nama_session  	= test_input($_POST['nama_session']);
	$nama_data  	= test_input($_POST['nama_data']);
	$nama_data_id  	= test_input($_POST['nama_data_id']);

	if ($nama_data_id == 1) {
		$tanggalHariIni = date('Y-m-d');
		if (!empty($idSiswa)) {
			if (!empty($nama_session)) {
				$kodeBk  = mt_rand(100,999);
				$kodeNya = 'A'.$kodeBk;
				$Update  = mysqli_query($conn,"UPDATE tb_absensi set action_update='2' where keterangan='".$nama_data."' and id_siswa='".$idSiswa."'");
				if ($Update == true) {
					$Insert = mysqli_query($conn,"INSERT INTO `tb_bk`(`id`, `kode_bk`, `keterangan`, `tanggal_dibuat`, `id_guru`, `id_siswa`) VALUES ('','$kodeNya','1','$tanggalHariIni','$nama_session','$idSiswa')");
					$respone = [
						'status' => 'success',
						'message'=> 'Silakan Cek Surat Pemanggilannya..!',
					];
				} else{
					$respone = [
						'status' => 'error',
						'message'=> 'Gagal..',
					];
				}
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Terjadi Kesalahan..!',
				];
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Terjadi Kesalahan..!',
			];
		}
	}elseif ($nama_data_id == 3) {
	   // var_dump($nama_data_id);
		$tanggalHariIni = date('Y-m-d');
		if (!empty($idSiswa)) {
			if (!empty($nama_session)) {
			    $nama_od = $_POST['nama_od'];
// 			var_dump($nama_od);die();
			    //var_dump($nama_od);die();
				$kodeBk  = mt_rand(100,999);
				$kodeNya = 'A'.$kodeBk;
				// UPDATE `tb_nilai` SET `id`=[value-1],`id_mata_pelajaran`=[value-2],`id_siswa`=[value-3],`nilai`=[value-4],`id_guru`=[value-5],`tanggal`=[value-6],`action_update`=[value-7] WHERE 1
				
				$Update  = mysqli_query($conn,"UPDATE tb_nilai set action_update ='3' where id='".$name_od."'");
	var_dump($Update);
				if ($Update == true) {
					$Insert = mysqli_query($conn,"INSERT INTO `tb_bk`(`id`, `kode_bk`, `keterangan`, `tanggal_dibuat`, `id_guru`, `id_siswa`) VALUES ('','$kodeNya','3','$tanggalHariIni','$nama_session','$idSiswa')");
				
					$respone = [
						'status' => 'success',
						'message'=> 'Silakan Cek Surat Pemanggilannya..!',
					];
				} else{
					$respone = [
						'status' => 'error',
						'message'=> 'Gagal..',
					];
				}
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Terjadi Kesalahan..!',
				];
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Terjadi Kesalahan..!',
			];
		}
	}else{ 
		$tanggalHariIni = date('Y-m-d');
		if (!empty($idSiswa)) {
			if (!empty($nama_session)) {
				$kodeBk  = mt_rand(100,999);
				$kodeNya = 'A'.$kodeBk;
				$Update  = mysqli_query($conn,"UPDATE  tb_keuangan set keterangan='Sedang Dipanggil' where id='".$nama_data_id."' and id_siswa='".$idSiswa."'");
				if ($Update == true) {
					$Insert = mysqli_query($conn,"INSERT INTO `tb_bk`(`id`, `kode_bk`, `keterangan`, `tanggal_dibuat`, `id_guru`, `id_siswa`) VALUES ('','$kodeNya','2','$tanggalHariIni','$nama_session','$idSiswa')");
					$respone = [
						'status' => 'success',
						'message'=> 'Silakan Cek Surat Pemanggilannya..!',
					];
				} else{
					$respone = [
						'status' => 'error',
						'message'=> 'Gagal..',
					];
				}
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Terjadi Kesalahan..!',
				];
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Terjadi Kesalahan..!',
			];
		}
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
