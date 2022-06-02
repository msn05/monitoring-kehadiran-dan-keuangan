 <?php
 $Jurusan = mysqli_query($conn,"select id,nama_jurusan,remove_data from tb_jurusan where remove_data='1' order by nama_jurusan ");
 $Periode = mysqli_query($conn,"select id,periode from tb_periode where periode");
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
 							<h6 class="panel-title txt-dark">FORM DATA KELAS</h6>
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
 											$DataCekEmail   = mysqli_fetch_array(mysqli_query($conn,"SELECT id_kelas,nama_kelas,id_jurusan,semester,id_periode,remove_data from tb_kelas where id_kelas='".$Data."'"));
 											?>
 											<form class="form-horizontal" id="FormEdit" method="POST">
 											<?php }else{?>
 												<form class="form-horizontal" id="FormTambah" method="POST">
 												<?php }?>
 												<div class="form-body">
 													<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-file mr-10"></i>Data Kelas</h6>
 													<hr class="light-grey-hr"/>
 													<!-- /Row -->
 													<div class="row">
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Nama Kelas</label>
 																<div class="col-md-9">
 																	<input type="hidden" value="<?php if(isset($_GET['Form'])){echo"".$DataCekEmail['id_kelas']."";}else{echo"";}?>"  id="id" name="id" class="form-control">
 																	<input type="text" value="<?php if(isset($_GET['Form'])){echo"".$DataCekEmail['nama_kelas']."";}else{echo"";}?>"  id="kelas" name="kelas" class="form-control">
 																</div>
 															</div>
 														</div>
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span>Jurusan</label>
 																<div class="col-md-9">
 																	<select class="form-control select2" name="jurusan" id="jurusan">
 																		<option value="0">Pilih</option>
 																		<?php 
 																		if (isset($_GET['Form'])) {
 																			while ($DataJurusan = mysqli_fetch_array($Jurusan)) {?>
 																				<option value="<?=$DataJurusan['id'];?>"<?=$DataJurusan['id'] == $DataCekEmail['id_jurusan'] ? 'selected' : '';?>><?=$DataJurusan['nama_jurusan'];?></option>
 																				<?php
 																			}
 																		}else{
 																			while ($DataJurusan = mysqli_fetch_array($Jurusan)) {
 																				echo '<option value='.$DataJurusan['id'].'>'.$DataJurusan['nama_jurusan'].'</option>';
 																			}
 																		}?>
 																	</select>
 																</div>
 															</div>
 														</div>
 													</div>
 													<div class="row">
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Periode</label>
 																<div class="col-md-9">
 																	<select class="form-control select2" name="periode" id="periode">
 																		<option value="0">Pilih</option>
 																		<?php 

 																		if (isset($_GET['Form'])) {
 																			while ($DataPeriode = mysqli_fetch_array($Periode)) {?>
 																				<option value="<?=$DataPeriode['id'];?>"<?=$DataPeriode['id'] == $DataCekEmail['id_periode'] ? 'selected' : '';?>><?=$DataPeriode['periode'];?></option>
 																				<?php
 																			}
 																		}else{
 																			while ($DataPeriode = mysqli_fetch_array($Periode)) {
 																				echo '<option value="'.$DataPeriode['id'].'">'.$DataPeriode['periode'].'</option>';
 																			}
 																		}?>
 																	</select>
 																</div>
 															</div>
 														</div>
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Semester</label>
 																<div class="col-md-9">
 																	<select class="form-control select2" name="semester" id="semester">
 																		<?php if (isset($_GET['Form'])) {?>
 																			<option value="0">Pilih</option>
 																			<option value="1"<?=$DataCekEmail['semester'] == 1 ? 'selected' : '';?>>Semester 1</option>
 																			<option value="2"<?=$DataCekEmail['semester'] == 2 ? 'selected' : '';?>>Semester 2</option>
 																			<option value="3"<?=$DataCekEmail['semester'] == 3 ? 'selected' : '';?>>Semester Akhir</option>

 																			<?php 
 																		}else{
 																			echo'
 																			<option value="0">Pilih</option>
 																			<option value="1">Semester 1</option>
 																			<option value="2">Semester 2</option>
 																			<option value="3">Semester Akhir</option>';
 																		}?>
 																	</select>
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
 																	<button type="submit" id="Simpan" class="btn btn-success btn-anim"><i class="ti-save"></i><span class="btn-text" title="Simpan">Simpan</span></button>
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
 				<div class="col-md-2">
 					<div class="panel panel-default card-view">
 						<div class="panel-heading">
 							<div class="pull-left">
 								<h6 class="panel-title txt-dark">KETENTUAN</h6>
 							</div>
 							<div class="clearfix"></div>
 						</div>
 						<div class="panel-wrapper collapse in">
 							<div class="panel-body">
 								<div class="row">
 									<div class="col-md-12">
 										<label class="text-danger"> Jika Terdapat Tanda * disetiap Formulir harap diisi..! dan Jika tidak ada yang dilakukan perubahan dapat klik tombol kembali..!</label>
 									</div>
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
 					url: 'App/Page/KelasSekolah/simpan.php?Kirim',
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

