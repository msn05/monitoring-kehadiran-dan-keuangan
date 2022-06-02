<?php
require_once(__DIR__.'/App/Function/db.php');
require_once(__DIR__.'/App/Function/base_url.php');

$name 			= test_input($_POST['exampleInputEmail_1']);
$password 		= test_input($_POST['exampleInputpwd_2']);

if ($name != '' || $password != '') {
	$CekData= mysqli_query($conn,"select KodeLogin,password_users,id_users,id_level from tb_users  where KodeLogin='".$name."'");
	$Data 	= mysqli_fetch_array($CekData);
	if ($Data['id_level'] > 0) {
		if (mysqli_num_rows($CekData)) {
			if(password_verify($password,$Data['password_users'])) {
				session_start();
				$_SESSION['id']			= $Data['id_users'];
				$_SESSION['Kode']		= $Data['KodeLogin'];
				$_SESSION['Level']		= $Data['id_level'];
				$_SESSION['LogIn']		= true;
				$respone = [
					'status' => 'success',
					'message'=> 'Anda Berhasil Terverifikasi..!'
				];

				
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Maaf Password Anda Salah...!'
				];
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Data Anda Tidak Tersedia.!'
			];

		}
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Anda Tidak Mempunyai Aksess..!'
		];
	}

}else{
	$respone = [
		'status' => 'error',
		'message'=> 'Wajib Diisi..!'
	];
}
echo json_encode($respone);




