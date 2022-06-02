<?php
$Lvl = $_SESSION['Level'];
if ($Lvl == 1 || $Lvl == 3 || $Lvl == 4 || $Lvl == 5) {
	require_once(__DIR__.'/../../Error/404.php');
}else{?>
	<div class="right-sidebar-backdrop"></div>
	<div class="page-wrapper">
		<div class="container-fluid">
			<div class="row heading-bg">
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<h5 class="txt-dark">Monitoring Data</h5>
				</div>
				<!-- Breadcrumb -->
				<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					<ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li class="active"><span><?=$_GET['Halaman'];?></span></li>
					</ol>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default card-view">
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">FORM PENCARIAN</h6>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-wrap">
										       <?php if($Lvl == 2){?>
										    
											<form class="form-horizontal" id="FormTambah" method="POST">
												<div class="form-body">
													<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-file mr-10"></i>FORM</h6>
													<hr class="light-grey-hr"/>
													<!-- /Row -->
													<div class="row">
														<div class="col-md-4">
															<label class="control-label "><span class="text-danger"> * </span> Kelas</label>
															<div class="form-group">
																<div class="col-md-10">
																	<select class="form-control select2" name="kelas" id="kelas">
																		<option value="0">Pilih Kelas</option>
																		<?php 
																		$Kelas =mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode,d.id_kelas FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode left join tb_siswa as d on d.id_kelas=a.id_kelas where a.remove_data='1' and  d.id_kelas group by d.id_kelas asc");
																		while ($KelasNya = mysqli_fetch_array($Kelas)) {
																			echo '<option value='.$KelasNya['id_kelas'].'>'.$KelasNya['nama_kelas'].' / ' .$KelasNya['nama_jurusan']. ' / ' .$KelasNya['semester']. ' / ' . $KelasNya['periode'].'</option>';
																		}
																		?>
																	</select>
																</div>
															</div>
														</div>
														<div id="MataPelajaran"></div>
														<div class="col-md-4">
															<label class="control-label "><span class="text-danger"> * </span> Tanggal</label>
															<div class="form-group">
																<div class="col-md-10">
																	<input type="date" name="Tanggal" id="Tanggal" placeholder="Tanggal" class="form-control">
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
																		<button type="submit" id="Simpan" class="btn btn-success btn-anim"><i class="ti-save"></i><span class="btn-text" title="Cari">CARI</span></button>
																		<a href="web.php" class="btn btn-primary btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</form>
												<?php }else{ ?>
												    <form class="form-horizontal" id="FormTambahs" method="POST">
												<div class="form-body">
													<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-file mr-10"></i>FORM</h6>
													<hr class="light-grey-hr"/>
													<!-- /Row -->
													<div class="row">

													    <div class="col-md-4">
															<label class="control-label "><span class="text-danger"> * </span> Bulan</label>
															<div class="form-group">
																<div class="col-md-10">
																	<select class="form-control select2" name="bulan" id="bulan">
																				<option value="0">Pilih Bulan</option>
																				<option value="1">Januari</option>
																				<option value="2">February</option>
																				<option value="3">Maret</option>
																				<option value="4">April </option>
																				<option value="5">Mei</option>
																				<option value="6">Juni</option>
																				<option value="7">Juli</option>
																				<option value="8">Agustus</option>
																				<option value="9">September</option>
																				<option value="10">Oktober</option>
																				<option value="11">November</option>
																				<option value="12">Desember</option>
																	</select>
																</div>
															</div>
														</div>
														 <div class="col-md-4">
															<label class="control-label "><span class="text-danger"> * </span> Tahun</label>
															<div class="form-group">
																<div class="col-md-10">
														
																			<select class="form-control selecttahun" name="tahun" id="tahun">
																	<option value="0"> Pilih Tahun</option>
																	<?php
																	for ($i=date('Y'); $i>=date('Y')-20; $i-=1) { 
																		echo "
																		<option value='".$i."'>".$i."</option>
																		";
																	}
																	?>
														
																	</select>
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
																		<button type="submit" id="Simpans" class="btn btn-success btn-anim"><i class="ti-save"></i><span class="btn-text" title="Cari">CARI</span></button>
																		<a href="web.php" class="btn btn-primary btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</form>
												<?php }?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php }?>

		<script>
			$('#datable_2').DataTable();

			$("#kelas").change(function()
			{				
				var kelas = $(this).val();
				$.ajax({
					url:'App/Page/Nilai/simpan.php?CariData',
					type:'POST',
					data: {kelas : kelas},
					success:function(data){
						$("#MataPelajaran").html(data);
					}
				});
			});

			$('#Simpan').on('click',function(e) {
				e.preventDefault();
				var kelas = $('#kelas').val(); 
				var Mapel = $('#Mapel').val(); 
				var Tanggal = $('#Tanggal').val(); 
				$.ajax({
					type: "POST",
					data: {kelas:kelas,Mapel:Mapel,Tanggal:Tanggal},
					url: 'App/Page/Laporan Lainnya/simpan.php?Kirim',
					dataType: "JSON",
					cache :"false",
					success: function (respone) {
						if (respone.status == 'success') {
							swal({title: "success", text: respone.message, type: "success"},
								function(){ 
									window.location = "web.php?Halaman=Laporan Lainnya&Aksi=Info&Data&kelas="+kelas+"&Mapel="+Mapel+"&Tanggal="+Tanggal;
								}
								);

						} else if(respone.status == 'warning'){
							swal({title: "warning", text: respone.message, type: "warning"},
								function(){ 
									location.reload();
								}
								);
						} else{
							swal({title: "error", text: respone.message, type: "error"},
								function(){ 
									window.location = "web.php?Halaman=Laporan Lainnya&Aksi=Info&Data&kelas="+kelas+"&Mapel="+Mapel+"&Tanggal="+Tanggal;
								}
								);
						}
					}
				});
			});
			
				$('#Simpans').on('click',function(e){
				e.preventDefault();
			
				var tahun = $('#tahun').val(); 
				var bulan = $('#bulan').val(); 
				swal({
					title: "Silakan Tunggu",
					text: "",
					timer:3000,
					icon: "warning",
					showConfirmButton: false 
				},function(){
					$.ajax({
						type: 'POST',
					    data: {tahun:tahun,bulan:bulan},
					        url: 'App/Page/Laporan Lainnya/simpan.php?CekLaporan',
						    dataType: "JSON",
							cache:"false",
							success: function(respone) {
								if (respone.status == 'success') {
									swal({title: "success", text: respone.message, type: "success"},
										function(){ 
											window.location = "web.php?Halaman=Laporan Lainnya&Aksi=tambah&bulan="+bulan+'&tahun='+tahun;
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
		
				});
				return false;
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

