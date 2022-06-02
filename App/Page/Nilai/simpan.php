	<?php
	require_once(__DIR__.'/../../Function/base_url.php');
	require_once(__DIR__.'/../../Function/db.php');
	require_once(__DIR__.'/../../Function/Bulan.php');

	if (isset($_GET['CariData'])) {
	    session_start();
        $hari = hari_ini();
        $idSession = $_SESSION['id'];

   
		$DataKelas = $_POST['kelas'];
		
		$CariMatapelajaran = mysqli_query($conn,"select * from tb_jadwal_penilaian_mata_pelajaran where id_guru='".$idSession."' and  id_kelas='$DataKelas' and hari='$hari'");
		
		echo "<div class='col-md-4'>
		<label class='control-label'><span class='text-danger'> * </span> Mata Pelajaran</label>
		<div class='form-group'>
		<div class='col-md-10'>
		<select class='form-control select2' name='Mapel' id='Mapel'>
		<option value='0'>Pilih Mata Pelajaran</option>
		";
		while ($Data = mysqli_fetch_array($CariMatapelajaran)) {
		  
			$MataPelajaran = mysqli_fetch_array(mysqli_query($conn,"select id_pelajaran,nama_pelajaran from tb_mata_pelajaran where id_pelajaran='".$Data['id_pelajaran']."' group by nama_pelajaran asc"));
			echo "
			<option value=".$Data['id_pelajaran'].">".$MataPelajaran['nama_pelajaran']."</option>
			";
		}
		echo "</select>
		</div>
		</div>
		</div>
		</div>
		";


	}elseif(isset($_GET['Kirim'])){
		$kelas 	 		= test_input($_POST['kelas']);
		$Mapel 	 		= test_input($_POST['Mapel']);
		if ($kelas != 0) {
			if ($Mapel != 0) {
				$Tanggal 	 	= test_input($_POST['Tanggal']);
				$Insert = mysqli_query($conn,"select a.id_siswa,a.tanggal,a.id_mata_pelajaran,b.id_siswa,b.id_kelas from tb_nilai as a inner join tb_siswa as b on a.id_siswa=b.id_siswa where a.id_siswa and a.tanggal='".$Tanggal."' and b.id_kelas='".$kelas."' and a.id_mata_pelajaran='".$Mapel."'");
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
					'message'=> 'Mata Pelajaran Kosong.!',
				];
			}
		}else{
			$respone = [
				'status' => 'warning',
				'message'=> 'Kelas Kosong.!',
			];
		}
		echo json_encode($respone);

	}elseif(isset($_GET['Update'])){
		

		$id_siswa = $_POST['id_siswa'];
		$Mapel 		= $_POST['mapel'];
		$tanggal  = $_POST['tanggal'];
		$nominal  = $_POST['nominal'];
		$id_guru  = $_POST['id_guru'];

		for ($i=0; $i <count($nominal) ; $i++) { 
			$DataCekNya = mysqli_query($conn,"select id_siswa,tanggal,id_mata_pelajaran from tb_nilai where id_siswa='".$id_siswa[$i]."' and tanggal='".$tanggal."' and id_mata_pelajaran='".$Mapel."'");

			if (mysqli_num_rows($DataCekNya) > 0) {
				$Insert = mysqli_query($conn,"UPDATE `tb_nilai` SET nilai='$nominal[$i]',id_mata_pelajaran='".$Mapel."',Tanggal='".$tanggal."' WHERE id_siswa='".$id_siswa[$i]."'");
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil ..!',
				];
			}else{
				$Insert = mysqli_query($conn,"INSERT INTO `tb_nilai`(`id`, `id_mata_pelajaran`, `id_siswa`, `nilai`, `id_guru`, `tanggal`, `action_update`) VALUES ('','$Mapel','$id_siswa[$i]','$nominal[$i]','$id_guru','$tanggal','1')");
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil..!',
				];
			}
		}
		echo json_encode($respone);


	}elseif(isset($_GET['Valid'])){

		$id_siswa = $_POST['id_siswa'];
		$radar  = $_POST['nominal'];
		$tanggal  = $_POST['tanggal'];
		$totalNilai = count($radar); 
		if (empty($radar)) {
			$respone = [
				'status' => 'error',
				'message'=> 'Maaf Data Gagal Tersimpan..!',
			];
		}else{
			for ($i=0; $i <$totalNilai ; $i++) { 
				$Insert = mysqli_query($conn,"UPDATE `tb_nilai` SET action_update='2' WHERE id_siswa='".$id_siswa[$i]."' and tanggal='".$tanggal."'");
				$respone = [
					'status' => 'success',
					'message'=> 'Data Berhasil Tersimpan..!',
				];

			}
		}
		echo json_encode($respone);
	}else{

	}