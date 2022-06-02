 <?php
 $Level = mysqli_query($conn,"select id_level,nama_level from tb_level ");
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
 							<h6 class="panel-title txt-dark">FORM DATA <?=$_GET['Halaman'];?></h6>
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
 											$Keterangan = mysqli_fetch_array(mysqli_query($conn,"select a.id,a.nama_guru,a.nip,a.alamat,a.no_telphone,a.status_guru,a.created,b.id_users,b.id_level,b.KodeLogin from tb_guru as a left join tb_users as b on b.id_users=a.id where a.id='".$Data."'"));
 											?>
 											<form class="form-horizontal" id="FormEdit" method="POST">
 											<?php }else{?>
 												<form class="form-horizontal"  id="FormTambah"  enctype="multipart/form-data" method="POST">
 												<?php }?>
 												<div class="form-body">
 													<h6 class="txt-dark capitalize-font"><i class="icon-user mr-10"></i>Data Guru</h6>
 													<hr class="light-grey-hr"/>
 													<!-- /Row -->
 													<div class="row">
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger" > * </span> Nama Guru</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * NAMA GURU</span>
 																	<input type="hidden"  value="<?php if(isset($_GET['Form'])){echo"".$Keterangan['id']."";}else{echo"";}?>"   id="id" name="id" class="form-control" placeholder="Nama Guru">
 																	<input type="text"  value="<?php if(isset($_GET['Form'])){echo"".$Keterangan['nama_guru']."";}else{echo"";}?>"   id="nama" name="nama" class="form-control" placeholder="Nama Guru">
 																</div>
 															</div>
 														</div>
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger" > * </span> NIP Guru</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * NIP</span>
 																	<input type="number" value="<?php if(isset($_GET['Form'])){echo"".$Keterangan['nip']."";}else{echo"";}?>" id="nip" name="nip" class="form-control" placeholder="Nip Guru">
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
 																	<input type="number" value="<?php if(isset($_GET['Form'])){echo"".$Keterangan['no_telphone']."";}else{echo"";}?>"  placeholder="Nomor Telehphone Guru"  id="Telehphone" name="Telehphone" class="form-control">
 																</div>
 															</div>
 														</div>
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span>Alamat</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * ALAMAT</span>
 																	<textarea id="alamat" class="form-control" name="alamat" placeholder="Alamat"> <?php if(isset($_GET['Form'])){echo"".$Keterangan['alamat']."";}else{echo"";}?>"</textarea>
 																</div>
 															</div>
 														</div>
 													</div>

 													<div class="row">
 														<?php if(isset($_GET['Form'])){
 														}else{?>

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
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Status Guru</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * STATUS GURU</span>
 																	<select class="form-control select2" name="jurusan" id="jurusan">
 																		<option value="0">Pilih</option>
 																		<?php if(isset($_GET['Form'])){?>
 																			<option value="1"<?=$Keterangan['status_guru'] == 1 ? 'selected' : '';?>>PNS</option>
 																			<option value="2"<?=$Keterangan['status_guru'] == 2 ? 'selected' : '';?>>HONOR</option>
 																			<option value="3"<?=$Keterangan['status_guru'] == 2 ? 'selected' : '';?>>MAGANG</option>
 																		<?php }else{?>
 																			<option value="1">PNS</option>
 																			<option value="2">HONOR</option>
 																			<option value="3">MAGANG</option>
 																		<?php }?>
 																	</select>
 																</div>
 															</div>
 														</div>
 													</div>
 												</div>		
 												<div class="form-body">
 													<hr class="light-grey-hr"/>
 													<h6 class="txt-dark capitalize-font"><i class="icon-login mr-10"></i>Data Akun</h6>
 													<hr class="light-grey-hr"/>
 													<div class="row">
 														<?php if(isset($_GET['Form'])){
 														}else{?>
 															<div class="col-md-6">
 																<div class="form-group">
 																	<label class="control-label col-md-3" palcholder="Passsowrd"><span class="text-danger"> * </span> Passsowrd</label>
 																	<div class="col-md-9">
 																		<span class="text-danger"> * PASSWORD </span>
 																		<input type="text"  id="pass" name="pass" class="form-control" placeholder="password">
 																	</div>
 																</div>
 															</div>
 														<?php }?>
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Level Login</label>
 																<div class="col-md-9">
 																	<span class="text-danger"> * LEVEL GURU</span>
 																	<select class="form-control select2" name="level" id="level">
 																		<option value="0">Pilih</option>
 																		<?php 

 																		if (isset($_GET['Form'])) {
 																			while ($DataLevel = mysqli_fetch_array($Level)) {?>
 																				<option value="<?=$DataLevel['id_level'];?>"<?=$Keterangan['id_level'] == $DataLevel['id_level'] ? 'selected' : '';?>><?=$DataLevel['nama_level'];?></option>
 																			<?php	}
 																		}else{?>
 																			<option value="2">Guru Mata Pelajaran</option>
 																			<option value="4">Guru BK</option>
 																			<option value="3">Wali Kelas</option>
 																		<?php	}?>
 																	</select>
 																</div>
 															</div>
 														</div>
 														<?php 			if (isset($_GET['Form'])) {
 															echo'<div class="col-md-6">';
 															}else{echo'
 															<div class="col-md-10">';}?>
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Kode Login</label>
 																<div class="col-md-9">
 																	<?php
 																	$mt_rand = mt_rand(1000, 9999);
 																	?>
 																	<span class="text-danger"> Kode Login Tidak Wajib Diisi</span>

 																	<input type="text" value="<?php if (isset($_GET['Form'])) { echo "".$Keterangan['KodeLogin']."";}else{echo"".$mt_rand."";}?>"  id="kode" name="kode" class="form-control" readonly/>
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
 																		<a href="?Halaman=Guru" class="btn btn-primary btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
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
 			<script>
 				$("#FormTambah").on('submit',(function(e) {
 					e.preventDefault();
 					$.ajax({
 						url: 'App/Page/Guru/simpan.php?Kirim',
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
 						url: 'App/Page/Guru/simpan.php?Update',
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
 			</script>

