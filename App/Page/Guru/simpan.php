<?php
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');

if (isset($_GET['Kirim'])) {

	$level 		 = test_input($_POST['level']);
	$pass 		 = test_input($_POST['pass']);
	$jurusan 	 = test_input($_POST['jurusan']);
	$alamat 	 = test_input($_POST['alamat']);
	$Telehphone  = test_input($_POST['Telehphone']);
	$nip 		 = test_input($_POST['nip']);
	$nama 		 = test_input($_POST['nama']);
	$kode 		 = test_input($_POST['kode']);
	$HashData 	 = password_hash($pass,PASSWORD_DEFAULT);
	$HashD 	 	 = password_hash("123456",PASSWORD_DEFAULT);
	$PostData  	 = date('Y-m-d H:i:s');
	$id 	 	 = mt_rand(100, 9999)+1;
	if (!empty($nama) && $level != 0 && $pass != '' && $Telehphone != '' && $jurusan!=0 && $nip != '' ) {
		$DataCekEmail   = mysqli_query($conn,"SELECT a.nip,a.no_telphone,a.id,b.id_users,b.KodeLogin,b.id_level from tb_guru as a left join tb_users as b on b.id_users=a.id where a.nip='".$nip."' and a.no_telphone='".$Telehphone."' and b.KodeLogin='".$kode."' and id_level='".$level."'");
		if (preg_match('/^[0-9]/', $nip)){
			if (preg_match('/^[0-9]/', $Telehphone)){
				if (mysqli_num_rows($DataCekEmail) > 0) {
					$respone = [
						'status' => 'error',
						'message'=> 'Data Sudah Ada....!',
					];
				}else{
					$name     				= $_FILES['file']['name'];
					$lokasi  	 			= $_FILES['file']['tmp_name'];
					$Batas    				= $_FILES['file']['size'];
					$ekstensi_diperbolehkan = array('jpg','jpeg');
					$Pecah 					= explode('.', $name);
					$ekstensi 				= strtolower(end($Pecah));
					$FotoNya 				= $nama.'.jpg';
					$TempatBaru 			= 'Image/'.$FotoNya;	
					if ($name != NULL) {
						if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
							if ($Batas <= 2000000) {
								if (move_uploaded_file($lokasi,$TempatBaru)){
									list($height,$width) = getimagesize($TempatBaru);
									$maxDim = 800; 
									if ( $width > $maxDim || $height > $maxDim ) {
										$ratio = $width/$height;
										if( $ratio > 1) {
											$newwidth  = $maxDim;
											$newheight = $maxDim/$ratio;
										} else {
											$newwidth = $maxDim*$ratio;
											$newheight = $maxDim;
										}
										$tmp 		= imagecreatetruecolor($newwidth, $newheight);
										$src		= imagecreatefromjpeg($TempatBaru);
										imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

										imagejpeg($tmp, $TempatBaru, 75);
									}

									$Insert = mysqli_query($conn,"INSERT INTO `tb_guru`(`id`, `nama_guru`, `nip`, `alamat`, `no_telphone`, `status_guru`, `foto`,`active`, `created`) VALUES ('$id','$nama','$nip','$alamat','$Telehphone','$jurusan','$FotoNya','1','$PostData')");

									if ($Insert == true) {
										if (!empty($pass)) {
											$InsertLaig = mysqli_query($conn,"INSERT INTO `tb_users`(`id_users`, `id_level`, `password_users`, `KodeLogin`) VALUES ('$id','$level','$HashData','$kode')");
										}else{
											$InsertLaig = mysqli_query($conn,"INSERT INTO `tb_users`(`id_users`, `id_level`, `password_users`, `KodeLogin`) VALUES ('$id','$level','$HashD','$kode')");
										}

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
									'message'=> 'Foto Terlalu Besar...!',
								];
							}
						}else{
							$respone = [
								'status' => 'error',
								'message'=> 'Format Tidak Sesuai..!',
							];
						}
					}else{
						$respone = [
							'status' => 'error',
							'message'=> 'Foto Tidak Boleh Kosong..!',
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
		$Insert = mysqli_query($conn,"UPDATE `tb_guru` set active='2'where id='".$id."'");
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
	$nama          = test_input($_POST['nama']);
	$nip        = test_input($_POST['nip']);
	$Telehphone        = test_input($_POST['Telehphone']);
	$alamat       = test_input($_POST['alamat']);
	$jurusan       = test_input($_POST['jurusan']);
	$level       = test_input($_POST['level']);
	$kode       = test_input($_POST['kode']);
	$alamat       = test_input($_POST['alamat']);
	$PostData   	= date('Y-m-d H:i:s');
	if ($id != '') {
		$DataCekEmail   = mysqli_fetch_array(mysqli_query($conn,"SELECT * from  tb_guru where id='".$id."'"));
		if (preg_match('/^[0-9\-]/', $nip)){
			if (preg_match('/^[0-9\-]/', $Telehphone)){
				if ($nip != $DataCekEmail['nip'] || $Telehphone != $DataCekEmail['no_telphone']) {
					$DataCek   = mysqli_query($conn,"SELECT * from  tb_guru where nip='".$nip."' or no_telphone='".$Telehphone."'");
					if (mysqli_num_rows($DataCek) > 0) {
						$respone = [
							'status' => 'error',
							'message'=> 'Data Sudah Ada....!',
						];
					}else{
						$Insert = mysqli_query($conn,"UPDATE `tb_guru` set nama_guru='".$nama."',no_telphone='".$Telehphone."',nip='".$nip."',alamat='".$alamat."', created='".$PostData."', status_guru='".$jurusan."' where id='".$id."'");
						if ($Insert == true) {
							$Insert = mysqli_query($conn,"UPDATE `tb_users` set id_level='".$level."' where id_users='".$id."'");
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
					$Insert = mysqli_query($conn,"UPDATE `tb_guru` set nama_guru='".$nama."',alamat='".$alamat."', created='".$PostData."', status_guru='".$jurusan."' where id='".$id."'");
					if ($Insert == true) {
						$Insert = mysqli_query($conn,"UPDATE `tb_users` set id_level='".$level."' where id_users='".$id."'");
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
					'message'=> 'Wajib Angka...!',
				];
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Wajib Angka...!',
			];
		}
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Terjadi Kesalahan..!',
		];
	}
	echo json_encode($respone);
}else{

}
