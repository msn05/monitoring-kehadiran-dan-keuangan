		<div class="right-sidebar-backdrop"></div>
		<div class="page-wrapper">
			<div class="container-fluid">
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-dark">CATATAN MONITORING SISWA</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="index.html">Dashboard</a></li>
							<li class="active"><span>MONITORING SISWA</span></li>
						</ol>

					</div>
				</div>

				<?php
				$Level = $_SESSION['Level'];
				$kelas 	 = $_GET['kelas'];
				$tahun = $_GET['tahun'];
				$bulan = $_GET['bulan'];
				$idBk = $_GET['idBk'];

				$Kelas =mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$kelas."'"));

				$DataWaliKelas = mysqli_fetch_array(mysqli_query($conn,"select * from tb_wali_kelas where id_kelas='".$kelas."'"));
				$Guru = mysqli_fetch_array(mysqli_query($conn,"select id,nama_guru from tb_guru where id='".$DataWaliKelas['id_guru']."'"));

				if ($idBk == 1) {?>
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default ">
								<div class="panel-heading">
									<div class="pull-left">
										<h5 class="panel-title txt-dark"> Kelas ini diwali kelas kan kepada guru atas nama <?=$Guru['nama_guru'];?></h5>
									</div>
									<div class="pull-right">
										<a href="?Halaman=Buku Hitam Siswa" class="btn btn-warning btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Tambah Data">Kembali</span></a>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-7">
							<div class="panel panel-default ">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Data Kehadiran Kelas <?=$Kelas['nama_kelas'].' - '.$Kelas['nama_jurusan']. ' / '.$Kelas['periode']. ' / '.$Kelas['semester'];?> Pada Bulan <?=$bulan . ' Tahun '. $tahun;?> </h6>
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
															$DataAbsensiAlpaNya = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Alpa' and action_update='2' "));
															$DataAbsensiAlpa = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Alpa' and action_update='1' "));
															$DataAbsensiIzin = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Izin' and action_update='1' "));
															$DataAbsensiHadir = mysqli_fetch_array(mysqli_query($conn,"select *,count(keterangan) as Total from tb_absensi where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and keterangan='Hadir' and action_update='1' "));
															$SuratPanggilan = mysqli_fetch_array(mysqli_query($conn,"select id,id_siswa,tanggal_dibuat from tb_bk where keterangan ='1'"));
															?>
															<tr>
																<td><?=$Data['nisn'];?></td>
																<td><?=$Data['nama'];?></td>
																<td><?=$DataAbsensiSakit['Total'];?></td>
																<td><?=$DataAbsensiAlpa['Total'] > 2 ? '
																<button  type="submit" nama_id='.$Data['id_siswa'].' nama_siswa='.$Data['nama'].' nama_session='.$_SESSION['id'].' nama_data_id="1" nama_data="Alpa" class="Proses btn btn-danger btn-icon-anim btn-circle" title="Proses Pemanggilan Siswa">'.$DataAbsensiAlpa['Total'].'</button>' :  ''.$DataAbsensiAlpa['Total'].'';?></td>
																<td><?=$DataAbsensiIzin['Total'] > 3 ?'
																<button  type="submit" nama_id='.$Data['id_siswa'].' nama_siswa='.$Data['nama'].' nama_session='.$_SESSION['id'].' nama_data_id="1" nama_data="Izin" class="Proses btn btn-danger btn-icon-anim btn-circle" title="Proses Pemanggilan Siswa">'.$DataAbsensiIzin['Total'].'</button>' : ''.$DataAbsensiIzin['Total'].'';?></td>
																<td><?=$DataAbsensiHadir['Total'] ;?></td>
																<td><?=$DataAbsensiAlpa['Total'] + $DataAbsensiAlpaNya['Total'];?></td>
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
						<div class="col-sm-5">
							<div class="panel panel-default ">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Siswa yang pernah dipanggil</h6>
									</div>

									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="table-wrap">
											<div class="table-responsive">
												<table id="datable_1" class="table table-hover table-bordered display " >
													<thead>
														<tr>
															<th>Nama Siswa</th>
															<th>Tanggal Pemanggilan</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$SuratPanggilan = mysqli_query($conn,"select id,id_siswa,tanggal_dibuat from tb_bk where keterangan ='1'");
														while ($SuratNya = mysqli_fetch_array($SuratPanggilan)) {
															$SuratNyaSiswa = mysqli_fetch_array(mysqli_query($conn,"select id_siswa,nama from tb_siswa where id_siswa='".$SuratNya['id_siswa']."'"));
															echo "
															<tr>
															<td>".$SuratNyaSiswa['nama']."</td>
															<td><a href='App/Page/Cetak/Cetak.php?CatatanHitamAbsensiSiswa=".$SuratNya['id']."' target='_blank'>".date('d-m-Y',strtotime($SuratNya['tanggal_dibuat']))."</a>
															</td>
															</tr>
															";
														}

														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div> 
						</div>
					</div>
				<?php }elseif($idBk==2){	?>
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default ">
								<div class="panel-heading">
									<div class="pull-left">
										<h5 class="panel-title txt-dark"> Kelas ini diwali kelas kan kepada guru atas nama <?=$Guru['nama_guru'];?></h5>
									</div>
									<div class="pull-right">
										<a href="?Halaman=Buku Hitam Siswa" class="btn btn-warning btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Tambah Data">Kembali</span></a>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-7">
							<div class="panel panel-default ">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Data Pembayaran Iuran Kelas <?=$Kelas['nama_kelas'].' - '.$Kelas['nama_jurusan']. ' / '.$Kelas['periode']. ' / '.$Kelas['semester'];?> Pada Bulan <?=$bulan . ' Tahun '. $tahun;?> </h6>
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
														</tr>
													</thead>
													<tfoot>
														<tr>
															<th>NISN</th>
															<th>NAMA SISWA</th>
															<th>JUMLAH</th>
															<th>KETERANGAN</th>
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
					<div class="col-sm-5">
						<div class="panel panel-default ">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Siswa yang pernah dipanggil</h6>
								</div>

								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="datable_1" class="table table-hover table-bordered display " >
												<thead>
													<tr>
														<th>Nama Siswa</th>
														<th>Tanggal Pemanggilan</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$SuratPanggilan = mysqli_query($conn,"select id,id_siswa,tanggal_dibuat from tb_bk where keterangan ='2'");
													while ($SuratNya = mysqli_fetch_array($SuratPanggilan)) {
														$SuratNyaSiswa = mysqli_fetch_array(mysqli_query($conn,"select id_siswa,nama from tb_siswa where id_siswa='".$SuratNya['id_siswa']."'"));
														echo "
														<tr>
														<td>".$SuratNyaSiswa['nama']."</td>
														<td><a href='App/Page/Cetak/Cetak.php?CatatanHitamAbsensiSiswa=".$SuratNya['id']."' target='_blank'>".date('d-m-Y',strtotime($SuratNya['tanggal_dibuat']))."</a>
														</td>

														</tr>
														";
													}

													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div> 
					</div>
				</div> 
			<?php }?>

			<script>
				$('#datable_1').DataTable();
				$('#datable_2').DataTable();
				$('#datable_2').on('click','.Proses',function(){
					var nama_id = $(this).attr('nama_id');
					var nama_siswa = $(this).attr('nama_siswa');
					var nama_session = $(this).attr('nama_session');
					var nama_data = $(this).attr('nama_data');
					var nama_data_id = $(this).attr('nama_data_id');
					swal({
						title: "Apakah Anda Yakin",
						text: "Membuat laporan Pemanggilan Siswa atas nama "+nama_siswa+ " ?",
						icon: "warning",
						showCancelButton: true,   
						confirmButtonColor: "#e6b034",   
						confirmButtonText: "Yes",   
						cancelButtonText: "No",   
						closeOnConfirm: false,   
						closeOnCancel: false 
					},function(isConfirm){
						if (isConfirm) {
							$.ajax({
								type: 'POST',
								data: {nama_id:nama_id,nama_siswa:nama_siswa,nama_session:nama_session,nama_data:nama_data,nama_data_id:nama_data_id},
								url: 'App/Page/Buku Hitam Siswa/simpan.php?PanggilSiswa',
								dataType: "JSON",
								cache:"false",
								success: function(respone) {
									if (respone.status == 'success') {
										swal({title: "success", text: respone.message, type: "success"},
											function(){ 
												location.reload();
											}
											);

									} else{
										swal({title: "error", text: respone.message, type: "error"},
											function(){ 
												location.reload();
											})
									}
								}
							});
						} else {
							swal("Batal", "Anda Membatalkan", "error");
						}
					});
					return false;
				});

			</script>