
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
			$kelas 	 								= $_GET['kelas'];
			$Mapel 	 								= $_GET['Mapel'];
			$KategoriUlangan = $_GET['KategoriUlangan'];
			$tahunAjaran 				= $_GET['tahunAjaran'];
		}else{
			$kelas 	 = base64_encode($_GET['kelas']);
			$Mapel 	 = base64_encode($_GET['Mapel']);
			$KategoriUlangan = base64_encode($_GET['KategoriUlangan']);
			$tahunAjaran 				=base64_encode($_GET['tahunAjaran']);

		}
		$Kelas    = mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$kelas."'"));
		$MapelNya = mysqli_fetch_array(mysqli_query($conn,"select a.id_pelajaran,a.id_guru,b.id_pelajaran,b.nama_pelajaran  from tb_jadwal_penilaian_mata_pelajaran as a left join tb_mata_pelajaran as b on a.id_pelajaran=b.id_pelajaran where a.id_pelajaran='".$Mapel."'"));
		$GuruNya  = mysqli_fetch_array(mysqli_query($conn,"select id,nama_guru from tb_guru where id='".$MapelNya['id_guru']."'"));

		if (isset($_GET['Data'])) {?>
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">Data Nilai <?=$_GET['Halaman'];?> <?php if ($KategoriUlangan == 1 ) { echo "Semester";}else{echo "Akhir";};?> Tahun Ajaran <?=$tahunAjaran;?> Pada Kelas <?=$Kelas['nama_kelas']. ' . '.$Kelas['nama_jurusan']. ' . '.$Kelas['semester']. ' . '.$Kelas['periode'].' Dengan Mata Pelajaran ' . $MapelNya['nama_pelajaran']. ' Dengan Guru Atas Nama ' . $GuruNya['nama_guru'];?></h6>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<form id="UpdateData" method="POST">
									<div class="table-wrap">
										<p class="text-danger">  * Harap Dicek Dengan Benar Data Nya..!</p>
										<div class="table-responsive">
											<table id="datable_1" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th>#</th>
														<th>Nama Siswa</th>
														<th>Nilai</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>#</th>
														<th>Nama Siswa</th>
														<th>Nilai</th>
													</tr>
												</tfoot>
												<tbody>
													<?php 
													$no = 1;
													$i  = 0;
													$Siswa 					 = mysqli_query($conn,"select id_siswa,nama,id_kelas from tb_siswa where id_kelas='".$kelas."'"); 
													while ($Data = mysqli_fetch_array($Siswa)) {
														$DataMapel = mysqli_fetch_array(mysqli_query($conn,"select * from tb_nilai_ulangan where id_siswa='".$Data['id_siswa']."' and kategori_nilai='".$KategoriUlangan."' and id_pelajaran='".$Mapel."' and tgl_post='".$tahunAjaran."'"));
														?>
														<tr>
															<td><?=$no++;?></td>
															<td>
																<input type="hidden" class="form-control" name="id_siswa[<?=$i;?>]" id="id_siswa" value="<?=$Data['id_siswa'] == $DataMapel['id_siswa'] ? "".$Data['id_siswa']."" : "".$Data['id_siswa']."";?>" readonly/>
																<input type="hidden" value="<?=$Mapel;?>" name="mapel" id="mapel">
																<input type="text" class="form-control" name="sisiwa" id="sisiwa" value="<?=$Data['id_siswa'] == $DataMapel['id_siswa'] ? "".$Data['nama']."" : "".$Data['nama']."";?>" readonly/></td>
																<?php if ($DataMapel['action_update'] == 2) {?>
																	<td>
																		<input type="number" class="form-control" name="nilai[<?=$i;?>]" id="nilai" value="<?=$Data['id_siswa'] == $DataMapel['id_siswa'] ? ''.$DataMapel['nilai'].'' : 'Tidak Diketahui';?>" readonly/>
																	</td>
																<?php }else{?>
																	<td>
																		<input type="number" class="form-control" name="nilai[<?=$i;?>]" id="nilai" value="<?=$Data['id_siswa'] == $DataMapel['id_siswa'] ? ''.$DataMapel['nilai'].'' : 'Tidak Diketahui';?>" required="">
																		<input type="hidden" name="id_guru" id="id_guru" value="<?=$GuruNya['id'];?>">
																		<input type="hidden" name="tahun" id="tahun" value="<?=$tahunAjaran;?>">
																		<input type="hidden" name="semesterNya" id="semesterNya" value="<?=$KategoriUlangan;?>">
																	</td>
																	
																<?php 	}?>
															</tr>
															<?php 
															$i++;
														}
														?>
													</tbody>
												</table>
											</div>
										</div>
										<br>
										<?php 
										$DataMapelNya = mysqli_fetch_array(mysqli_query($conn,"select * from tb_nilai_ulangan where  kategori_nilai='".$KategoriUlangan."' and id_pelajaran='".$Mapel."'"));
										if ($DataMapelNya['action_update'] == 1) {?>
											<button type="submit" id="Valid" title="Valid" class="btn btn-success btn-anim pull-right"><i class="fa fa-save"></i><span class="btn-text" >Sudah Benar</span></button>
										<?php }elseif($DataMapelNya['action_update'] == 2){?>

										<?php }else{?>
											<button type="submit" id="Update" class="btn btn-danger btn-anim pull-right"><i class="fa fa-exchange"></i><span class="btn-text" title="Simpan">Simpan</span></button>
										<?php }?>
										<a href="?Halaman=Nilai" class="btn btn-warning  btn-anim pull-right "><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
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
									<a href="?Halaman=Keuangan" class="btn btn-warning btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
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
														<th>nilai</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>#</th>
														<th>Nama Siswa</th>
														<th>nilai</th>
													</tr>
												</tfoot>
												<tbody>
													<?php 
													$no  = 1;
													$Siswa 					 = mysqli_query($conn,"select id_siswa,nama,id_kelas from tb_siswa where id_kelas='".$kelas."'"); 
													while ($Data = mysqli_fetch_array($Siswa)) {

														$DataMapel = mysqli_fetch_array(mysqli_query($conn,"select * from tb_nilai_ulangan where id_siswa='".$Data['id_siswa']."' and kategori_nilai='".$KategoriUlangan."'"));
														?>
														<tr>
															<td><?=$no++;?></td>
															<td><?=$Data['id_siswa'] == $DataMapel['id_siswa'] ? "".$Data['nama']."" : "".$Data['nama']."";?></td>
															<td>Rp
																<?=$Data['id_siswa'] == $DataMapel['id_siswa'] ? ''.number_format($DataMapel['nilai'],2,',','.').'' : 'Tidak Diketahui';?>
															</td>
														</tr>
														<?php 
													}
													$DataMapelNya = mysqli_fetch_array(mysqli_query($conn,"select a.nilai,a.id_siswa,sum(nilai) as Total,b.id_siswa,b.id_kelas,a.tanggal from tb_nilai_ulangan as a left join tb_siswa as b on b.id_siswa=a.id_siswa where kategori_nilai='".$KategoriUlangan."' and b.id_kelas='".$kelas."'"));
													?>
												</tbody>
												<tr>
													<th colspan="2" class="text-center"><b>TOTAL</b></th>
													<th><b>Rp <?=number_format($DataMapelNya['Total'],2,',','.');?></b></th>
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
						text: "Ingin Sudah Mengisi Semuanya ?",
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
								url: 'App/Page/Nilai Ulangan/simpan.php?Update',
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
						text: "Data Tidak Datat dirubah Lagi ?",
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
								url: 'App/Page/Nilai Ulangan/simpan.php?Valid',
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