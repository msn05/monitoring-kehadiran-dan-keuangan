<?php 
$Lvl = $_SESSION['Level'];
if ($Lvl == 4 ||$Lvl == 2 || $Lvl == 1 || $Lvl == 6) {
	require_once(__DIR__.'/../../Error/404.php');
}elseif($Lvl==5 || $Lvl==7){
	require_once(__DIR__.'/../../Function/Terbilang.php');
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
						<li><a href="#"><span>Data Users</span></a></li>
						<li class="active"><span>Data <?=$_GET['Halaman'];?></span></li>
					</ol>
				</div>
			</div>
			<?php
			$SelectOrtu = mysqli_fetch_array(mysqli_query($conn,"select * from tb_users where id_users='".$_SESSION['id']."'"));
			$SelectOrtuKelas = mysqli_fetch_array(mysqli_query($conn,"select * from tb_siswa where id_ortu='".$SelectOrtu['id_users']."'"));
			$Kelas =mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$SelectOrtuKelas['id_kelas']."'"));?>

			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">Data Iuran Anak Bapak / Ibu Atas Nama <?=$SelectOrtuKelas['nama'];?></h6>
							</div>
							<div class="pull-right">
								<a href="web.php" class="btn btn-warning btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
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
													<th>Nominal</th>
													<th>Terbilang</th>
													<th>Tanggal Bayar</th>
													<th>Keterangan</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>#</th>
													<th>Nominal</th>
													<th>Terbilang</th>
													<th>Tanggal Bayar</th>
													<th>Keterangan</th>
												</tr>
											</tfoot>
											<tbody>
												<?php 
												$no  = 1;
												$Siswa 					 = mysqli_query($conn,"select * from tb_keuangan where id_siswa='".$SelectOrtuKelas['id_siswa']."' order by tanggal asc"); 
												while ($Data = mysqli_fetch_array($Siswa)) {
													?>
													<tr>
														<td><?=$no++;?></td>
														<td>Rp
															<?=''.number_format($Data['nominal'],2,',','.').'';?>
														</td>
														<td><?=Terbilang($Data['nominal']);?></td>
														<td><?=$Data['tanggal'];?></td>
														<td><?=$Data['keterangan'];?></td>
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
																			<select class="form-control select2" name="kelas" id="kelas">
																				<option value="0">Pilih Kelas</option>
																				<?php 
																				$Kelas =mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode,d.id_kelas FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode left join tb_siswa as d on d.id_kelas=a.id_kelas where a.remove_data='1' and  d.id_kelas group by d.id_kelas asc");
																				while ($KelasNya = mysqli_fetch_array($Kelas)) {
																					echo '<option value='.$KelasNya['id_kelas'].'>'.$KelasNya['nama_kelas'].' / ' .$KelasNya['nama_jurusan']. ' / ' .$KelasNya['semester']. ' / ' . $KelasNya['periode'].'</option>';
																				}
																				?>
																			</select>
																		</div>
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="form-group">
																		<label class="control-label col-md-2">Tanggal</label>
																		<div class="col-md-5">
																			<select class="form-control select2" name="bulan" id="bulan">
																				<option value="0">Pilih Bulan</option>
																				<option value="1">Januari</option>
																				<option value="2">February</option>
																				<option value="3">Maret</option>
																				<option value="4">April </option>
																				<option value="5">Mei</option>
																				<option value="6">Juni</option>
																				<option value="7">Juli</option>
																				<option value="8">Agustus</option>
																				<option value="9">September</option>
																				<option value="10">Oktober</option>
																				<option value="11">November</option>
																				<option value="12">Desember</option>
																			</select>
																		</div>
																		<div class="col-md-5">
																			<select class="form-control selecttahun" name="tahun" id="tahun">
																				<option value="0"> Pilih Tahun</option>
																				<?php
																				for ($i=date('Y'); $i>=date('Y')-20; $i-=1) { 
																					echo "
																					<option value='".$i."'>".$i."</option>
																					";
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
				$('.selecttahun').select2();
 		// $('.select2').select2();
 		$('#Simpan').on('click',function(e) {
 			e.preventDefault();
 			var kelas = $('#kelas').val(); 
 			var bulan = $('#bulan').val(); 
 			var tahun = $('#tahun').val(); 
 			$.ajax({
 				url: 'App/Page/Keuangan/simpan.php?Kirim',
 				type: "POST",
 				data: {kelas:kelas,tahun:tahun,bulan:bulan},
 				dataType: "JSON",
 				cache :"false",
 				success: function (respone) {
 					if (respone.status == 'success') {
 						swal({title: "success", text: respone.message, type: "success"},
 							function(){ 
 								window.location = "web.php?Halaman=Keuangan&Aksi=Info&Data&kelas="+kelas+"&bulan="+bulan+"&tahun="+tahun;
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
 								window.location = "web.php?Halaman=Keuangan&Aksi=Info&Data&kelas="+kelas+"&bulan="+bulan+"&tahun="+tahun;
 							}
 							);
 					}
 				}
 			});
 		});



 	</script>

