 <?php
 $Guru 	= mysqli_query($conn,"select id,nama_guru,active from tb_guru where active='1' ");
 $MataPelajaran 	= mysqli_query($conn,"select id_pelajaran,nama_pelajaran,active from tb_mata_pelajaran where active='1' ");
 $sqlKelas= mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,d.id_kelas,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode left join tb_siswa as d on d.id_kelas=a.id_kelas where d.id_kelas and a.remove_data='1' group by a.nama_kelas asc");
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
 					<li class="active"><span><?=$_GET['Halaman'];?></span></li>
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
 											$DataCekEmail   = mysqli_fetch_array(mysqli_query($conn,"SELECT * from tb_jadwal_penilaian_mata_pelajaran where id ='".$Data."'"));
 											?>
 											<form class="form-horizontal" id="FormEdit" method="POST">
 											<?php }else{?>
 												<form class="form-horizontal" id="FormTambah" method="POST">
 												<?php }?>
 												<div class="form-body">
 													<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-file mr-10"></i>Data Mata Pelajaran</h6>
 													<hr class="light-grey-hr"/>
 													<!-- /Row -->
 													<div class="row">
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Nama Guru</label>
 																<div class="col-md-9">
 																	<input type="hidden" value="<?=$DataCekEmail['id'];?>" name="id" id='id'>
 																	<select class="form-control select2" name="guru" id="guru">
 																		<option value="0">Pilih</option>
 																		<?php 
 																		if (isset($_GET['Form'])) {
 																			while ($DataGuru = mysqli_fetch_array($Guru)) {?>
 																				<option value="<?=$DataGuru['id'];?>"<?=$DataGuru['id'] == $DataCekEmail['id_guru'] ? 'selected' : '';?>><?=$DataGuru['nama_guru'];?></option>
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
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span>Mata Pelajaran</label>
 																<div class="col-md-9">
 																	<select class="form-control select2" name="jurusan" id="jurusan">
 																		<option value="0">Pilih</option>
 																		<?php 
 																		if (isset($_GET['Form'])) {
 																			while ($MataPelajaranNya = mysqli_fetch_array($MataPelajaran)) {?>
 																				<option value="<?=$MataPelajaranNya['id_pelajaran'];?>"<?=$MataPelajaranNya['id_pelajaran'] == $DataCekEmail['id_pelajaran'] ? 'selected' : '';?>><?=$MataPelajaranNya['nama_pelajaran'];?></option>
 																				<?php
 																			}
 																		}else{
 																			while ($MataPelajaranNya = mysqli_fetch_array($MataPelajaran)) {
 																				echo '<option value='.$MataPelajaranNya['id_pelajaran'].'>'.$MataPelajaranNya['nama_pelajaran'].'</option>';
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
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Kelas</label>
 																<div class="col-md-9">
 																	<select class="form-control select2" name="periode" id="periode">
 																		<option value="0">Pilih</option>
 																		<?php 
 																		if (isset($_GET['Form'])) {
 																			while ($DataKelas = mysqli_fetch_array($sqlKelas)) {?>
 																				<option value="<?=$DataKelas['id_kelas'];?>"<?=$DataKelas['id_kelas']  == $DataCekEmail['id_kelas'] ? 'selected' : '';?>><?=$DataKelas['nama_kelas'].' / '.$DataKelas['nama_jurusan']. ' / '.$DataKelas['semester'].' / '.$DataKelas['periode'];?></option>
 																				<?php
 																			}
 																		}else{
 																			while ($DataKelas = mysqli_fetch_array($sqlKelas)) {
 																				echo '<option value="'.$DataKelas['id_kelas'].'">'.$DataKelas['nama_kelas'].' / '.$DataKelas['nama_jurusan']. ' / '.$DataKelas['semester'].' / '.$DataKelas['periode'].'</option>';
 																			}
 																		}?>
 																	</select>
 																</div>
 															</div>
 														</div>
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Hari</label>
 																<div class="col-md-9">
 																	<select class="form-control select2" name="semester" id="semester">
 																		<?php if (isset($_GET['Form'])) {?>
 																			<option value="0">Pilih</option>
 																			<option value="Senin"<?=$DataCekEmail['hari'] == 'Senin' ? 'selected' : '';?>>Senin</option>
 																			<option value="Selasa"<?=$DataCekEmail['hari'] == 'Selasa' ? 'selected' : '';?>>Selasa</option>
 																			<option value="Rabu"<?=$DataCekEmail['hari'] == 'Rabu' ? 'selected' : '';?>>Rabu</option>
 																			<option value="Kamis"<?=$DataCekEmail['hari'] == 'Kamis' ? 'selected' : '';?>>Kamis</option>
 																			<option value="Jumat"<?=$DataCekEmail['hari'] == 'Jumat' ? 'selected' : '';?>>Jumat</option>
 																			<option value="Sabtu"<?=$DataCekEmail['hari'] == 'Sabtu' ? 'selected' : '';?>>Sabtu</option>
 																			<?php 
 																		}else{
 																			echo'
 																			<option value="0">Pilih</option>
 																			<option value="Senin">Senin</option>
 																			<option value="Selasa">Selasa</option>
 																			<option value="Rabu">Rabu</option>
 																			<option value="Kamis">Kamis</option>
 																			<option value="Jumat">Jumat</option>
 																			<option value="Sabtu">Sabtu</option>';
 																		}?>
 																	</select>
 																</div>
 															</div>
 														</div>
 													</div>
 													<div class="row">
 														<div class="col-md-6">
 															<div class="form-group">
 																<label class="control-label col-md-3"><span class="text-danger"> * </span> Waktu</label>
 																<div class="col-md-9">
 																	<?php if (isset($_GET['Form'])) {?>
 																		<input type="time" name="waktu" value="<?=date('H:i:s',strtotime($DataCekEmail['pukul']));?>" id="waktu"  class="form-control">
 																	<?php }else{?>
 																		<input type="time" name="waktu" id="waktu"  class="form-control">
 																	<?php }?>
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
 																		<a href="?Halaman=Jadwal Mata Pelajaran" class="btn btn-primary btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
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
 						url: 'App/Page/Jadwal Mata Pelajaran/simpan.php?Kirim',
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
 					var FormEdit = $(this);		
 					swal({
 						title: "Apakah Anda Yakin",
 						text: "Ingin Data ini ..!",
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
 								data: FormEdit.serialize(),
 								url: 'App/Page/Jadwal Mata Pelajaran/simpan.php?Update',
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

