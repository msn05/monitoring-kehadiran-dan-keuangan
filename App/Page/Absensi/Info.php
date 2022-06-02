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
							<li><a href="#"><span>Monitoring Data</span></a></li>
							<li class="active"><span>Data <?=$_GET['Halaman'];?></span></li>
						</ol>
					</div>
				</div>
				<?php
				if (isset($_GET['Data'])) {
					$kelas 	 = $_GET['kelas'];
					$tanggal = $_GET['tanggal'];

				}else{
					$kelas 	 = base64_decode($_GET['Kelas']);
					$tanggal = base64_decode($_GET['tanggal']);
				}
				$Kelas =mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$kelas."'"));
				if (isset($_GET['Data'])) {?>
					<div class="row">
						<div class="col-sm-8">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Data <?=$_GET['Halaman']. ' Pada Kelas ' .$Kelas['nama_kelas']. ' Pada Tanggal ' .date('d-m-Y',strtotime($tanggal));?></h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<form id="UpdateData" method="POST">
											<div class="table-wrap">
												<p class="text-danger">  * Harap Dicek Dengan Benar Data Nya..!</p>
												<div class="table-responsive">
													<table  class="table table-hover display  pb-30" >
														<thead>
															<tr>
																<th>#</th>
																<th>Nama Siswa</th>
																<th colspan="4">Keterangan</th>
																<tr>
																	<th>
																		<td></td>
																		<td>Hadir</td>
																		<td>Alpa</td>
																		<td>Izin</td>
																		<td>Sakit</td>
																	</th>
																</tr>
															</tr>
														</thead>
														<tbody>
															<?php 
															$no = 1;
															$i  = 0;
															$Siswa 					 = mysqli_query($conn,"select id_siswa,nama,id_kelas from tb_siswa where id_kelas='".$kelas."'"); 
															while ($Data = mysqli_fetch_array($Siswa)) {
																$DataKeuangan = mysqli_fetch_array(mysqli_query($conn,"select * from tb_absensi where id_siswa='".$Data['id_siswa']."' and tanggal='".$tanggal."'"));
																?>
																<tr>
																	<td><?=$no++;?></td>
																	<td><input type="hidden" class="form-control" name="id_siswa[<?=$i;?>]" id="id_siswa" value="<?=$Data['id_siswa'] == $DataKeuangan['id_siswa'] ? "".$Data['id_siswa']."" : "".$Data['id_siswa']."";?>" readonly/>
																		<?=$Data['id_siswa'] == $DataKeuangan['id_siswa'] ? "".$Data['nama']."" : "".$Data['nama']."";?>
																	</td>
																	<input type="hidden" id="tanggal" name="tanggal" value="<?=$tanggal;?>" >
																	<?php if ($DataKeuangan['action_update'] == 2) { echo "<td>".$DataKeuangan['keterangan']."</td>".$DataKeuangan['keterangan']."<td>".$DataKeuangan['keterangan']."</td><td>".$DataKeuangan['keterangan']."</td><td>".$DataKeuangan['keterangan']."</td>";
																}else{?>
																	<td>
																		<input type="radio" id="radar" name="radar[<?=$i;?>]" value="Hadir"<?=$DataKeuangan['keterangan'] == 'Hadir' ? "checked" : '';?>  >
																	</td>
																	<td>
																		<input type="radio" id="radar" name="radar[<?=$i;?>]" value="Alpa"<?=$DataKeuangan['keterangan'] == 'Alpa' ? "checked" : '';?>>
																	</td>
																	<td>
																		<input type="radio" id="radar" name="radar[<?=$i;?>]" value="Izin"<?=$DataKeuangan['keterangan'] == 'Izin' ? "checked" : '';?> >
																	</td>
																	<td>
																		<input type="radio" id="radar" name="radar[<?=$i;?>]" value="Sakit"<?=$DataKeuangan['keterangan'] == 'Sakit' ? "checked" : '';?> >
																	</td>
																<?php }?>
															</tr>
															<?php 
															$i++;
														}
														$DataKeuanganNya = mysqli_fetch_array(mysqli_query($conn,"select a.keterangan,a.id_siswa,count(keterangan) as Total,b.id_siswa,b.id_kelas,a.tanggal from tb_absensi as a left join tb_siswa as b on b.id_siswa=a.id_siswa where tanggal='".$tanggal."' and b.id_kelas='".$kelas."' and a.keterangan='Hadir'"));
														$DataAlpa = mysqli_fetch_array(mysqli_query($conn,"select a.keterangan,a.id_siswa,count(keterangan) as Total,b.id_siswa,b.id_kelas,a.tanggal from tb_absensi as a left join tb_siswa as b on b.id_siswa=a.id_siswa where tanggal='".$tanggal."' and b.id_kelas='".$kelas."' and a.keterangan='Alpa'"));
														$DataIzin = mysqli_fetch_array(mysqli_query($conn,"select a.keterangan,a.id_siswa,count(keterangan) as Total,b.id_siswa,b.id_kelas,a.tanggal from tb_absensi as a left join tb_siswa as b on b.id_siswa=a.id_siswa where tanggal='".$tanggal."' and b.id_kelas='".$kelas."' and a.keterangan='Izin'"));
														$DataSakit = mysqli_fetch_array(mysqli_query($conn,"select a.keterangan,a.id_siswa,count(keterangan) as Total,b.id_siswa,b.id_kelas,a.tanggal from tb_absensi as a left join tb_siswa as b on b.id_siswa=a.id_siswa where tanggal='".$tanggal."' and b.id_kelas='".$kelas."' and a.keterangan='Sakit'"));
														?>
													</tbody>
													<tr>
														<th colspan="2" class="text-center"><b>TOTAL  </b></th>
														<th><b><?=$DataKeuanganNya['Total']. ' Siswa';?></b></th>
														<th><b><?=$DataAlpa['Total']. ' Siswa';?></b></th>
														<th><b><?=$DataIzin['Total']. ' Siswa';?></b></th>
														<th><b><?=$DataSakit['Total']. ' Siswa';?></b></th>
													</tr>
												</table>
											</div>
										</div>
										<br>
										<?php if($DataKeuangan['id_siswa'] == NULL){?>
											<button type="submit" id="Update" class="btn btn-danger btn-anim pull-right"><i class="fa fa-exchange"></i><span class="btn-text" title="Simpan">Simpan</span></button>
										<?php }?>
										<a href="?Halaman=Absensi" class="btn btn-warning  btn-anim pull-right "><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
										<!-- 	<button type="submit" id="Valid" title="Valid" class="btn btn-success btn-anim pull-right"><i class="fa fa-save"></i><span class="btn-text" >Sudah Benar</span></button> -->
									</form>
								</div>
							</div>
						</div> 
					</div>
				</div>
			<?php }else{?>
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Data <?=$_GET['Halaman']. ' Pada Kelas ' .$Kelas['nama_kelas']. ' Pada Tanggal ' .date('d-m-Y',strtotime($tanggal));?></h6>
								</div>
								<div class="pull-right">
									<a href="?Halaman=Absensi" class="btn btn-warning btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
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
														<th>Nama Siswa</th>
														<th>Keterangan Hadir</th>
														<th>Action</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>#</th>
														<th>Nama Siswa</th>
														<th>Keterangan Hadir</th>
														<th>Action</th>
													</tr>
												</tfoot>
												<tbody>
													<?php 
													$no  = 1;
													$Siswa 					 = mysqli_query($conn,"select id_siswa,nama,id_kelas from tb_siswa where id_kelas='".$kelas."'"); 
													while ($Data = mysqli_fetch_array($Siswa)) {

														$DataKeuangan = mysqli_fetch_array(mysqli_query($conn,"select * from tb_absensi where id_siswa='".$Data['id_siswa']."' and tanggal='".$tanggal."'"));
														?>
														<tr>
															<td><?=$no++;?></td>
															<td><?=$Data['id_siswa'] == $DataKeuangan['id_siswa'] ? "".$Data['nama']."" : "".$Data['nama']."";?></td>
															<td>
																<?=$DataKeuangan['keterangan'] == 'Hadir' ? 'Hadir' : ($DataKeuangan['keterangan'] == 'Alpa' ? 'Alpa' : ($DataKeuangan['keterangan'] == 'Izin' ? 'Izin' :  'Sakit'));?>
															</td>
															<td>

															</td>
														</tr>
														<?php 
													}
													$DataKeuanganNya = mysqli_fetch_array(mysqli_query($conn,"select a.keterangan,a.id_siswa,count(keterangan) as Total,b.id_siswa,b.id_kelas,a.tanggal from tb_absensi as a left join tb_siswa as b on b.id_siswa=a.id_siswa where tanggal='".$tanggal."' and b.id_kelas='".$kelas."' and a.keterangan='Hadir'"));
													?>
												</tbody>
												<tr>
													<th colspan="2" class="text-center"><b>TOTAL KEHADIRAN </b></th>
													<th><b><?=$DataKeuanganNya['Total']. ' Siswa';?></b></th>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div> 
					</div>
				</div>

			<?php }?>

			<script>
				$('#datable_1').DataTable();
				$('#Update').click(function(e){
					e.preventDefault();
					var UpdateData = $('#UpdateData').serialize();
					swal({
						title: "Apakah Anda Yakin",
						text: "Ingin Sudah Mengisi Sesuai Ketentuan.. ?",
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
								type: 'POST',
								data: UpdateData,
								url: 'App/Page/Absensi/simpan.php?Update',
								dataType: "JSON",
								cache:"false",
								success: function(respone) {
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
											})
									}
								}
							});
						} else {
							swal("Batal", "Anda Membatalkan", "error");
						}
					});
					return false;
				});


				$('#Valid').click(function(e){
					e.preventDefault();
					var UpdateData = $('#UpdateData').serialize();
					swal({
						title: "Apakah Anda Yakin",
						text: "Data Tidak Akan merubah data Lagi ?",
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
								type: 'POST',
								data: UpdateData,
								url: 'App/Page/Absensi/simpan.php?Valid',
								dataType: "JSON",
								cache:"false",
								success: function(respone) {
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
											})
									}
								}
							});
						} else {
							swal("Batal", "Anda Membatalkan", "error");
						}
					});
					return false;
				});


			</script>