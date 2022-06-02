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
 					<li><a href="#"><span>Master Data</span></a></li>
 					<li class="active"><span><?=$_GET['Halaman'];?></span></li>
 				</ol>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-sm-5">
 				<div class="panel panel-default card-view">
 					<div class="panel-heading">
 						<div class="pull-left">
 							<h6 class="panel-title txt-dark">FORM DATA</h6>
 						</div>
 						<div class="clearfix"></div>
 					</div>
 					<div class="panel-wrapper collapse in">
 						<div class="panel-body">
 							<div class="form-wrap" id="Form">
 								<?php
 								if (isset($_GET['Form'])) {
 									$id 		= $_GET['Form'];
 									$Data = base64_decode(test_input($id));
 									$Keterangan = mysqli_fetch_array(mysqli_query($conn,"select id_pelajaran,kode_mata_pelajaran,nama_pelajaran from tb_mata_pelajaran where id_pelajaran='".$Data."'"));
 									?>
 									<form class="form-horizontal" id="FormEdit" method="POST">
 									<?php }else{?>
 										<form class="form-horizontal" id="FormTambah" method="POST">
 										<?php }?>
 										<label class="control-label " for="email_hr">KODE PELAJARAN</label>
 										<div class="form-group">
 											<div class="col-sm-12">
 												<?php if(isset($_GET['Form'])){?>
 													<input type="hidden" value="<?=$Keterangan['id_pelajaran'];?>" class="form-control" id="id" name="id">
 												<?php }?>
 												<input type="text" value="<?php if(isset($_GET['Form'])){echo"".$Keterangan['kode_mata_pelajaran']."";}else{echo"";}?>" maxlength='3' minlength='2' class="form-control" id="kode" name="kode" placeholder="Kode Pelajaran">
 												<span class="text-danger">* Wajib Diisi Kode Pelajaran..!</span>
 											</div>
 										</div>
 										<label class="control-label " for="email_hr">MATA PELAJARAN</label>
 										<div class="form-group">
 											<div class="col-sm-12">
 												<input type="text" value="<?php if(isset($_GET['Form'])){echo"".$Keterangan['nama_pelajaran']."";}else{echo"";}?>" class="form-control" id="nama" name="nama" placeholder="Nama Pelajaran">
 												<span class="text-danger">* Wajib Diisi dengan Huruf..!</span>
 											</div>
 										</div>
 										<div class="form-group mb-0">
 											<div class="col-sm-offset-0 col-sm-10">
 												<button type="submit" id="Simpan" class="btn btn-success btn-anim"><i class="ti-save"></i><span class="btn-text" title="Simpan">Simpan</span></button>
 												<a href="?Halaman=Mata Pelajaran" class="btn btn-primary btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
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
 		<script>
 			$('#FormTambah').on('submit',function(e) {
 				e.preventDefault();
 				var FormTambah = $(this);
 				$.ajax({
 					url: 'App/Page/Mata Pelajaran/simpan.php?Kirim',
 					type: "POST",
 					data: FormTambah.serialize(),
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
 							swal("Warning!", respone.message, "error").then(function() {
 							})
 						}
 					}
 				});
 			});

 			$('#FormEdit').on('submit',function(e) {
 				e.preventDefault();
 				var FormEdit = $(this);
 				$.ajax({
 					url: 'App/Page/Mata Pelajaran/simpan.php?Update',
 					type: "POST",
 					data: FormEdit.serialize(),
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
 							})
 						}
 					}
 				});
 			});
 		</script>