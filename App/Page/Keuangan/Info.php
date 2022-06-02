
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
					<li><a href="#"><span>Data Users</span></a></li>
					<li class="active"><span>Data <?=$_GET['Halaman'];?></span></li>
				</ol>
			</div>
		</div>
		<?php
		$Level = $_SESSION['Level'];

		if (isset($_GET['Data'])) {
			$kelas 	 = $_GET['kelas'];
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];

		}else{
			$kelas 	 = base64_decode($_GET['Kelas']);
			$bulan = base64_decode($_GET['bulan']);
			$tahun = base64_decode($_GET['tahun']);
		}
		$Kelas =mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$kelas."'"));
		if (isset($_GET['Data'])) {?>
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">Data <?=$_GET['Halaman']. ' Pada Kelas ' .$Kelas['nama_kelas']. ' Pada Bulan ' .$bulan. '-'.$tahun;?></h6>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<form id="UpdateData" method="POST">
									<div class="table-wrap">
										<p class="text-danger">  * Biaya iuran sebesar Rp. 50.000,00.  Jika tidak mencukupi maka akan dibuatkan laporan pemanggilan siswa oleh administrator</p>
										<div class="table-responsive">
											<table id="datable_1" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th>#</th>
														<th>Nama Siswa</th>
														<th>Nominal</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>#</th>
														<th>Nama Siswa</th>
														<th>Nominal</th>
													</tr>
												</tfoot>
												<tbody>
													<?php 
													$no = 1;
													$i  = 0;
													$Siswa 					 = mysqli_query($conn,"select id_siswa,nama,id_kelas from tb_siswa where id_kelas='".$kelas."'"); 
													while ($Data = mysqli_fetch_array($Siswa)) {
														$DataKeuangan = mysqli_fetch_array(mysqli_query($conn,"select * from tb_keuangan where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."'"));
														?>
														<tr>
															<td><?=$no++;?></td>
															<td><input type="hidden" class="form-control" name="id_siswa[<?=$i;?>]" id="id_siswa" value="<?=$Data['id_siswa'] == $DataKeuangan['id_siswa'] ? "".$Data['id_siswa']."" : "".$Data['id_siswa']."";?>" readonly/><input type="text" class="form-control" name="sisiwa" id="sisiwa" value="<?=$Data['id_siswa'] == $DataKeuangan['id_siswa'] ? "".$Data['nama']."" : "".$Data['nama']."";?>" readonly/></td>
															<td>
																<input type="number" class="form-control" name="nominal[<?=$i;?>]" id="nominal" value="<?=$Data['id_siswa'] == $DataKeuangan['id_siswa'] ? ''.$DataKeuangan['nominal'].'' : 'Tidak Diketahui';?>">
																<input type="hidden" name="tanggal" id="tanggal" value="<?=$tahun.'-'.'0'.$bulan.'-'.date('d');?>">
															</td>
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
									if ($DataKeuangan['id_siswa'] == NULL) {?>
										<button type="submit" id="Update" class="btn btn-danger btn-anim pull-right"><i class="fa fa-exchange"></i><span class="btn-text" title="Simpan">Simpan</span></button>
									<?php }else{?>
										<a href="?Halaman=Keuangan&Aksi=Info&<?=base64_encode('Informasi');?>&Kelas=<?=base64_encode($_GET['kelas']);?>&bulan=<?=base64_encode($_GET['bulan']);?>&tahun=<?=base64_encode($_GET['tahun']);?>" class="btn btn-primary  btn-anim pull-right "><i class="fa fa-info"></i><span class="btn-text" title="Lihat">Lihat Data</span></a>
									<?php }?>
									<a href="?Halaman=Keuangan" class="btn btn-warning  btn-anim pull-right "><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
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
								<h6 class="panel-title txt-dark">Data <?=$_GET['Halaman']. ' Pada Kelas ' .$Kelas['nama_kelas']. ' Pada Bulan ' .'0'.$bulan. '-'.$tahun;?></h6>
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
													<th>Nominal</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>#</th>
													<th>Nama Siswa</th>
													<th>Nominal</th>
												</tr>
											</tfoot>
											<tbody>
												<?php 
												$no  = 1;
												$Siswa 					 = mysqli_query($conn,"select id_siswa,nama,id_kelas from tb_siswa where id_kelas='".$kelas."'"); 
												while ($Data = mysqli_fetch_array($Siswa)) {

													$DataKeuangan = mysqli_fetch_array(mysqli_query($conn,"select * from tb_keuangan where id_siswa='".$Data['id_siswa']."' and year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."'"));
													?>
													<tr>
														<td><?=$no++;?></td>
														<td><?=$Data['id_siswa'] == $DataKeuangan['id_siswa'] ? "".$Data['nama']."" : "".$Data['nama']."";?></td>
														<td>Rp
															<?=$Data['id_siswa'] == $DataKeuangan['id_siswa'] ? ''.number_format($DataKeuangan['nominal'],2,',','.').'' : 'Tidak Diketahui';?>
														</td>
													</tr>
													<?php 
												}
												$DataKeuanganNya = mysqli_fetch_array(mysqli_query($conn,"select a.nominal,a.id_siswa,sum(nominal) as Total,b.id_siswa,b.id_kelas,a.tanggal from tb_keuangan as a left join tb_siswa as b on b.id_siswa=a.id_siswa where year(tanggal)='".$tahun."' and month(tanggal)='".$bulan."' and b.id_kelas='".$kelas."'"));
												?>
											</tbody>
											<tr>
												<th colspan="2" class="text-center"><b>TOTAL</b></th>
												<th><b>Rp <?=number_format($DataKeuanganNya['Total'],2,',','.');?></b></th>
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
							url: 'App/Page/Keuangan/simpan.php?Update',
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