		<div class="right-sidebar-backdrop"></div>
		<div class="page-wrapper">
			<div class="container-fluid">
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-dark">CATATAN MONITORING SISWA</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="index.html">Dashboard</a></li>
							<li class="active"><span>MONITORING SISWA</span></li>
						</ol>

					</div>
				</div>

				<?php
			
				$kelas 	 = $_GET['kelas'];
				$hari = $_GET['hari'];
		        $idBk = $_GET['idBk'];
		        $tanggal = $_GET['tanggal'];

				$Kelas =mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$kelas."'"));
                			$Pel = mysqli_fetch_array(mysqli_query($conn,"select id,id_kelas,hari,count(id) as TotalPelajaran from tb_jadwal_penilaian_mata_pelajaran where id_kelas='".$kelas."' and hari='".$hari."'"));
			
				$DataWaliKelas = mysqli_fetch_array(mysqli_query($conn,"select * from tb_wali_kelas where id_kelas='".$kelas."'"));
				$Guru = mysqli_fetch_array(mysqli_query($conn,"select id,nama_guru from tb_guru where id='".$DataWaliKelas['id_guru']."'"));
?>
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default ">
								<div class="panel-heading">
									<div class="pull-left">
										<h5 class="panel-title txt-dark"> Kelas ini diwali kelas kan kepada guru atas nama <?=$Guru['nama_guru'];?></h5>
									</div>
									<div class="pull-right">
										<a href="?Halaman=Buku Hitam Siswa" class="btn btn-warning btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Tambah Data">Kembali</span></a>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default ">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Data Nilai Kelas <?=$Kelas['nama_kelas'].' - '.$Kelas['nama_jurusan']. ' / '.$Kelas['periode']. ' / '.$Kelas['semester'];?> Pada Bulan <?=$bulan . ' Tahun '. $tahun;?> </h6>
									<!--<p class='text-danger'><b>Silakan klik nilai pelajaran siswa yang bermasalah untuk membuat surat pemanggilan</b></p>-->
									</div>
								
								
									<div class="clearfix"></div>
								</div>

								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="table-wrap">
											<div class="table-responsive">
												<table id="datable_2" class="table table-hover table-bordered display mb-30" >
													<thead>
														<tr>
															<th>NISN</th>
															<th>NAMA SISWA</th>
															<th class="text-center">Mata Pelajaran</th>
															<th class="text-center">Tanggal</th>
															<th class="text-center">Nilai</th>
														</tr>
													</thead>
													<tbody>
												<?php 
													$Siswa 	= mysqli_query($conn,"select nisn,id_siswa,nama,id_kelas from tb_siswa where id_kelas='".$kelas."'"); 
													while ($Data = mysqli_fetch_array($Siswa)) {
													    
														?>
														<tr>
														    <td rowspan='<?=$Pel['TotalPelajaran']+1;?>'><?=$Data['nisn'];?></td>
															<td rowspan='<?=$Pel['TotalPelajaran']+1;?>'><?=$Data['nama'];?></td>
															
															<?php 
															$Pelss = mysqli_query($conn,"select * from tb_jadwal_penilaian_mata_pelajaran where id_kelas='".$kelas."' and hari='".$hari."' and actice =1");
															while($DaPel = mysqli_fetch_array($Pelss)){
															    $Pelajarannya = mysqli_fetch_array(mysqli_query($conn,"select * from tb_mata_pelajaran where id_pelajaran='".$DaPel['id_pelajaran']."'"));
															    $NilaiPelajaran = mysqli_fetch_array(mysqli_query($conn,"select * from tb_nilai where id_mata_pelajaran='".$DaPel['id_pelajaran']."' and id_siswa='".$Data['id_siswa']."' and tanggal='".$tanggal."'"));
															    $Kate = $NilaiPelajaran['id'];
															    //var_dump($Kate);
															    ?>
															<tr>
															    <td><?=$Pelajarannya['nama_pelajaran'];?></td>
															    <td><?=$tanggal;?></td>
															    <td><?=$NilaiPelajaran['nilai'];?></td>
															    
															    
															</tr>
														<?php }?>
														
														
														</tr>
													<?php }?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div> 
						</div>
						<!--<div class="col-sm-4">-->
						<!--    	<div class="panel panel-default ">-->
						<!--		<div class="panel-heading">-->
						<!--			<div class="pull-left">-->
						<!--				<h6 class="panel-title txt-dark">Siswa yang Telah Dibuat surat Pemanggilan</h6>-->
									<!--<p class='text-danger'><b>Silakan klik nilai pelajaran siswa yang bermasalah untuk membuat surat pemanggilan</b></p>-->
						<!--			</div>-->
								
								
						<!--			<div class="clearfix"></div>-->
						<!--		</div>-->

						<!--		<div class="panel-wrapper collapse in">-->
						<!--			<div class="panel-body">-->
						<!--				<div class="table-wrap">-->
						<!--					<div class="table-responsive">-->
						<!--						<table id="datable_1" class="table table-hover table-bordered display mb-30" >-->
						<!--							<thead>-->
						<!--								<tr>-->
						<!--								    <th>No</th>-->
						<!--									<th>NAMA SISWA</th>-->
														
						<!--								</tr>-->
						<!--							</thead>-->
						<!--							<tbody>-->
						<!--							    </tbody>-->
						<!--							    </table>-->
						<!--							    </div>-->
						<!--							    </div>-->
						<!--							    </div>-->
						<!--							    </div>-->
						<!--							    </div>-->
													    
													    
													    
						<!--</div>-->
						
					</div>
<script>
    	$('#datable_2').on('click','.Proses',function(){
					var nama_id = $(this).attr('nama_id');
					var nama_siswa = $(this).attr('nama_siswa');
					var nama_session = $(this).attr('nama_session');
					var nama_data = $(this).attr('nama_data');
					var nama_data_id = $(this).attr('nama_data_id');
					var nama_od = $(this).attr('nama_od');
					swal({
						title: "Apakah Anda Yakin",
						text: "Membuat laporan Pemanggilan Siswa atas nama "+nama_od+ " ?",
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
								data: {nama_od:nama_od,nama_id:nama_id,nama_siswa:nama_siswa,nama_session:nama_session,nama_data:nama_data,nama_data_id:nama_data_id},
								url: 'App/Page/Buku Hitam Siswa/simpan.php?PanggilSiswa',
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