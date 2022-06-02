
<?php 
$Lvl = $_SESSION['Level'];
if ($Lvl == 4 ||$Lvl == 3 || $Lvl == 1 || $Lvl == 6) {
	require_once(__DIR__.'/../../Error/404.php');
}elseif($Lvl==5 || $Lvl==7){
	include(__DIR__.'/../../Function/Bulan.php');
	$SelectOrtu = mysqli_fetch_array(mysqli_query($conn,"select * from tb_users where id_users='".$_SESSION['id']."'"));
	$SelectOrtuKelas = mysqli_fetch_array(mysqli_query($conn,"select * from tb_siswa where id_ortu='".$SelectOrtu['id_users']."'"));
	$Kelas =mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$SelectOrtuKelas['id_kelas']."'"));?>

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
					<div class="panel panel-default ">
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">Data Nilai </h6>
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="card">
									<div class="table-wrap">
										<div class="table-responsive">
											<?php
											$KelasSiswa = mysqli_fetch_array(mysqli_query($conn,"select * from tb_siswa where id_siswa='".$SelectOrtuKelas['id_siswa']."'"));
											?>
											<div class="col-sm-6">
												<table class="table" id="datable_2" border="1">
													<thead>
														<tr>
															<th> Nama Siswa</th>
															<th> :</th>
															<th> <?=$KelasSiswa['nama'];?></th>
														</tr>
														<tr>
															<th> NISN Siswa</th>
															<th> :</th>
															<th> <?=$KelasSiswa['nisn'];?></th>
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
															<th> <?=$KelasSiswa['JenisKelamin'];?></th>
														</tr>
													</thead>
												</table>
											</div>
											<table id="" class="table table-hover table-bordered " >
												<thead>
													<?php 
													$RowPand = mysqli_fetch_array(mysqli_query($conn,"select *,count(id_mata_pelajaran) as total from tb_nilai group by id_mata_pelajaran "));

													?>
													<tr bgcolor="info">
														<th rowspan="2" class='text-center'>MATA PELAJARAN</th>
														<th colspan="<?=$RowPand['total'];?>" class='text-center'>TANGGAL</th>
														<tr >
															<?php 
															$Tanggal = mysqli_query($conn,"select * from tb_nilai where id_siswa='".$SelectOrtuKelas['id_siswa']."' and id_mata_pelajaran group by tanggal asc");
															while ($DataTanggalPelajaran = mysqli_fetch_array($Tanggal)) {
															 //   var_dump($DataTanggalPelajaran['tanggal']);
																?>
																<td><?=date('d',strtotime($DataTanggalPelajaran['tanggal']));?></td>
															<?php }?>
														</tr>
													</tr>
												</thead>
												<?php 
															$MataPelajaran = mysqli_query($conn,"select * from tb_nilai where id_siswa='".$KelasSiswa['id_siswa']."'  group by id_mata_pelajaran");
															while ($MataPelajaranNya = mysqli_fetch_array($MataPelajaran)) {
																$NamaPelajaran = mysqli_fetch_array(mysqli_query($conn,"select * from tb_mata_pelajaran where id_pelajaran='".$MataPelajaranNya['id_mata_pelajaran']."'"));
																?>
																<tr>
																	<td>
																		<?=$NamaPelajaran['nama_pelajaran'];?>
																	</td>
																	<?php 
																	$NilaiMataPelajaran = mysqli_query($conn,"select * from tb_nilai where id_mata_pelajaran='".$MataPelajaranNya['id_mata_pelajaran']."'and id_siswa='".$MataPelajaranNya['id_siswa']."'");
																	while ($NilaiNya = mysqli_fetch_array($NilaiMataPelajaran)) {
																	   
																	   ?>
																		<td><?=$NilaiNya['nilai'];?></td>

<?php 															}
	?>

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
			</div> 
		</div> 

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
					<div class="col-md-12">
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
															<div class="col-md-4">
																<label class="control-label "><span class="text-danger"> * </span> Kelas</label>
																<div class="form-group">
																	<div class="col-md-10">
																		<input type="hidden" value="<?=date('Y-m-d');?>" name="Tanggal" id="Tanggal">
																		<select class="form-control select2" name="kelas" id="kelas">
																			<option value="0">Pilih Kelas</option>
																			<?php 
																			$GuruKelasNilai = mysqli_query($conn,"select * from tb_jadwal_penilaian_mata_pelajaran where id_guru='".$_SESSION['id']."' group by id_kelas");
																
																			while($DataNilaiNya = mysqli_fetch_array($GuruKelasNilai)){
																					$Kelas = mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a right join tb_jurusan as b on b.id = a.id_jurusan right join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$DataNilaiNya['id_kelas']."' and a.remove_data='1'"));
							echo '<option value='.$Kelas['id_kelas'].'>'.$Kelas['nama_kelas'].' / ' .$Kelas['nama_jurusan']. ' / ' .$Kelas['semester']. ' / ' . $Kelas['periode'].'</option>';
																			}
																				?>
																			</select>
																		</div>
																	</div>
																</div>
																<div id="MataPelajaran"></div>
															</div>		
															<hr class="light-grey-hr"/>
															<div class="form-actions mt-10">
																<div class="row">
																	<div class="col-md-12">
																		<div class="row">
																			<div class="col-md-offset-4 col-md-12">
																				<button type="submit" id="Simpan" class="btn btn-success btn-anim"><i class="ti-save"></i><span class="btn-text" title="Cari">CARI</span></button>
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


					$("#kelas").change(function()
					{				
						var kelas = $(this).val();
						$.ajax({
							url:'App/Page/Nilai/simpan.php?CariData',
							type:'POST',
							data: {kelas : kelas},
							success:function(data){
								$("#MataPelajaran").html(data);
							}
						});
					});

					$('#Simpan').on('click',function(e) {
						e.preventDefault();
						var kelas = $('#kelas').val(); 
						var Mapel = $('#Mapel').val(); 
						var Tanggal = $('#Tanggal').val(); 
						$.ajax({
							type: "POST",
							data: {kelas:kelas,Mapel:Mapel,Tanggal:Tanggal},
							url: 'App/Page/Nilai/simpan.php?Kirim',
							dataType: "JSON",
							cache :"false",
							success: function (respone) {
								if (respone.status == 'success') {
									swal({title: "success", text: respone.message, type: "success"},
										function(){ 
											window.location = "web.php?Halaman=Nilai&Aksi=Info&Data&kelas="+kelas+"&Mapel="+Mapel+"&Tanggal="+Tanggal;
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
											window.location = "web.php?Halaman=Nilai&Aksi=Info&Data&kelas="+kelas+"&Mapel="+Mapel+"&Tanggal="+Tanggal;
										}
										);
								}
							}
						});
					});


					$('#FormEdit').on('submit',function(e) {
						var jurusan 		= $('#jurusan').val();
						var periode 		= $('#periode').val();
						var semester 	= $('#semester').val();
						var kelas 				= $('#kelas').val();
						var id 							= $('#id').val();
						swal({
							title: "Apakah Anda Yakin",
							text: "Ingin Mengubah Kelas ini  Akan Berpengaruh Pada Data Lainnya..!",
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
									type: "POST",
									data: {id:id,jurusan:jurusan,periode:periode,semester:semester,kelas:kelas},
									url: 'App/Page/KelasSekolah/simpan.php?Update',
									dataType: "JSON",
									cache :"false",
									success: function (respone) {
										if (respone.status == 'success') {
											swal({title: "success", text: respone.message, type: "success"},
												function(){ 
													location.reload();
												}
												);
										} else{
											swal({title: "error", text: respone.message, type: "error"},function() {
												location.reload();
											});
										}
									}
								});
							} else {
								swal("Cancelled", "Your imaginary file is safe", "error");
							}
						});
						return false;
					});
				</script>
