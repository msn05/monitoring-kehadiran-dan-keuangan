<?php
require_once(__DIR__.'/../../Function/db.php');
require_once(__DIR__.'/../../Function/Bulan.php');
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../../Assets/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

$dompdf = new Dompdf();

if (isset($_GET['Guru'])) {
	$Data  = $_GET['Guru'];
	$Keterangan = mysqli_fetch_array(mysqli_query($conn,"select a.active,a.id,a.nama_guru,a.nip,a.alamat,a.no_telphone,a.status_guru,a.created,b.id_users,a.foto,b.id_level,b.KodeLogin from tb_guru as a left join tb_users as b on b.id_users=a.id where a.id='".$Data."'"));
	$Level = mysqli_fetch_array(mysqli_query($conn,"select id_level,nama_level from tb_level where id_level='".$Keterangan['id_level']."'"));

	$html = '<table width="100%">
	<tr>
	<th>
	<img style="float:left, padding=100px" width="100px" src="../../../Assets/logo/cetak_icon.png">
	</th>
	<th style="float:left">
	<h3>SMA BINA PRATAMA LALAN</h3>
	<span>Desa Karang Rejo Primer 2 kecamatan Karang Agung Ilir 30758 Musi Banyuasin, Sumatera Selatan</span>
	</th>
	</tr>
	</table>
	<hr>';

	$html .= '<center><h3> Informasi Guru</center></h3><hr>';
	$html .= '<table width="100%">';
	$html .='
	<td>
	<img width="100px" src="../Guru/Image/'.$Keterangan['foto'].'"><br>
	'.$Keterangan['nama_guru'].'<br>
	'.$Level['nama_level'].'
	</td>
	<td>
	<th>Nama : '.$Keterangan['nama_guru'].'<br>
	NIP : '.$Keterangan['nip'].'</th>
	</td>
	';
	$html .='</html>';
	$dompdf->loadHtml($html);
	$dompdf->setPaper('A4', 'portrait');
	$dompdf->render();
	$dompdf->stream('Data Guru',array("Attachment"=>0));


}elseif(isset($_GET['CetakLaporanLainnya'])){
    $tahun 				= base64_decode($_GET['tahun']);
	$bulan 				= base64_decode($_GET['bulan']);
    $html = '
		<style>
		img {
			padding: 2px;
			width: 150px;
		}
		tr{
			margin-left:auto;
			margin-right:auto;
			border:1px;
		}
		.idhead{
			text-align: center;
		}
		footer {
			position: fixed; 
			bottom: 0cm; 
			float:right;
			right: 0cm;
			height: 5cm;
		}
		</style>
		<table width="100%">
		<tr>
		<th>
		<img class="img"  src="../../../Assets/logo/cetak_icon.png">
		</th>
		<th>
		<h3>SMA BINA PRATAMA LALAN</h3>
		<span>Desa Karang Rejo Primer 2 kecamatan Karang Agung Ilir 30758 Musi Banyuasin, Sumatera Selatan</span>
		</th>
		</tr>
		</table>
		<hr>';

		$html .= '<center><h3> LAPORAN KEHADIRAN SISWA KELAS</center></h3><hr>';
		$html .='<table width="100%" border="1px">
		<tr style="background-color: #fefbd8;">
		<th class="idhead">NO</th>
		<th class="idhead">NAMA SISWA</th>
		<th class="idhead">KELAS</th>
		<th class="idhead">KETERANGAN</th>
		<th class="idhead">TANGGAL</th>
		</tr>
	';
			$no = 1;
			$DataMapel = mysqli_query($conn,"select * from tb_laporan_lainnya where month(tanggal)='".$bulan."' and year(tanggal)='".$tahun."'");
													while ($Data = mysqli_fetch_array($DataMapel)) {
													    
													    $Siswa 					 = mysqli_fetch_array(mysqli_query($conn,"select id_siswa,nama,id_kelas from tb_siswa where id_siswa='".$Data['id_siswa']."'")); 
	$Kelas =mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$Siswa['id_kelas']."'"));
			$html .= '
			<tr class="idhead">
			<td>'.$no++.'</td>
				<td>'.$Siswa['nama'].'</td>
    <td>'.$Kelas['nama_kelas'].' / '.$Kelas['nama_jurusan'].' / '.$Kelas['periode'].' / '.$Kelas['semester'].'</td>
    <td>'.$Data['keterangan'].'</td>
    <td>'.date('d-m-Y',strtotime($Data['tanggal'])).'</td>
			
			</tr>
			';
		}
		$html .=	'<footer>
		<p>Palembang, '.date('d-m-Y').'</p>
		<span> mengetahui</span>
		<br>
		<br>
		<br>
		<br>
		<p>Kepala Sekolah
		</footer>';
		$html .= "</html>";
	$dompdf->loadHtml($html);
	$dompdf->setPaper('A4', 'landscape');
	$dompdf->render();
	$dompdf->stream('Laporan Lainnya',array("Attachment"=>0));
}elseif(isset($_GET['CetakLaporan'])){
	$kelas  			= base64_decode($_GET['kelas']);
	$tahun 				= base64_decode($_GET['tahun']);
	$bulan 				= base64_decode($_GET['bulan']);
	$KategoriLaporan 	= base64_decode($_GET['KategoriLaporan']);
	$Kelas =mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$kelas."'"));
	$DataWaliKelas = mysqli_fetch_array(mysqli_query($conn,"select * from tb_wali_kelas where id_kelas='".$kelas."'"));
	$Guru = mysqli_fetch_array(mysqli_query($conn,"select id,nama_guru,nip from tb_guru where id='".$DataWaliKelas['id_guru']."'"));
	$Siswa 					 = mysqli_query($conn,"select nisn,id_siswa,JenisKelamin,nama,id_kelas from tb_siswa where id_kelas='".$kelas."'"); 

	if ($KategoriLaporan == 1) {

		$html = '
		<style>
		img {
			padding: 2px;
			width: 150px;
		}
		tr{
			margin-left:auto;
			margin-right:auto;
			border:1px;
		}
		.idhead{
			text-align: center;
		}
		footer {
			position: fixed; 
			bottom: 0cm; 
			float:right;
			right: 0cm;
			height: 5cm;
		}
		</style>
		<table width="100%">
		<tr>
		<th>
		<img class="img"  src="../../../Assets/logo/cetak_icon.png">
		</th>
		<th>
		<h3>SMA BINA PRATAMA LALAN</h3>
		<span>Desa Karang Rejo Primer 2 kecamatan Karang Agung Ilir 30758 Musi Banyuasin, Sumatera Selatan</span>
		</th>
		</tr>
		</table>
		<hr>';

		$html .= '<center><h3> LAPORAN KEHADIRAN SISWA KELAS</center></h3><hr>';
		$html .='<table width="100%" border="1px">
		<tr style="background-color: #fefbd8;">
		<th rowspan="2" class="idhead">NISN</th>
		<th rowspan="2" class="idhead">NAMA SISWA</th>
		<th rowspan="2" class="idhead">JENIS KELAMIN</th>
		<th colspan="4" class="idhead">KETERANGAN</th>
		<th rowspan="2" class="idhead">TOTAL KETIDAKHADIRAN</th>
		</tr>
		<tr class="idhead">
		<th>SAKIT</th>
		<th>ALPA</th>
		<th>IZIN</th>
		<th>HADIR</th>
		</tr>';
		while ($Data = mysqli_fetch_array($Siswa)) {
			$DataAbsensiSakit = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Sakit' and action_update='1' "));
			$DataAbsensiSakitNya = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Sakit' and action_update='2' "));
			$DataAbsensiAlpaNya = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Alpa' and action_update='2' "));
			$DataAbsensiAlpa = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Alpa' and action_update='1' "));
			$DataAbsensiIzin = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Izin' and action_update='1' "));
			$DataAbsensiIzinNya = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Izin' and action_update='2' "));
			$DataAbsensiHadir = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Hadir' and action_update='1' "));

			$html .= '
			<tr class="idhead">
			<td>'.$Data['nisn'].'</td>
			<td>'.$Data['nama'].'</td>
			<td>'.$Data['JenisKelamin'].'</td>
			<td>'.($DataAbsensiSakit['Total'] + $DataAbsensiSakitNya['Total']).'</td>
			<td>'.($DataAbsensiAlpa['Total']  + $DataAbsensiAlpaNya['Total']).'</td>
			<td>'.($DataAbsensiIzin['Total']  + $DataAbsensiIzinNya['Total']).'</td>
			<td>'.$DataAbsensiHadir['Total'] .'</td>
			<td>'.($DataAbsensiAlpa['Total'] + $DataAbsensiAlpaNya['Total'] + $DataAbsensiSakit['Total'] + $DataAbsensiSakitNya['Total'] + $DataAbsensiIzin['Total']  + $DataAbsensiIzinNya['Total']) .'</td>
			</tr>
			';
		}
		$html .=	'<footer>
		<p>Palembang, '.date('d-m-Y').'</p>
		<span> mengetahui</span>
		<br>
		<br>
		<br>
		<br>
		<p>'.$Guru['nama_guru'].'</p><span>'.$Guru['nip'].'
		</footer>';
		$html .= "</html>";
			$dompdf->loadHtml($html);
	$dompdf->setPaper('A4', 'landscape');
	$dompdf->render();
	$dompdf->stream('Laporan Absensi Siswa',array("Attachment"=>0));
	}elseif($KategoriLaporan==2){
		require_once(__DIR__.'/../../Function/Terbilang.php');
		$html = '
		<style>
		img {
			padding: 2px;
			width: 150px;
		}
		tr{
			margin-left:auto;
			margin-right:auto;
			border:1px;
		}
		.idhead{
			text-align: center;
		}
		footer {
			position: fixed; 
			bottom: 0cm; 
			float:right;
			right: 0cm;
			height: 5cm;
		}
		</style>
		<table width="100%">
		<tr>
		<th>
		<img class="img"  src="../../../Assets/logo/cetak_icon.png">
		</th>
		<th>
		<h3>SMA BINA PRATAMA LALAN</h3>
		<span>Desa Karang Rejo Primer 2 kecamatan Karang Agung Ilir 30758 Musi Banyuasin, Sumatera Selatan</span>
		</th>
		</tr>
		</table>
		<hr>';

		$html .= '<center><h3> LAPORAN PEMBAYARAN IURAN SEKOLAH</center></h3><hr>';
		$html .='<table width="100%" border="1px">
		<tr style="background-color: #fefbd8;">
		<th class="idhead">NISN</th>
		<th class="idhead">NAMA SISWA</th>
		<th class="idhead">JENIS KELAMIN</th>
		<th class="idhead">NOMINAL</th>
		<th class="idhead">KETERANGAN</th>
		<th class="idhead">TERBILANG</th>
		</tr>
		';
		while ($Data = mysqli_fetch_array($Siswa)) {
			$DataKeuangan = mysqli_fetch_array(mysqli_query($conn,"select * from tb_keuangan where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."'"));

			$html .= '
			<tr class="idhead">
			<td>'.$Data['nisn'].'</td>
			<td>'.$Data['nama'].'</td>
			<td>'.$Data['JenisKelamin'].'</td>
			<td>Rp.'.number_format($DataKeuangan['nominal'],2,',','.').'
			<td>'.(($DataKeuangan['nominal']) < 49999 ? "Belum Lunas" : " Lunas").'</td>
			<td>'.(TERBILANG($DataKeuangan['nominal'])).'</td>
			</tr>
			';
		}
		$html .=	'<footer>
		<p>Palembang, '.date('d-m-Y').'</p>
		<span> mengetahui</span>
		<br>
		<br>
		<br>
		<br>
		<p>'.$Guru['nama_guru'].'</p><span>'.$Guru['nip'].'
		</footer>';
		$html .= "</html>";
				$dompdf->loadHtml($html);
	$dompdf->setPaper('A4', 'landscape');
	$dompdf->render();
	$dompdf->stream('Laporan Pembayaran Iuran Siswa',array("Attachment"=>0));
	}elseif($KategoriLaporan == 3){
        $html = '
		<style>
		img {
			padding: 2px;
			width: 150px;
		}
		tr{
			margin-left:auto;
			margin-right:auto;
			border:1px;
		}
		.idhead{
			text-align: center;
		}
		footer {
			position: fixed; 
			bottom: 0cm; 
			float:right;
			right: 0cm;
			height: 5cm;
		}
		</style>
		<table width="100%">
		<tr>
		<th>
		<img class="img"  src="../../../Assets/logo/cetak_icon.png">
		</th>
		<th>
		<h3>SMA BINA PRATAMA LALAN</h3>
		<span>Desa Karang Rejo Primer 2 kecamatan Karang Agung Ilir 30758 Musi Banyuasin, Sumatera Selatan</span>
		</th>
		</tr>
		</table>
		<hr>';

		$html .= '<center><h3> LAPORAN NILAI SISWA KELAS '.$Kelas['nama_kelas'].'Nama Jurusan'.$Kelas['nama_jurusan'].' Periode '.$Kelas['tahun_ajara'].'</center></h3><hr>';
	
	    $KelasSiswa = mysqli_query($conn,"select * from tb_siswa where id_kelas='".$kelas."'");
		while ($Siswa = mysqli_fetch_array($KelasSiswa)) {
		$NilaiSiswa  = mysqli_fetch_array(mysqli_query($conn,"select * from tb_nilai where id_siswa='".$Siswa['id_siswa']."'"));
		$NamaOrtu  = mysqli_fetch_array(mysqli_query($conn,"select * from tb_ortu where id_ortu='".$Siswa['id_ortu']."'"));
		$html .= '	<table width="100%">
		<tr>
		<th>NISN</th>
        <th>:</th>
      	<th>'.$Siswa['nama'].'</th>
			</tr>
			<tr>
			<th> NISN Siswa</th>
			<th> :</th>
			<th>'.$Siswa['nisn'].'</th>
			</tr>
		<tr>
		<th>Jenis Kelamin</th>
        <th>:</th>
      	<th>'.$Siswa['jk'].'</th>
		</tr>
		tr>
		<th>Nama Ortu</th>
        <th>:</th>
      	<th>'.$NamaOrtu['nama_ortu'].'</th>
			</tr>
		
			</table>
			  <hr>';
		   $html .= '	<table width="100%">';
		   	$RowPand = mysqli_fetch_array(mysqli_query($conn,"select *,count(id_mata_pelajaran) as total from tb_nilai where year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' group by id_mata_pelajaran "));
	$html .= '
    
    <tr bgcolor="#F0FFFF">
    <th rowspan="2" class="text-center">MATA PELAJARAN</th>
	<th colspan='.$RowPand['total'].' class="text-center">TANGGAL</th>';
	$html.='
	<tr>';
	$Tanggal = mysqli_query($conn,"select * from tb_nilai where year(tanggal)='".$tahun."' and month(	tanggal)='".$bulan."' and id_siswa='".$Siswa['id_siswa']."' and id_mata_pelajaran");
	while ($DataTanggalPelajaran = mysqli_fetch_array($Tanggal)) {
	$html.='
	<td>'.date('d',strtotime($DataTanggalPelajaran['tanggal'])).'</td>';
	}

$html.='</tr>';

	$MataPelajaran = mysqli_query($conn,"select * from tb_nilai where id_siswa='".$Siswa['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' group by id_mata_pelajaran ");
		while ($MataPelajaranNya = mysqli_fetch_array($MataPelajaran)) {
			$NamaPelajaran = mysqli_fetch_array(mysqli_query($conn,"select * from tb_mata_pelajaran where id_pelajaran='".$MataPelajaranNya['id_mata_pelajaran']."'"));
				$html.='	
				<tr>
				<td>'.$NamaPelajaran['nama_pelajaran'].'</td>';
				$NilaiMataPelajaran = mysqli_query($conn,"select * from tb_nilai where id_mata_pelajaran='".$MataPelajaranNya['id_mata_pelajaran']."' and id_siswa='".$MataPelajaranNya['id_siswa']."'");
				while ($NilaiNya = mysqli_fetch_array($NilaiMataPelajaran)) {
					$html.='
							<td>'.$NilaiNya['nilai'].'</td>';
							 }
					$html.='</tr>';
		}
		$html.='</table>
		<hr>
		<br>
		';
}
	
	$dompdf->loadHtml($html);
	$dompdf->setPaper('A4', 'landscape');
	$dompdf->render();
	$dompdf->stream('Laporan Monitoring',array("Attachment"=>0));

}


}else{

	$Data  			= $_GET['CatatanHitamAbsensiSiswa'];
	$KeteranganNya 	= mysqli_query($conn,"select * from tb_bk where id='".$Data."'");
// $KeteranganNyaID 	= mysqli_query($conn,"select * from tb_bk where id='".$Data."'");
	$Keterangan 	= mysqli_fetch_array($KeteranganNya);
	$Siswa 		 	= mysqli_fetch_array(mysqli_query($conn,"select nisn,id_ortu,id_siswa,nama from tb_siswa where id_siswa='".$Keterangan['id_siswa']."'")); 
	$Ortu 		 	= mysqli_fetch_array(mysqli_query($conn,"select * from tb_ortu where id_ortu='".$Siswa['id_ortu']."'")); 

	$html = '<table width="100%">
	<tr>
	<th>
	<img style="float:left, padding=100px" width="100px" src="../../../Assets/logo/cetak_icon.png">
	</th>
	<th style="float:left">
	<h3>SMA BINA PRATAMA LALAN</h3>
	<span>Desa Karang Rejo Primer 2 kecamatan Karang Agung Ilir 30758 Musi Banyuasin, Sumatera Selatan</span>
	</th>
	</tr>
	</table>
	<hr>';
	$html .= '<center><h3> Surat Panggilan </center></h3><hr>';
	$html .='<table>
	<tr>
	<td>
	<th>Kode Pemanggilan </th>
	<th>:</th>
	<th>'.$Keterangan['kode_bk'].'</th>
	</td>
	</tr>
	<tr>
	<td>
	<th>Tanggal </th>
	<th>:</th>
	<th>'.date('d F Y',strtotime($Keterangan['tanggal_dibuat'])).'</th>
	</td>
	</tr>
	<tr>
	<td>
	<th>Perihal </th>
	<th>:</th>
	<th>'.($Keterangan['keterangan'] == 1 ? 'Absensi' : ($Keterangan['keterangan'] == 2 ? 'Pembayaran' : 'Nilai')).'</th>
	</td>
	</tr>
	</table>
	<p> Melalui surat ini, kami memberitahukan bahwa anak bapak/ibu yang bernama '.$Siswa['nama'].'  '.($Keterangan['keterangan']==1 ? 'telah 3x tidak mengahadiri sekolah' : ($Keterangan['keterangan'] == 2 ? 'uang Pembayaran iuran sekolah kurang.' : 'Nilai Bermasalah')).' Untuk itu kami pihak sekolah melalui surat ini, untuk memanggil bapak/ibu guna mengetahui penyebab yang dialamani anak.

	Demikian surat ini kami informasikan agar ibuk/ bapak dapat datang kesekolah. 
	Terima Kasih..
	';	
	$dompdf->loadHtml($html);
	$dompdf->setPaper('A4', 'portrait');
	$dompdf->render();
	$dompdf->stream('Surat Pemanggilan Siswa',array("Attachment"=>0));


    
}

