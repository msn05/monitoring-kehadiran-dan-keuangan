 <?php
 $sql=mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.remove_data='1' order by a.nama_kelas and periode and semester desc");
 ?>
 <div class="right-sidebar-backdrop"></div>
 <div class="page-wrapper">
 	<div class="container-fluid">
 		<div class="row heading-bg">
 			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 				<h5 class="txt-dark">Data User <?=$_GET['Halaman'];?></h5>
 			</div>
 			<!-- Breadcrumb -->
 			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
 				<ol class="breadcrumb">
 					<li><a href="index.html">Dashboard</a></li>
 					<li><a href="#"><span>Master Data</span></a></li>
 					<li class="active"><span>Data User <?=$_GET['Halaman'];?></span></li>
 				</ol>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-md-12">
 				<div class="panel panel-default card-view">
 					<div class="panel-heading">
 						<div class="pull-left">
 							<h6 class="panel-title txt-dark">FORM DATA <?=strtoupper($_GET['Halaman']);?></h6>
 						</div>
 						<div class="clearfix"></div>
 					</div>
 					<div class="panel-wrapper collapse in">
 						<div class="panel-body">
 							<div class="row">
 								<div class="col-md-12">
 									<div class="form-wrap">
 										<?php
 										if (isset($_GET['Form'])) {
 											$id 		= $_GET['Form'];
 											$Data = base64_decode(test_input($_GET['id']));
 											$Keterangan = mysqli_fetch_array(mysqli_query($conn,"select a.JenisKelamin,a.id_siswa,a.nama,a.nisn,a.id_kelas,a.id_kelas,a.id_ortu,a.nomor_telphone,a.foto,b.id_ortu,b.nama_ortu,b.no_telphone,b.alamat,b.pekerjaan,c.id_users,c.KodeLogin from tb_siswa as a left join tb_ortu as b on b.id_ortu=a.id_ortu left join tb_users as c on c.id_users=b.id_ortu where a.id_siswa='".$Data."'"));

 											?>
 											<form class="form-horizontal" id="FormEdit" enctype="multipart/form-data" method="POST">
 											<?php }else{?>
 												<form class="form-horizontal"  id="FormTambah"  enctype="multipart/form-data" method="POST">
 												<?php }?>
 												<div class="form-body">
 													<h6 class="txt-dark capitalize-font"><i class="icon-user mr-10"></i>Data Siswa</h6>
 													<hr class="light-grey-hr"/>
 													<!-- /Row -->
 													<div class="row">
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger" > * </span> Nama Siswa</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * NAMA SISWA</span>
 																	<input type="hidden"  value="<?php if(isset($_GET['Form'])){echo"".$Keterangan['id_siswa']."";}else{echo"";}?>"   id="id" name="id" class="form-control" placeholder="Nama Siswa">
 																	<input type="text"  value="<?php if(isset($_GET['Form'])){echo"".$Keterangan['nama']."";}else{echo"";}?>"   id="nama" name="nama" class="form-control" placeholder="Nama Siswa">
 																</div>
 															</div>
 														</div>
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger" > * </span> NISN</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * NISN</span>
 																	<input type="number" value="<?php if(isset($_GET['Form'])){echo"".$Keterangan['nisn']."";}else{echo"";}?>" id="nisn" name="nisn" class="form-control" placeholder="Nisn">
 																</div>
 															</div>
 														</div>
 													</div>
 													<div class="row">
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Nomor Telehphone</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * NOMOR TELPHONE</span>
 																	<input type="number" value="<?php if(isset($_GET['Form'])){echo"".$Keterangan['nomor_telphone']."";}else{echo"";}?>"  placeholder="Nomor Telehphone Guru"  id="Telehphone" name="Telehphone" class="form-control">
 																</div>
 															</div>
 														</div>
 														<?php if(isset($_GET['Form'])){  ?>
 															<div class="col-md-6">
 																<div class="form-group">
 																	<label class="control-label col-md-3"><span class="text-danger"> * </span> Foto</label>
 																	<div class="col-md-6">
 																		<span class="text-danger"> * FORMAT JPG/JPEG UK 2 MB MAX</span>
 																		<input type="file" name="file" id="file" class="form-control" placeholder="Format JPG / JPEG uk max 2mb">
 																	</div>
 																	<div class="col-md-3">
 																		<a href="App/Page/Siswa/Image/<?=$Keterangan['foto'];?>" target="_blank" class="btn btn-anim btn-info"> LIHAT</a>
 																	</div>
 																</div>
 															</div>
 														<?php }else{?>
 															<div class="col-md-6">
 																<div class="form-group">
 																	<label class="control-label col-md-3"><span class="text-danger"> * </span> Foto</label>
 																	<div class="col-md-9">
 																		<span class="text-danger"> * FORMAT JPG/JPEG UK 2 MB MAX</span>
 																		<input type="file" name="file" id="file" class="form-control" placeholder="Format JPG / JPEG uk max 2mb">
 																	</div>
 																</div>
 															</div>
 														<?php }?>
 													</div>
 													<div class="row">
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Kelas</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * Kelas Siswa</span>
 																	<select class="form-control select2" name="kelas" id="kelas">
 																		<option value="0">Pilih</option>
 																		<?php 
 																		if (isset($_GET['Form'])) {
 																			while ($Data = mysqli_fetch_array($sql)) {?>
 																				<option value="<?=$Data['id_kelas'];?>"<?=$Keterangan['id_kelas'] == $Data['id_kelas'] ? 'selected' : '';?> ><?=$Data['nama_kelas']. ' / '. $Data['periode']. ' / '.$Data['nama_jurusan']. ' / '.$Data['semester'];?></option>
 																			<?php }
 																		}else{
 																			while ($Data = mysqli_fetch_array($sql)) {?>
 																				<option value="<?=$Data['id_kelas'];?>"><?=$Data['nama_kelas']. ' / '. $Data['periode']. ' / '.$Data['nama_jurusan']. ' / '.$Data['semester'];?></option>
 																				<?php 
 																			}}
 																			?>
 																		</select>
 																	</div>
 																</div>
 															</div>
 															<div class="col-md-6">
 																<div class="form-group">
 																	<label class="control-label col-md-3"><span class="text-danger"> * </span> Jenis Kelamin</label>
 																	<div class="col-md-9">
 																		<span class="text-danger"> * Jenis Kelamin</span>
 																		<select class="form-control select2" name="JK" id="JK">
 																			<option value="0">Pilih</option>
 																			<?php 	if (isset($_GET['Form'])) {?>
 																				<option value="Laki-laki"<?=$Keterangan['JenisKelamin']=='Laki-laki' ? 'selected': '';?> > Laki-laki</option>
 																				<option value="Perempuan"<?=$Keterangan['JenisKelamin']=='Perempuan' ? 'selected': '';?>> Perempuan</option>
 																			<?php	}else{?>
 																				<option value="Laki-laki"> Laki-Laki</option>
 																				<option value="Perempuan"> Perempuan</option>
 																				<?php 
 																			}
 																			?>
 																		</select>
 																	</div>
 																</div>
 															</div>
 														</div>
 													</div>
 												</div>
 												<div class="form-body">
 													<hr class="light-grey-hr"/>
 													<h6 class="txt-dark capitalize-font"><i class="icon-login mr-10"></i>Data Orang Tua</h6>
 													<hr class="light-grey-hr"/>
 													<div class="row">
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Nama Ortu</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * LEVEL GURU</span>
 																	<input type="text" value="<?php if(isset($_GET['Form'])){echo"".$Keterangan['nama_ortu']."";}else{echo"";}?>"  placeholder="Nama Ortu"  id="nama_ortu" name="nama_ortu" class="form-control">
 																</div>
 															</div>
 														</div>
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Kode Login</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * Kode Login</span>
 																	<?php if (isset($_GET['Form'])) { ?>
 																		<input type="text" value="<?=$Keterangan['KodeLogin'];?>"  id="idNya" name="idNya" class="form-control" readonly/>
 																		<input type="hidden" value="<?=$Keterangan['id_ortu'];?>"  id="kode" name="kode" class="form-control" readonly/>
 																	<?php }else{
 																		$mt_rand = mt_rand(1000, 9999);
 																		?>
 																		<input type="text" value="<?=$mt_rand;?>" id="kode" name="kode" class="form-control" readonly/>
 																	<?php }?>
 																</div>
 															</div>
 														</div>
 													</div>
 													<div class="row">
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Alamat</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * Alamat</span>
 																	<textarea class="form-control" name="alamat" id="alamat"><?php if(isset($_GET['Form'])){echo"".$Keterangan['alamat']."";}else{echo"";}?></textarea>
 																</div>
 															</div>
 														</div>
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Nomor Telphone</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * Nomor Telphone</span>
 																	<input type="text" value="<?php if (isset($_GET['Form'])) { echo "".$Keterangan['no_telphone']."";}else{echo"";}?>"  id="TelphoneOrtu" name="TelphoneOrtu" class="form-control">
 																</div>
 															</div>
 														</div>
 													</div>
 													<div class="row">
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Pekerjaan</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * Pekerjaan</span>
 																	<input type="text" value="<?php if (isset($_GET['Form'])) { echo "".$Keterangan['pekerjaan']."";}else{echo"";}?>"  id="Pekerjaan" name="Pekerjaan" class="form-control">
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
 																	<button type="submit" id="Simpan" class="btn btn-success btn-anim"><i class="ti-save"></i><span class="btn-text" title="Simpan">Simpan</span></button>
 																	<a href="?Halaman=Siswa" class="btn btn-primary btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
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
 			<script>
 				$("#FormTambah").on('submit',(function(e) {
 					e.preventDefault();
 					$.ajax({
 						url: 'App/Page/Siswa/simpan.php?Kirim',
 						type: "POST",
 						data:  new FormData(this),
 						contentType: false,
 						cache: false,
 						processData:false,
 						dataType: "JSON",
 						success: function (respone) {
 							if (respone.status == 'success') {
 								swal({title: "success", text: respone.message, type: "success"},
 									function(){ 
 										location.reload();
 									}
 									);
 							} else{
 								swal("Warning!", respone.message, "error");
 							}
 						}
 					});
 				}));

 				$("#FormEdit").on('submit',(function(e) {
 					e.preventDefault();
 					$.ajax({
 						url: 'App/Page/Siswa/simpan.php?Update',
 						type: "POST",
 						data:  new FormData(this),
 						contentType: false,
 						cache: false,
 						processData:false,
 						dataType: "JSON",
 						success: function (respone) {
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
 									}
 									);
 							}
 						}
 					});
 				}));
 			</script>

