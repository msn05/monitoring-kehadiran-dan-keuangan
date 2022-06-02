 <?php
 
 ?>

 <div class="right-sidebar-backdrop"></div>
 <div class="page-wrapper">
 	<div class="container-fluid">
 		<div class="row heading-bg">
 			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 				<h5 class="txt-dark">Kelas</h5>
 			</div>
 			<!-- Breadcrumb -->
 			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
 				<ol class="breadcrumb">
 					<li><a href="index.html">Dashboard</a></li>
 					<li><a href="#"><span>Master Data</span></a></li>
 					<li class="active"><span>Kelas</span></li>
 				</ol>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-md-10">
 				<div class="panel panel-default card-view">
 					<div class="panel-heading">
 						<div class="pull-left">
 							<h6 class="panel-title txt-dark">INFO DATA KELAS</h6>
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
 										$DataCekEmail   = mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where id_kelas='".$Data."'"));
 										?>

 										<form class="form-horizontal" id="FormTambah" method="POST">
 											<div class="form-body">
 												<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-file mr-10"></i>Data Kelas</h6>
 												<hr class="light-grey-hr"/>
 												<!-- /Row -->
 												<div class="row">
 													<div class="col-md-6">
 														<div class="form-group">
 															<label class="control-label col-md-3"><span class="text-danger"> * </span> Nama Kelas</label>
 															<div class="col-md-9">
 																<input type="hidden" value="<?=$DataCekEmail['id_kelas'];?>"  id="id" name="id" class="form-control">
 																<input type="text" value="<?=$DataCekEmail['nama_kelas'];?>"  id="kelas" name="kelas" class="form-control">
 															</div>
 														</div>
 													</div>
 													<div class="col-md-6">
 														<div class="form-group">
 															<label class="control-label col-md-3"><span class="text-danger"> * </span>Jurusan</label>
 															<div class="col-md-9">
 																<input type="text" value="<?=$DataCekEmail['nama_jurusan'];?>" name=""  class="form-control">
 															</div>
 														</div>
 													</div>
 												</div>
 												<div class="row">
 													<div class="col-md-6">
 														<div class="form-group">
 															<label class="control-label col-md-3"><span class="text-danger"> * </span> Periode</label>
 															<div class="col-md-9">
 																<input type="text" value="<?=$DataCekEmail['periode'];?>" name=""  class="form-control">
 															</div>
 														</div>
 													</div>
 													<div class="col-md-6">
 														<div class="form-group">
 															<label class="control-label col-md-3"><span class="text-danger"> * </span> Semester</label>
 															<div class="col-md-9">
 																<input type="text" value="<?=$DataCekEmail['semester'];?>" name=""  class="form-control">
 															</div>
 														</div>
 													</div>
 												</div>
 												<!-- /Row -->
 											</div>		
 											<hr class="light-grey-hr"/>
 											<div class="form-actions mt-10">
 												<div class="row">
 													<div class="col-md-12">
 														<div class="row">
 															<div class="col-md-offset-4 col-md-12">
 																<a href="?Halaman=KelasSekolah" class="btn btn-primary btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
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
