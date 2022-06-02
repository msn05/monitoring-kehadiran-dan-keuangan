
<div class="right-sidebar-backdrop"></div>
<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row heading-bg">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark"><?=ucwords($_GET['Halaman']);?></h5>
			</div>
			<!-- Breadcrumb -->
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="index.html">Dashboard</a></li>
					<li class="active"><span>Data <?=$_GET['Halaman'];?></span></li>
				</ol>

			</div>
		</div>
		<?php
	
		include(__DIR__.'/../../Function/Bulan.php');
		$kelas  			= $_GET['kelas'];
		$tahun 				= $_GET['tahun'];
		$bulan 				= $_GET['bulan'];
		$KategoriLaporan 	= $_GET['KategoriData'];


		$Kelas =mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$kelas."'"));

		$DataWaliKelas = mysqli_fetch_array(mysqli_query($conn,"select * from tb_wali_kelas where id_kelas='".$kelas."'"));
		$Guru = mysqli_fetch_array(mysqli_query($conn,"select id,nama_guru from tb_guru where id='".$DataWaliKelas['id_guru']."'"));

		if ($KategoriLaporan == 1) {?>
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default ">
						<div class="panel-heading">
							<div class="pull-left">
								<h5 class="panel-title txt-dark"> Kelas ini diwali kelas kan kepada guru atas nama <?=$Guru['nama_guru'];?></h5>
							</div>
							<div class="pull-right">
								<a href="?Halaman=Laporan" class="btn btn-warning btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Tambah Data">Kembali</span></a>

	<a href='App/Page/Cetak/Cetak.php?CetakLaporan&kelas=<?=base64_encode($kelas);?>&bulan=<?=base64_encode($bulan);?>&tahun=<?=base64_encode($tahun);?>&KategoriLaporan=<?=base64_encode($KategoriLaporan);?>' target='_blank' class="btn btn-success btn-anim"><i class="ti-printer"></i><span class="btn-text" title="Cetak Data">Cetak Data</a>

						
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default ">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Laporan Kehadiran Kelas <?=$Kelas['nama_kelas'].' - '.$Kelas['nama_jurusan']. ' / '.$Kelas['periode']. ' / '.$Kelas['semester'];?> Pada Bulan <?=Bulan($bulan) . ' Tahun '. $tahun;?> </h6>

								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="datable_2" class="table table-hover table-bordered display mb-30" >
												<thead>
													<tr>
														<th rowspan="2">NISN</th>
														<th rowspan="2">NAMA SISWA</th>
														<th colspan="4" class="text-center">KETERANGAN</th>
														<th rowspan="2" class="text-center">TOTAL KETIDAKHADIRAN</th>
													</tr>
													<tr>
														<th>SAKIT</th>
														<th>ALPA</th>
														<th>IZIN</th>
														<th>HADIR</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>NISN</th>
														<th>NAMA</th>
														<th>SAKIT</th>
														<th>ALPA</th>
														<th>IZIN</th>
														<th>HADIR</th>
														<th>TOTAL KETIDAKHADIRAN</th>
													</tr>
												</tfoot>
												<tbody>
													<?php 
													$Siswa 					 = mysqli_query($conn,"select nisn,id_siswa,nama,id_kelas from tb_siswa where id_kelas='".$kelas."'"); 
													while ($Data = mysqli_fetch_array($Siswa)) {
														$DataAbsensiSakit = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Sakit' and action_update='1' "));
														$DataAbsensiSakitNya = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Sakit' and action_update='2' "));
														$DataAbsensiAlpaNya = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Alpa' and action_update='2' "));
														$DataAbsensiAlpa = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Alpa' and action_update='1' "));
														$DataAbsensiIzin = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Izin' and action_update='1' "));
														$DataAbsensiIzinNya = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Izin' and action_update='2' "));
														$DataAbsensiHadir = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Hadir' and action_update='1' "));
														$SuratPanggilan = mysqli_fetch_array(mysqli_query($conn,"select id,id_siswa,tanggal_dibuat from tb_bk where keterangan ='1'"));
														?>
														<tr>
															<td><?=$Data['nisn'];?></td>
															<td><?=$Data['nama'];?></td>
															<td><?=$DataAbsensiSakit['Total'] + $DataAbsensiSakitNya['Total'];?></td>
															<td><?=$DataAbsensiAlpa['Total']  + $DataAbsensiAlpaNya['Total'];?></td>
															<td><?=$DataAbsensiIzin['Total']  + $DataAbsensiIzinNya['Total'];?></td>
															<td><?=$DataAbsensiHadir['Total'] ;?></td>
															<td><?=$DataAbsensiAlpa['Total'] + $DataAbsensiAlpaNya['Total'] + $DataAbsensiSakit['Total'] + $DataAbsensiSakitNya['Total'] + $DataAbsensiIzin['Total']  + $DataAbsensiIzinNya['Total'] ;?></td>
														</tr>
													<?php }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div> 
					</div>
				</div>
			<?php }elseif ($KategoriLaporan == 2) {
				include(__DIR__.'/../../Function/Terbilang.php');
				?>
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default ">
							<div class="panel-heading">
								<div class="pull-left">
									<h5 class="panel-title txt-dark"> Kelas ini diwali kelas kan kepada guru atas nama <?=$Guru['nama_guru'];?></h5>
								</div>
								<div class="pull-right">
									<a href="?Halaman=Buku Hitam Siswa" class="btn btn-warning btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Tambah Data">Kembali</span></a>

									<a href='App/Page/Cetak/Cetak.php?CetakLaporan&kelas=<?=base64_encode($kelas);?>&bulan=<?=base64_encode($bulan);?>&tahun=<?=base64_encode($tahun);?>&KategoriLaporan=<?=base64_encode($KategoriLaporan);?>' target='_blank' class="btn btn-success btn-anim"><i class="ti-printer"></i><span class="btn-text" title="Cetak Data">Cetak Data</a>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default ">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Data Pembayaran Iuran Kelas <?=$Kelas['nama_kelas'].' - '.$Kelas['nama_jurusan']. ' / '.$Kelas['periode']. ' / '.$Kelas['semester'];?> Pada Bulan <?=Bulan($bulan) . ' Tahun '. $tahun;?> </h6>
									</div>
									<div class="clearfix"></div>
								</div>

								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="table-wrap">
											<div class="table-responsive">
												<table id="datable_2" class="table table-hover table-bordered display mb-30" >
													<thead>
														<tr>
															<th>NISN</th>
															<th>NAMA SISWA</th>
															<th>JUMLAH</th>
															<th>KETERANGAN</th>
															<th>TERBILANG</th>
														</tr>
													</thead>
													<tfoot>
														<tr>
															<th>NISN</th>
															<th>NAMA SISWA</th>
															<th>JUMLAH</th>
															<th>KETERANGAN</th>
															<th>TERBILANG</th>
														</tr>
													</tfoot>
													<tbody>
														<?php 
														$Siswa 					 = mysqli_query($conn,"select nisn,id_siswa,nama,id_kelas from tb_siswa where id_kelas='".$kelas."'"); 
														while ($Data = mysqli_fetch_array($Siswa)) {
															$DataKeuangan = mysqli_fetch_array(mysqli_query($conn,"select * from tb_keuangan where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."'"));
															$SuratPanggilan = mysqli_query($conn,"select id,id_siswa,tanggal_dibuat from tb_bk where keterangan ='2'");
															?>
															<tr>
																<td><?=$Data['nisn'];?></td>
																<td><?=$Data['nama'];?></td>
																<td><?=$DataKeuangan['nominal'] < 49999 && $DataKeuangan['keterangan'] =='Telah Membayarkan' ? '
																<button  type="submit" nama_id='.$Data['id_siswa'].' nama_siswa='.$Data['nama'].' nama_session='.$_SESSION['id'].' nama_data_id='.$DataKeuangan['id'].' nama_data='.$DataKeuangan['nominal'].' class="Proses btn btn-danger btn-icon-anim " title="Proses Pemanggilan Siswa">Rp.'.number_format($DataKeuangan['nominal'],2,',','.').'</button>' : 'Rp'.number_format($DataKeuangan['nominal'],2,'.','.').'';?>
															</td>
															<td>
																<?=$DataKeuangan['nominal'] < 49999 ? "Belum Lunas" : " Lunas";?>
															</td>
															<td>Rp.
																<?=TERBILANG($DataKeuangan['nominal']);?>
															</td>
														</tr>
													<?php }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div> 
					</div>
				</div> 
			<?php }elseif ($KategoriLaporan == 3) {
				
				?>
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default ">
							<div class="panel-heading">
								<div class="pull-left">
									<h5 class="panel-title txt-dark"> Kelas ini diwali kelas kan kepada guru atas nama <?=$Guru['nama_guru'];?></h5>
								</div>
								<div class="pull-right">
									<a href="?Halaman=Buku Hitam Siswa" class="btn btn-warning btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Tambah Data">Kembali</span></a>

									<a href='App/Page/Cetak/Cetak.php?CetakLaporan&kelas=<?=base64_encode($kelas);?>&bulan=<?=base64_encode($bulan);?>&tahun=<?=base64_encode($tahun);?>&KategoriLaporan=<?=base64_encode($KategoriLaporan);?>' target='_blank' class="btn btn-success btn-anim"><i class="ti-printer"></i><span class="btn-text" title="Cetak Data">Cetak Data</a>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default ">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Data Nilai Kelas <?=$Kelas['nama_kelas'].' - '.$Kelas['nama_jurusan']. ' / '.$Kelas['periode']. ' / '.$Kelas['semester'];?> Pada Bulan <?=Bulan($bulan) . ' Tahun '. $tahun;?> </h6>
									</div>
									<div class="clearfix"></div>
								</div>

								<div class="panel-wrapper collapse in">
									<div class="panel-body">

										<div class="card">
											<div class="table-wrap">
												<div class="table-responsive">
													<?php
													$KelasSiswa = mysqli_query($conn,"select * from tb_siswa where id_kelas='".$kelas."'");
													while ($Siswa = mysqli_fetch_array($KelasSiswa)) {
														$NilaiSiswa  = mysqli_fetch_array(mysqli_query($conn,"select * from tb_nilai where id_siswa='".$Siswa['id_siswa']."'"));
														$NamaOrtu  = mysqli_fetch_array(mysqli_query($conn,"select * from tb_ortu where id_ortu='".$Siswa['id_ortu']."'"));
														?>
														<div class="col-sm-6">
															<table class="table" id="datable_2" border="1">
																<thead>
																	<tr>
																		<th> Nama Siswa</th>
																		<th> :</th>
																		<th> <?=$Siswa['nama'];?></th>
																	</tr>
																	<tr>
																		<th> NISN Siswa</th>
																		<th> :</th>
																		<th> <?=$Siswa['nisn'];?></th>
																	</tr>
																</thead>
															</table>
														</div>
														<div class="col-sm-6">
															<table class="table" id="datable_2" border="1">
																<thead>
																	<tr>
																		<th> Jenis Kelamin</th>
																		<th> :</th>
																		<th> <?=$Siswa['JenisKelamin'];?></th>
																	</tr>
																	<tr>
																		<th> Nama Orang Tua</th>
																		<th> :</th>
																		<th> <?=$NamaOrtu['nama_ortu'];?></th>
																	</tr>
																</thead>
															</table>
														</div>
														<table id="" class="table table-hover table-bordered " >
															<thead>
																<?php 
																$RowPand = mysqli_fetch_array(mysqli_query($conn,"select *,count(id_mata_pelajaran) as total from tb_nilai where year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' group by id_mata_pelajaran "));

																?>
																<tr bgcolor="info">
																	<th rowspan="2" class='text-center'>MATA PELAJARAN</th>
																	<th colspan="<?=$RowPand['total'];?>" class='text-center'>TANGGAL</th>
																	<tr >
																		<?php 
																		$Tanggal = mysqli_query($conn,"select * from tb_nilai where year(tanggal)='".$tahun."' and month(	tanggal)='".$bulan."' and id_siswa='".$Siswa['id_siswa']."' and id_mata_pelajaran");
																		while ($DataTanggalPelajaran = mysqli_fetch_array($Tanggal)) {
																			?>
																			<td><?=date('d',strtotime($DataTanggalPelajaran['tanggal']));?></td>
																		<?php }?>

																	</tr>
																</tr>
															</thead>
															<?php 
															$MataPelajaran = mysqli_query($conn,"select * from tb_nilai where id_siswa='".$Siswa['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' group by id_mata_pelajaran ");
															while ($MataPelajaranNya = mysqli_fetch_array($MataPelajaran)) {
																$NamaPelajaran = mysqli_fetch_array(mysqli_query($conn,"select * from tb_mata_pelajaran where id_pelajaran='".$MataPelajaranNya['id_mata_pelajaran']."'"));
																?>
																<tr>
																	<td>
																		<?=$NamaPelajaran['nama_pelajaran'];?>
																	</td>
																	<?php 
																	$NilaiMataPelajaran = mysqli_query($conn,"select * from tb_nilai where id_mata_pelajaran='".$MataPelajaranNya['id_mata_pelajaran']."' and id_siswa='".$MataPelajaranNya['id_siswa']."'");
																	while ($NilaiNya = mysqli_fetch_array($NilaiMataPelajaran)) {
																		?>
																		<td><?=$NilaiNya['nilai'];?></td>
																	<?php }
	?>

																</tr>
															<?php }?>
															<tbody>
															</tbody>
														</table>
														<hr>

														<?php 

													}
													?>

												</div>
											</div>
										</div>


									</div>
								</div>
							</div> 
						</div>
					</div> 
				<?php }	?>

			</div> 




