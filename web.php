<?php 
session_start(); 
$LevelNya = $_SESSION['Level'];
if (@$_SESSION['id'] == '') {
header('location:index.php');
}else{
    if(@$_SESSION['LogIn'] == true){
	require_once(__DIR__.'/App/Function/base_url.php');
	require_once(__DIR__.'/App/Function/db.php');
	include(__DIR__.'/App/Template/Header_backend.php');
	include(__DIR__.'/App/Page/Menu.php');

	@$content   = $_GET['Halaman'];
	@$aksi      = $_GET['Aksi'];
	$validpage  = array("Siswa","Jurusan","Periode","KelasSekolah","Guru","Keuangan","Pengguna","Wali Kelas","Absensi","Mata Pelajaran","Jadwal Mata Pelajaran","Nilai","Nilai Ulangan","Buku Hitam Siswa","Laporan","Panduan","Grafik","Laporan Lainnya","Laporan Lainnya Info");
	$validadmin = array("Siswa","Jurusan","Periode","KelasSekolah","Guru","Keuangan","Pengguna","Wali Kelas","Absensi","Mata Pelajaran","Jadwal Mata Pelajaran","Nilai","Nilai Ulangan","Buku Hitam Siswa","Laporan","Panduan","Grafik","Laporan Lainnya","Laporan Lainnya Info");
	if (in_array($content, $validpage)){
		if ($LevelNya == 1) {
			if($aksi ==""){
				include(__DIR__."/App/Page/".$content."/".$content.".php");
			}elseif ($aksi=="form" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/Form.php");
			} elseif ($aksi=="tambah" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/tambah.php");
			} elseif ($aksi=="Info" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/Info.php");

			}
		}elseif($LevelNya == 2){
			if($aksi ==""){
				include(__DIR__."/App/Page/".$content."/".$content.".php");
			}elseif ($aksi=="form" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/Form.php");
			} elseif ($aksi=="tambah" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/tambah.php");
			} elseif ($aksi=="Info" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/Info.php");
			}
		}elseif ($LevelNya == 3) {
			if($aksi ==""){
				include(__DIR__."/App/Page/".$content."/".$content.".php");
			}elseif ($aksi=="form" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/Form.php");
			} elseif ($aksi=="tambah" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/tambah.php");
			} elseif ($aksi=="Info" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/Info.php");

			}
		}elseif ($LevelNya == 4) {
			if($aksi ==""){
				include(__DIR__."/App/Page/".$content."/".$content.".php");
			}elseif ($aksi=="form" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/Form.php");
			} elseif ($aksi=="tambah" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/tambah.php");
			} elseif ($aksi=="Info" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/Info.php");

			}
		}elseif ($LevelNya == 5 || $LevelNya == 7) {
			if($aksi ==""){
				include(__DIR__."/App/Page/".$content."/".$content.".php");
			}
		}else{
			if($aksi ==""){
				include(__DIR__."/App/Page/".$content."/".$content.".php");
			}elseif ($aksi=="form" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/Form.php");
			} elseif ($aksi=="tambah" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/tambah.php");
			} elseif ($aksi=="Info" && in_array($content, $validadmin)) {
				include(__DIR__."/App/Page/".$content."/Info.php");

			}
		}
	}else{
		include(__DIR__."/App/Page/Dashboard.php");
	}
    
	require_once(__DIR__.'/App/Template/Footer_backend.php');

    }
    }
?>
