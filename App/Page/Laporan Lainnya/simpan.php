	<?php
	require_once(__DIR__.'/../../Function/base_url.php');
	require_once(__DIR__.'/../../Function/db.php');

	if (isset($_GET['CariData'])) {

		$DataKelas = $_POST['kelas'];
		$CariMatapelajaran = mysqli_query($conn,"select * from tb_jadwal_penilaian_mata_pelajaran where id_kelas='$DataKelas' group by id_kelas asc");
		
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
				$Insert = mysqli_query($conn,"select a.id_siswa,a.tanggal,a.id_mata_pelajaran,b.id_siswa,b.id_kelas from tb_laporan_lainnya as a inner join tb_siswa as b on a.id_siswa=b.id_siswa where a.id_siswa and a.tanggal='".$Tanggal."' and b.id_kelas='".$kelas."' and a.id_mata_pelajaran='".$Mapel."'");
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

	}elseif(isset($_GET['CekLaporan'])){
// 		$kelas 	 		= test_input($_POST['kelas']);
		$bulan 	 		= test_input($_POST['bulan']);
				$tahun 	 		= test_input($_POST['tahun']);
		if ($bulan != '' && $tahun != '') {

				$Tanggal 	 	= test_input($_POST['Tanggal']);
				$Insert = mysqli_query($conn,"select * from tb_laporan_lainnya where month(tanggal)='".$bulan."' and year(tanggal)='".$tahun."'");
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
				'status' => 'error',
				'message'=> 'Maaf Ada Form yang masih Kosong ...!',
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



	}elseif(isset($_GET['PostData'])){
		
		$id_siswa    = $_POST['id_siswa'];
		$Mapel 		 = $_POST['mapel'];
		$tanggal  	 = $_POST['tanggal'];
		$keterangan  = $_POST['keterangan'];
		$id_guru  	 = $_POST['id_guru'];
		if (empty($keterangan)) {
			$respone = [
				'status' => 'error',
				'message'=> 'Maaf Keterangan Tidak Boleh Kosong..!',
			];
		}else{

			$Insert = mysqli_query($conn,"INSERT INTO `tb_laporan_lainnya`(`id_laporan_lainnya`, `id_guru`, `id_siswa`, `tanggal`, `id_mata_pelajaran`, `keterangan`) VALUES ('','$id_guru','$id_siswa','$tanggal','$Mapel','$keterangan')");
			if ($Insert == true) {
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil..!',
				];
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Maaf Terjadi Kesalahan ',
				];
			}
		}
		echo json_encode($respone);


	}elseif(isset($_GET['UpdateData'])){

		$name_id = $_POST['name_id'];
		$keterangan  = $_POST['keterangan'];
		if (empty($keterangan)) {
			$respone = [
				'status' => 'error',
				'message'=> 'Maaf Keterangan Tidak Boleh Kosong..!',
			];
		}else{
			$Insert = mysqli_query($conn,"UPDATE `tb_laporan_lainnya` set keterangan='$keterangan' WHERE id_laporan_lainnya='".$name_id."'");
			if ($Insert == true) {
				$respone = [
					'status' => 'success',
					'message'=> 'Data Mengubah Catatan..!',
				];
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Terjadi Kesalahan..!',
				];
			}
		}
		echo json_encode($respone);

	}elseif(isset($_GET['DeleteCatatan'])){

		$name_id = $_POST['name_id'];
		if ($name_id != '') {
			$Insert = mysqli_query($conn,"DELETE FROM `tb_laporan_lainnya` WHERE id_laporan_lainnya='".$name_id."'");
			$respone = [
				'status' => 'success',
				'message'=> 'Data Berhasil Terhapus..!',
			];
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Terjadi Kesalahan..!',
			];
		}
		echo json_encode($respone);
	}else{

	}