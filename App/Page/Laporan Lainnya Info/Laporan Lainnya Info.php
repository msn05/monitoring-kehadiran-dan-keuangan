<?php 
$Lvl = $_SESSION['Level'];
include(__DIR__.'/../../Function/Bulan.php');

?>

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
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark"><?=$_GET['Halaman'];?></h6>
						</div>

						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="card">
								<div class="table-wrap">
									<div class="table-responsive">
										<div class="col-sm-12">
											<table class="table" id="datable_2" border="1">
												<?php
												if ($Lvl == 5) {?>
													<thead>
														<tr>
															<th> NO</th>
															<th> Tanggal</th>
															<th> Perihal</th>
														</tr>
													</thead>
													<tbody>
														<?php 
														$no = 1;
														$SelectOrtu = mysqli_fetch_array(mysqli_query($conn,"select * from tb_users where id_users='".$_SESSION['id']."'"));
														$SelectOrtuKelas = mysqli_fetch_array(mysqli_query($conn,"select * from tb_siswa where id_ortu='".$SelectOrtu['id_users']."'"));
														$LaporanLainnya = mysqli_query($conn,"select * from tb_laporan_lainnya where id_siswa='".$SelectOrtuKelas['id_siswa']."'");
														while ($DataSS = mysqli_fetch_array($LaporanLainnya)) {
															?>
															<tr>
																<td><?=$no++;?></td>
																<td><?=$DataSS['tanggal'];?></td>
																<td><?=$DataSS['keterangan'];?></td>
															</tr>
														<?php }
													}else{
														?>
														<thead>
															<tr>
																<th> NO</th>
																<th> Nama Guru</th>
 <th> Nama Siswa</th>
																<th> Kelas</th>
																<th> Mata Pelajaran</th>
																<th> Tanggal</th>
																<th> Perihal</th>
															</tr>
														</thead>
														<?php 
														$no = 1;
														if($Lvl == 2){
															$SelectGuruJawals = mysqli_fetch_array(mysqli_query($conn,"select * from tb_wali_kelas where id_guru='".$_SESSION['id']."' and active='1'"));
															$Siswa = mysqli_query($conn,"select * from tb_siswa where id_kelas='".$SelectGuruJawals['id_kelas']."'");
															while ($Data = mysqli_fetch_array($Siswa)) {
																$LaporanLainnya = mysqli_fetch_array(mysqli_query($conn,"select * from tb_laporan_lainnya where id_siswa='".$Data['id_siswa']."' "));
																$SelectGuruKelas = mysqli_fetch_array(mysqli_query($conn,"select * from tb_guru where id='".$LaporanLainnya['id_guru']."'"));
																$MataPelajaran = mysqli_fetch_array(mysqli_query($conn,"select * from tb_mata_pelajaran where id_pelajaran='".$LaporanLainnya['id_mata_pelajaran']."'"));
																?>
																<tr>
																	<td><?=$no++;?></td>
																	<td><?=$SelectGuruKelas['nama_guru'];?></td>
																	<td><?=$Data['nama'];?></td>
																	<td><?=$Kelas['id_kelas'] != '' ? $Kelas['nama_kelas']. '/' . $Kelas['nama_jurusan']. '/' .$Kelas['semester']. '/'.$Kelas['periode'] : 'Tidak Diketahui Kelas';?></td>
																	<td><?=$LaporanLainnya['tanggal'];?></td>
																	<td><?=$MataPelajaran['nama_pelajaran'];?></td>
																	<td><?=$LaporanLainnya['keterangan'];?></td>
																</tr>
															<?php }
														}elseif($Lvl == 4 || $Lvl == 6 || $Lvl == 3){
															$LaporanLainnya = mysqli_query($conn,"select * from tb_laporan_lainnya order by tanggal asc ");
															while ($Datas = mysqli_fetch_array($LaporanLainnya)) {
																$SelectGuruKelas = mysqli_fetch_array(mysqli_query($conn,"select * from tb_guru where id='".$Datas['id_guru']."'"));
																$Siswa = mysqli_fetch_array(mysqli_query($conn,"select * from tb_siswa where id_siswa='".$Datas['id_siswa']."'"));
																$Kelas =mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$Siswa['id_kelas']."'"));
																$MataPelajaran = mysqli_fetch_array(mysqli_query($conn,"select * from tb_mata_pelajaran where id_pelajaran='".$Datas['id_mata_pelajaran']."'"));
																?>
																<tr>
																	<td><?=$no++;?></td>
																	<td><?=$SelectGuruKelas['nama_guru'];?></td>
																	<td><?=$Siswa['nama'];?></td>
																	<td><?=$Kelas['id_kelas'] != '' ? $Kelas['nama_kelas']. '/' . $Kelas['nama_jurusan']. '/' .$Kelas['semester']. '/'.$Kelas['periode'] : 'Tidak Diketahui Kelas';?></td>
																	<td><?=$MataPelajaran['nama_pelajaran'];?></td>
																	<td><?=$Datas['tanggal'];?></td>
																	<td><?=$Datas['keterangan'];?></td>
																</tr>
																<?php 
															}
														}
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
			</div> 
		</div> 
		<script>
			$('#datable_2').DataTable();
		</script>