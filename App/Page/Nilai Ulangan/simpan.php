<?php
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');

if (isset($_GET['CariData'])) {
	$tanggal 	= date('Y');
	$DataKelas = $_POST['kelas'];
	$CariMatapelajaran = mysqli_query($conn,"select * from tb_jadwal_penilaian_mata_pelajaran where id_kelas='$DataKelas'");
	echo "
	<div class='col-md-4'>
	<label class='control-label'><span class='text-danger'> * </span> Mata Pelajaran</label>
	<div class='form-group'>
	<div class='col-md-10'>
	<select class='form-control select2' name='Mapel' id='Mapel'>
	<option value='0'>Pilih Mata Pelajaran</option>
	";
	while ($Data = mysqli_fetch_array($CariMatapelajaran)) {
		$MataPelajaran = mysqli_fetch_array(mysqli_query($conn,"select id_pelajaran,nama_pelajaran from tb_mata_pelajaran where id_pelajaran='".$Data['id_pelajaran']."'  "));
		echo "
		<option value=".$Data['id_pelajaran'].">".$MataPelajaran['nama_pelajaran']."</option>
		";
	}
	echo "</select>
	</div>
	</div>
	</div>
	<div class='col-md-4'>
	<label class='control-label'><span class='text-danger'> * </span> Mata Pelajaran</label>
	<div class='form-group'>
	<div class='col-md-10'>
	<select class='form-control select' name='KategoriUlangan' id='KategoriUlangan'>
	<option value='0'>Pilih Kategori Ulangan</option>
	<option value='1'>Semester</option>
	<option value='2'>Akhir</option>
	</select>
	<input type='hidden' name='tahunnya' id='tahunnya' value=".$tanggal.">
	</div>
	</div>
	</div>
	</div>
	";


}elseif(isset($_GET['Kirim'])){
	$kelas 	 		= test_input($_POST['kelas']);
	$Mapel 	 		= test_input($_POST['Mapel']);
	$KategoriUlangan= test_input($_POST['KategoriUlangan']);
	$tahunAjaran	= test_input($_POST['tahunnya']);
	if ($kelas != 0) {
		if ($Mapel != 0) {
			if ($KategoriUlangan != 0) {
				$Insert = mysqli_query($conn,"select a.id_siswa,a.id_pelajaran,a.kategori_nilai,a.tgl_post,b.id_siswa,b.id_kelas from tb_nilai_ulangan as a inner join tb_siswa as b on a.id_siswa=b.id_siswa where a.id_siswa and b.id_kelas='".$kelas."' and a.id_pelajaran='".$Mapel."' and kategori_nilai='".$KategoriUlangan."' and a.tgl_post='".$tahunAjaran."'");
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
					'message'=> 'Kategori Ulangan Kosong.!',
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

	$id_siswa 	 	= $_POST['id_siswa'];
	$Mapel 	  	 	= $_POST['mapel'];
	$tahunnya 	 	= $_POST['tahun'];
	$id_guru  	 	= $_POST['id_guru'];
	$nilai 	  	 	= $_POST['nilai'];
	$semesterNya = $_POST['semesterNya'];

	for ($i=0; $i <count($nilai) ; $i++) { 
		$DataCekNya = mysqli_query($conn,"select id_siswa,tgl_post,kategori_nilai,id_pelajaran from tb_nilai_ulangan where id_siswa='".$id_siswa[$i]."' and id_pelajaran='".$Mapel."' and tgl_post='".$tahunnya."' and kategori_nilai='".$semesterNya."'");
		if (mysqli_num_rows($DataCekNya) > 0) {
			$Insert = mysqli_query($conn,"UPDATE `tb_nilai_ulangan` SET nilai='$nilai[$i]',id_pelajaran='".$Mapel."',tgl_post='".$tahunnya."' WHERE id_siswa='".$id_siswa[$i]."'");
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil ..!',
			];
		}else{
			$Insert = mysqli_query($conn,"INSERT INTO `tb_nilai_ulangan`(`id`,`id_siswa`,`kategori_nilai`,`nilai`,`id_pelajaran`, `id_guru`,`tgl_post`,`action_update`) VALUES ('','$id_siswa[$i]','$semesterNya','$nilai[$i]','$Mapel','$id_guru','$tahunnya','1')");
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil..!',
			];
		}
	}
	echo json_encode($respone);


}elseif(isset($_GET['Valid'])){

	$id_siswa 		 = $_POST['id_siswa'];
	$tahunnya 	 	= $_POST['tahun'];
	$nilai 	  	 	= $_POST['nilai'];
	$semesterNya = $_POST['semesterNya'];
	$totalNilai  = count($nilai); 

	if (empty($nilai)) {
		$respone = [
			'status' => 'error',
			'message'=> 'Maaf Data Gagal Tersimpan..!',
		];
	}else{
		for ($i=0; $i <$totalNilai ; $i++) { 
			$Insert = mysqli_query($conn,"UPDATE `tb_nilai_ulangan` SET action_update='2' WHERE id_siswa='".$id_siswa[$i]."' and tgl_post='".$tahunnya."' and kategori_nilai='".$semesterNya."'");
			$respone = [
				'status' => 'success',
				'message'=> 'Data Berhasil Tersimpan..!',
			];

		}
	}
	echo json_encode($respone);
}else{

}