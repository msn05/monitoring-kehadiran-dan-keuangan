<?php 
$Lvl = $_SESSION['Level'];
if ($Lvl == 3 ||$Lvl == 4 || $Lvl == 1 || $Lvl == 7) {
	require_once(__DIR__.'/../../Error/404.php');
}elseif($Lvl==5 || $Lvl==6){
	$SelectOrtu = mysqli_fetch_array(mysqli_query($conn,"select * from tb_users where id_users='".$_SESSION['id']."'"));
	$SelectOrtuKelas = mysqli_fetch_array(mysqli_query($conn,"select * from tb_siswa where id_ortu='".$SelectOrtu['id_users']."'"));
	var_dump($SelectOrtuKelas);
	
	
	$Kelas =mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$SelectOrtuKelas['id_kelas']."'"));?>
	?>
	<div class="right-sidebar-backdrop"></div>
	<div class="page-wrapper">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Data Kehadiran Anak</h6>
						</div>
						<div class="pull-right">
						    <?php if($Lvl ==2){ ?>
						    <a href="?Halaman=Absensi" class="btn btn-warning btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
						    <?php }elseif($Lvl==5 || $Lvl==6){?>
							<a href="web.php" class="btn btn-warning btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
					    <?php }?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="table-wrap">
								<div class="table-responsive">
									<table id="datable_1" class="table table-hover display  pb-30" >
										<thead>
											<tr>
												<th>#</th>
												<th>Tanggal</th>
												<th>Keterangan</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Tanggal</th>
												<th>Keterangan</th>
											</tr>
										</tfoot>
										<tbody>
											<?php 
											$no  = 1;
											$DataKeuangan = mysqli_query($conn,"select * from tb_absensi where id_siswa='".$SelectOrtuKelas['id_siswa']."' order by tanggal asc");
											while ($Data = mysqli_fetch_array($DataKeuangan)) {
												?>
												<tr>
													<td><?=$no++;?></td>
													<td><?=$Data['tanggal'];?></td>
													<td>
														<?=$Data['keterangan'] == 'Hadir' ? 'Hadir' : ($Data['keterangan'] == 'Alpa' ? 'Alpa' : ($Data['keterangan'] == 'Izin' ? 'Izin' :  'Sakit'));?>
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
	<script>
		$('#datable_1').DataTable();
	</script>
<?php }else{?>
	<div class="right-sidebar-backdrop"></div>
	<div class="page-wrapper">
		<div class="container-fluid">
			<div class="row heading-bg">
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<h5 class="txt-dark">Monitoring Data</h5>
				</div>
				<!-- Breadcrumb -->
				<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					<ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li><a href="#"><span>Monitoring</span></a></li>
						<li class="active"><span><?=$_GET['Halaman'];?></span></li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-default card-view">
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">FORM PENCARIAN</h6>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-wrap">
											<form class="form-horizontal" id="FormTambah" method="POST">
												<div class="form-body">
													<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-file mr-10"></i>FORM</h6>
													<hr class="light-grey-hr"/>
													<!-- /Row -->
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-2"><span class="text-danger"> * </span> Kelas</label>
																<div class="col-md-10">
																	<input type="hidden" value="<?=date('Y-m-d');?>" name="tanggal" id='tanggal'>
																	<select class="form-control select2" name="kelas" id="kelas">
																		<option value="0">Pilih Kelas</option>
																		<?php 
																		$GuruKelasNilai = mysqli_query($conn,"select * from tb_jadwal_penilaian_mata_pelajaran where id_guru='".$_SESSION['id']."'");
																			while($DataNilaiNya = mysqli_fetch_array($GuruKelasNilai)){
																					$Kelas = mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a right join tb_jurusan as b on b.id = a.id_jurusan right join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$DataNilaiNya['id_kelas']."' and a.remove_data='1' group by a.id_kelas limit 1"));
																				echo '<option value='.$Kelas['id_kelas'].'>'.$Kelas['nama_kelas'].' / ' .$Kelas['nama_jurusan']. ' / ' .$Kelas['semester']. ' / ' . $Kelas['periode'].'</option>';
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>
													</div>
												</div>		
												<hr class="light-grey-hr"/>
												<div class="form-actions mt-10">
													<div class="row">
														<div class="col-md-12">
															<div class="row">
																<div class="col-md-offset-4 col-md-12">
																	<button type="submit" id="Simpan" class="btn btn-success btn-anim"><i class="ti-save"></i><span class="btn-text" title="Simpan">CARI</span></button>
																	<a href="web.php" class="btn btn-primary btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }?>
	<script>
		$('#Simpan').on('click',function(e) {
			e.preventDefault();
			var kelas = $('#kelas').val(); 
			var tanggal = $('#tanggal').val(); 
			$.ajax({
				url: 'App/Page/Absensi/simpan.php?Kirim',
				type: "POST",
				data: {kelas:kelas,tanggal:tanggal},
				dataType: "JSON",
				cache :"false",
				success: function (respone) {
					if (respone.status == 'success') {
						swal({title: "success", text: respone.message, type: "success"},
							function(){ 
								window.location = "web.php?Halaman=Absensi&Aksi=Info&Data&kelas="+kelas+"&tanggal="+tanggal;
							}
							);

					} else if(respone.status == 'warning'){
						swal({title: "warning", text: respone.message, type: "warning"},
							function(){ 
								location.reload();
							}
							);
					} else{
						swal({title: "error", text: respone.message, type: "error"},
							function(){ 
								window.location = "web.php?Halaman=Absensi&Aksi=Info&Data&kelas="+kelas+"&tanggal="+tanggal;
							}
							);
					}
				}
			});
		});


	</script>

