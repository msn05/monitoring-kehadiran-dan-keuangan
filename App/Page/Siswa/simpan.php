<?php
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');

if (isset($_GET['Kirim'])) {


	$nisn 		 = test_input($_POST['nisn']);
	$kelas 		 = test_input($_POST['kelas']);
	$nama 		 = test_input($_POST['nama']);
	$Telehphone  = test_input($_POST['Telehphone']);
	$nama_ortu   = test_input($_POST['nama_ortu']);
	$kode 		 = test_input($_POST['kode']);
	$alamat 	 = test_input($_POST['alamat']);
	$JK 	 	 = test_input($_POST['JK']);
	$Pekerjaan 	 = test_input($_POST['Pekerjaan']);
	$TelphoneOrtu = test_input($_POST['TelphoneOrtu']);
	$HashD 	 	 = password_hash("123456",PASSWORD_DEFAULT);

	$PostData  	 = date('Y-m-d H:i:s');

	$id 	 	 = mt_rand(100, 9999)+1;
	$idNya 	 	 = mt_rand(100, 9999)+2;
	$idSiswa 	 	 = mt_rand(100, 9999)+2;

	if (

		!empty($nama) && !empty($nisn) && !empty($Telehphone) && !empty($nama_ortu) && !empty($alamat) && !empty($Pekerjaan) && !empty($TelphoneOrtu) ) {
		$DataCekEmail   = mysqli_query($conn,"SELECT a.id_siswa, a.id_kelas,a.id_ortu,a.nomor_telphone,a.nisn,b.id_ortu,b.no_telphone,c.KodeLogin,c.id_users from tb_siswa as a left join tb_ortu as b on b.id_ortu=a.id_ortu left join tb_users as c on c.id_users=b.id_ortu where a.id_siswa='".$id."' and a.id_kelas='".$kelas."' and a.nomor_telphone='".$Telehphone."' and a.nisn='".$nisn."' and b.id_ortu='".$kode."' and b.no_telphone='".$TelphoneOrtu."' and c.KodeLogin='".$kode."'");

		if (preg_match('/^[0-9]/', $nisn)){
			if (preg_match('/^[0-9]/', $Telehphone)){
				if (preg_match('/^[0-9]/', $TelphoneOrtu)){

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


										$Insert = mysqli_query($conn,"INSERT INTO `tb_siswa`(`id_siswa`, `nama`, `nisn`,`JenisKelamin`, `id_kelas`, `id_ortu`, `nomor_telphone`, `foto`,`status`) VALUES ('$idSiswa','$nama','$nisn','$JK','$kelas','$kode','$Telehphone','$FotoNya',NULL)");
										if ($Insert == true) {
											$InsertLaigi = mysqli_query($conn,"INSERT INTO `tb_ortu`(`id_ortu`, `nama_ortu`, `no_telphone`, `alamat`, `pekerjaan`) VALUES ('$kode','$nama_ortu','$TelphoneOrtu','$alamat','$Pekerjaan')");
											$InsertLaig = mysqli_query($conn,"INSERT INTO `tb_users`(`id_users`, `id_level`, `password_users`, `KodeLogin`) VALUES ('$kode','5','$HashD','$id')");

											$InsertLaigiii = mysqli_query($conn,"INSERT INTO `tb_users`(`id_users`, `id_level`, `password_users`, `KodeLogin`) VALUES ('$idSiswa','7','$HashD','$idNya')");

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
		$Insert = mysqli_query($conn,"UPDATE `tb_siswa` set status='1'where id_siswa='".$id."'");
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

	$id 		 	 = test_input($_POST['id']);
	$nisn 		 = test_input($_POST['nisn']);
	$kelas 		 = test_input($_POST['kelas']);
	$nama 		 = test_input($_POST['nama']);
	$Telehphone  = test_input($_POST['Telehphone']);
	$nama_ortu   = test_input($_POST['nama_ortu']);
	$kode 		 = test_input($_POST['kode']);
	$alamat 	 = test_input($_POST['alamat']);
	$JK 		 = test_input($_POST['JK']);
	$Pekerjaan 	 = test_input($_POST['Pekerjaan']);
	$TelphoneOrtu = test_input($_POST['TelphoneOrtu']);


	if (!empty($nama) && !empty($nisn) && !empty($Telehphone) && !empty($nama_ortu) && !empty($alamat) && !empty($Pekerjaan) && !empty($TelphoneOrtu) ) {
		$DataCekEmail   = mysqli_query($conn,"SELECT a.id_siswa,a.foto,a.id_kelas,a.id_ortu,a.nomor_telphone,a.nisn,b.id_ortu,b.no_telphone,c.KodeLogin,c.id_users from tb_siswa as a left join tb_ortu as b on b.id_ortu=a.id_ortu left join tb_users as c on c.id_users=b.id_ortu where a.id_siswa='".$id."' and a.id_kelas='".$kelas."' and a.nomor_telphone='".$Telehphone."' and a.nisn='".$nisn."' and b.id_ortu='".$kode."' and b.no_telphone='".$TelphoneOrtu."' and c.KodeLogin='".$kode."'");

		if (preg_match('/^[0-9]/', $nisn)){
			if (preg_match('/^[0-9]/', $Telehphone)){
				if (preg_match('/^[0-9]/', $TelphoneOrtu)){

					if (mysqli_num_rows($DataCekEmail) > 1) {
						$respone = [
							'status' => 'error',
							'message'=> 'Data Sudah Ada....!',
						];
					}else{
						$DataCek   = mysqli_query($conn,"SELECT id_siswa,foto from tb_siswa  where id_siswa='".$id."' ");
						$FotoLama				= mysqli_fetch_array($DataCek);
						$name     				= $_FILES['file']['name'];
						$lokasi  	 			= $_FILES['file']['tmp_name'];
						$Batas    				= $_FILES['file']['size'];
						$ekstensi_diperbolehkan = array('jpg','jpeg');
						$Pecah 					= explode('.', $name);
						$ekstensi 				= strtolower(end($Pecah));
						$FotoNya 				= $nama.'.jpeg';
						$TempatBaru 			= 'Image/'.$FotoNya;	
						if ($name != NULL) {
							if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
								if ($Batas <= 2000000) {
									unlink("Image/".$FotoLama['foto']);
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

										$Insert = mysqli_query($conn,"UPDATE `tb_siswa` SET nama='$nama',nisn='$nisn',JenisKelamin='$JK',id_kelas='$kelas',nomor_telphone='$Telehphone',foto='$FotoNya' WHERE id_siswa='".$id."'");

										if ($Insert == true) {
											$InsertLaigi = mysqli_query($conn,"UPDATE `tb_ortu` SET nama_ortu='$nama_ortu',no_telphone='$TelphoneOrtu',alamat='$alamat',pekerjaan='$Pekerjaan' WHERE id_ortu='".$kode."'");
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
							
							$Insert = mysqli_query($conn,"UPDATE `tb_siswa` SET nama='$nama',nisn='$nisn',JenisKelamin='$JK',id_kelas='$kelas',nomor_telphone='$Telehphone' WHERE id_siswa='".$id."'");

							if ($Insert == true) {
								$InsertLaigi = mysqli_query($conn,"UPDATE `tb_ortu` SET nama_ortu='$nama_ortu',no_telphone='$TelphoneOrtu',alamat='$alamat',pekerjaan='$Pekerjaan' WHERE id_ortu='".$kode."'");
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

}elseif(isset($_GET['UpdateOrtu'])){

	$id 				 = test_input($_POST['id']);
	$nama_ortu   = test_input($_POST['nama_ortu']);
	$alamat 	 		= test_input($_POST['alamat']);
	$Pekerjaan 	 = test_input($_POST['Pekerjaan']);
	$TelphoneOrtu = test_input($_POST['TelphoneOrtu']);
	$Password = test_input($_POST['Password']);
	

	if (preg_match('/^[0-9]/', $TelphoneOrtu)){
		$DataCek   = mysqli_query($conn,"SELECT no_telphone,id_ortu from tb_ortu  where id_ortu='".$id."' ");
		if (mysqli_num_rows($DataCek)>1) {
			$respone = [
				'status' => 'error',
				'message'=> 'Data Sudah Ada...!',
			];
		}else{

			$InsertLaigi = mysqli_query($conn,"UPDATE `tb_ortu` SET nama_ortu='$nama_ortu',no_telphone='$TelphoneOrtu',alamat='$alamat',pekerjaan='$Pekerjaan' WHERE id_ortu='".$id."'");
			if ($InsertLaigi == true) {
				if ($Password != '') {
					$PostData  	 = date('Y-m-d H:i:s');
					$PassHass = password_hash($Password,PASSWORD_DEFAULT);
					$InsertLaigi = mysqli_query($conn,"UPDATE `tb_users` SET password='$PassHass',created='$PostData' WHERE id_users='".$id."'");
				}else{
					$InsertLaigi = mysqli_query($conn,"UPDATE `tb_ortu` SET nama_ortu='$nama_ortu',no_telphone='$TelphoneOrtu',alamat='$alamat',pekerjaan='$Pekerjaan' WHERE id_ortu='".$id."'");
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
			'message'=> 'Format Angka....!',
		];

	}
	echo json_encode($respone);

}else{

}
