 <?php
 $mt_rand = mt_rand(1000, 9999);
 ?>

 <div class="right-sidebar-backdrop"></div>
 <div class="page-wrapper">
 	<div class="container-fluid">
 		<div class="row heading-bg">
 			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 				<h5 class="txt-dark">Data User Informasi Orang Tua</h5>
 			</div>
 			<!-- Breadcrumb -->
 			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
 				<ol class="breadcrumb">
 					<li><a href="index.html">Dashboard</a></li>
 					<li><a href="#"><span>Master Data</span></a></li>
 					<li class="active"><span>Data User Informasi Orang Tua <?=$_GET['Halaman'];?></span></li>
 				</ol>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-md-12">
 				<div class="panel panel-default card-view">
 					<div class="panel-heading">
 						<div class="pull-left">
 							<h6 class="panel-title txt-dark">FORM DATA  Orang Tua </h6>
 						</div>
 						<div class="clearfix"></div>
 					</div>
 					<div class="panel-wrapper collapse in">
 						<div class="panel-body">
 							<div class="row">
 								<div class="col-md-12">
 									<div class="form-wrap">
 										<?php 

 										$Data = base64_decode(test_input($_GET['id']));
 										$Keterangan = mysqli_fetch_array(mysqli_query($conn,"select a.JenisKelamin,a.id_siswa,a.nama,a.nisn,a.id_kelas,a.id_kelas,a.id_ortu,a.nomor_telphone,b.alamat,b.no_telphone,a.foto,b.id_ortu,b.nama_ortu,b.no_telphone,b.alamat,b.pekerjaan,c.id_users,c.KodeLogin from tb_siswa as a left join tb_ortu as b on b.id_ortu=a.id_ortu left join tb_users as c on c.id_users=b.id_ortu where b.id_ortu='".$Data."'"));
 										?>
 										<form class="form-horizontal"  id="FormTambah"  e method="POST">
 											<div class="form-body">
 												<h6 class="txt-dark capitalize-font"><i class="icon-login mr-10"></i>Data Orang Tua</h6>
 												<hr class="light-grey-hr"/>
 												<div class="row">
 													<div class="col-md-6">
 														<div class="form-group">
 															<label class="control-label col-md-3"><span class="text-danger"> * </span> Nama Ortu</label>
 															<div class="col-md-9">
 																<span class="text-danger"> * Nama Ortu</span>
 																<input type="hidden" value="<?=$Keterangan['id_ortu'];?>"  placeholder="Nama Ortu"  id="id" name="id" class="form-control">
 																<input type="text" value="<?=$Keterangan['nama_ortu'];?>"  placeholder="Nama Ortu"  id="nama_ortu" name="nama_ortu" class="form-control">
 															</div>
 														</div>
 													</div>
 													<div class="col-md-6">
 														<div class="form-group">
 															<label class="control-label col-md-3"><span class="text-danger"> * </span> Kode Login</label>
 															<div class="col-md-9">
 																<span class="text-danger"> * Kode Login</span>
 																<?php if (isset($_GET['Form'])) { ?>
 																	<input type="text" value="<?=$Keterangan['KodeLogin'];?>"  id="kode" name="kode" class="form-control" readonly/>
 																<?php }else{?>
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
 																<textarea class="form-control" name="alamat" id="alamat"><?=$Keterangan['alamat'];?></textarea>
 															</div>
 														</div>
 													</div>
 													<div class="col-md-6">
 														<div class="form-group">
 															<label class="control-label col-md-3"><span class="text-danger"> * </span> Nomor Telphone</label>
 															<div class="col-md-9">
 																<span class="text-danger"> * Nomor Telphone</span>
 																<input type="text" value="<?=$Keterangan['no_telphone'];?>"  id="TelphoneOrtu" name="TelphoneOrtu" class="form-control">
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
 																<input type="text" value="<?=$Keterangan['pekerjaan'];?>"  id="Pekerjaan" name="Pekerjaan" class="form-control">
 															</div>
 														</div>
 													</div>
 													<div class="col-md-6">
 														<div class="form-group">
 															<label class="control-label col-md-3"><span class="text-danger"> * </span> Password</label>
 															<div class="col-md-9">
 																<span class="text-danger"> * Password Jika Ingin Mengubah Harap Diisi</span>
 																<input type="text"  id="Password" name="Password" class="form-control">
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
 				var FormTambah = $(this);
 				$.ajax({
 					url: 'App/Page/Siswa/simpan.php?UpdateOrtu',
 					type: "POST",
 					data:  FormTambah.serialize(),
 					dataType: "JSON",
 					cache:false,
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

