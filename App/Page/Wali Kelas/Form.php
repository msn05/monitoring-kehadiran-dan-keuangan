 <?php
 if (isset($_GET['Form'])) {
 	$Data = base64_decode(test_input($_GET['id']));
 	$GuruNya 	= mysqli_fetch_array(mysqli_query($conn,"select id,id_guru,id_kelas from tb_wali_kelas where id='".$Data."'"));
 }
 $Guru 	= mysqli_query($conn,"select id,nama_guru,active from tb_guru where active='1' ");

 $Kelas =mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.remove_data='1' ");
 ?>

 <div class="right-sidebar-backdrop"></div>
 <div class="page-wrapper">
 	<div class="container-fluid">
 		<div class="row heading-bg">
 			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 				<h5 class="txt-dark">Form Data Wali Kelas</h5>
 			</div>
 			<!-- Breadcrumb -->
 			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
 				<ol class="breadcrumb">
 					<li><a href="index.html">Dashboard</a></li>
 					<li><a href="#"><span>Data User </span></a></li>
 					<li class="active"><span><?=$_GET['Halaman'];?></span></li>
 				</ol>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-md-6">
 				<div class="panel panel-default card-view">
 					<div class="panel-heading">
 						<div class="pull-left">
 							<h6 class="panel-title txt-dark">FORM DATA WALI KELAS</h6>
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
 											?>
 											<form class="form-horizontal" id="FormEdit" method="POST">
 											<?php }else{?>
 												<form class="form-horizontal" id="FormTambah" method="POST">
 												<?php }?>
 												<div class="form-body">
 													<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-file mr-10"></i>Data Wali Kelas</h6>
 													<hr class="light-grey-hr"/>
 													<!-- /Row -->
 													<div class="row">
 														<div class="col-md-12">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Nama Guru</label>
 																<div class="col-md-9">
 																	<input type="hidden" class="form-control " name="id" id="id" value="<?=$GuruNya['id'];?>">
 																	<select class="form-control select2" name="guru" id="guru">
 																		<option value="0">Pilih</option>
 																		<?php 
 																		if (isset($_GET['Form'])) {
 																			while ($DataGuru = mysqli_fetch_array($Guru)) {?>
 																				<option value="<?=$DataGuru['id'];?>"<?=$DataGuru['id'] == $GuruNya['id_guru'] ? 'selected' : '';?>><?=$DataGuru['nama_guru'];?></option>
 																				<?php
 																			}
 																		}else{
 																			while ($DataGuru = mysqli_fetch_array($Guru)) {
 																				echo '<option value='.$DataGuru['id'].'>'.$DataGuru['nama_guru'].'</option>';
 																			}
 																		}?>
 																	</select>
 																</div>
 															</div>
 														</div>
 													</div>
 													<div class="row">
 														<div class="col-md-12">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span>Jurusan</label>
 																<div class="col-md-9">
 																	<select class="form-control select2" name="jurusan" id="jurusan">
 																		<option value="0">Pilih</option>
 																		<?php 
 																		if (isset($_GET['Form'])) {
 																			while ($KelasNya = mysqli_fetch_array($Kelas)) {?>
 																				<option value="<?=$KelasNya['id_kelas'];?>"<?=$KelasNya['id_kelas'] == $GuruNya['id_kelas'] ? 'selected' : '';?>><?=$KelasNya['nama_kelas'] . ' / ' .$KelasNya['semester']. ' / ' . $KelasNya['periode'] ;?></option>
 																				<?php
 																			}
 																		}else{
 																			while ($KelasNya = mysqli_fetch_array($Kelas)) {
 																				echo '<option value='.$KelasNya['id_kelas'].'>'.$KelasNya['nama_kelas'].' / ' .$KelasNya['nama_jurusan']. ' / ' .$KelasNya['semester']. ' / ' . $KelasNya['periode'].'</option>';
 																			}
 																		}?>
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
 																<div class="col-md-offset-2 col-md-12">
 																	<button type="submit" id="Simpan" class="btn btn-success btn-anim"><i class="ti-save"></i><span class="btn-text" title="Simpan">Simpan</span></button>
 																	<a href="?Halaman=Wali Kelas" class="btn btn-primary btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
 																	<button type="submit" id="Reset" class="btn btn-danger btn-anim"><i class="fa fa-exchange"></i><span class="btn-text" title="Reset">Reset</span></button>
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
 			$('.select2').select2();
 			$('#FormTambah').on('submit',function(e) {
 				e.preventDefault();
 				var FormTambah = $(this);
 				$.ajax({
 					url: 'App/Page/Wali Kelas/simpan.php?Kirim',
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
 							swal({title: "error", text: respone.message, type: "error"},
 								function(){ 
 									location.reload();
 								}
 								);
 						}
 					}
 				});
 			});

 			$('#Reset').on('click',function(e) {
 				e.preventDefault();
 				var id = $('#id').val();
 				$.ajax({
 					url: 'App/Page/Wali Kelas/simpan.php?Reset',
 					type: "POST",
 					data: {id:id},
 					dataType: "JSON",
 					cache :"false",
 					success: function (respone) {
 						if (respone.status == 'success') {
 							swal({title: "success", text: respone.message, type: "success"},
 								function(){ 
 									window.location = "web.php?Halaman=Wali Kelas&Aksi=form";
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
 			});


 			$('#FormEdit').on('submit',function(e) {
 				var id 							= $('#id').val();
 				var jurusan 		= $('#jurusan').val();
 				var guru 					= $('#guru').val();

 				swal({
 					title: "Apakah Anda Yakin",
 					text: "Ingin Mengubah Wali Kelas ini ?",
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
 							data: {id:id,jurusan:jurusan,guru:guru},
 							url: 'App/Page/Wali Kelas/simpan.php?Update',
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

