<?php 
$bulan 	 	= $_GET['bulan'];

$tahun 	    = $_GET['tahun'];

	?>
	<div class="right-sidebar-backdrop"></div>
	<div class="page-wrapper">
		<div class="container-fluid">
			<div class="row heading-bg">
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<h5 class="txt-dark">Laporan Lainnya</h5>
				</div>
				<!-- Breadcrumb -->
				<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					<ol class="breadcrumb">
						<li><a href="web.php">Dashboard</a></li>
						<li class="active"><span><?=$_GET['Halaman'];?></span></li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default card-view">
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">DATA LAPORAN LAINNYA PADA BULAN <?=$bulan;?> dan TAHUN <?=$tahun;?></h6>
							</div>
								<div class="pull-right">
								<a href="?Halaman=Laporan Lainnya" class="btn btn-warning btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Tambah Data">Kembali</span></a>
								<a href='App/Page/Cetak/Cetak.php?CetakLaporanLainnya&bulan=<?=base64_encode($bulan);?>&tahun=<?=base64_encode($tahun);?>' target='_blank' class="btn btn-success btn-anim"><i class="ti-printer"></i><span class="btn-text" title="Cetak Data">Cetak Data</a>

						
							</div>
							<div class="clearfix"></div>
						</div>
					<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="table-wrap">
								
									<div class="table-responsive">
										<table id="datable_1"  class="table table-hover display  pb-30" >
											<thead>
												<tr>
													<th>#</th>
													<th>Nama Siswa</th>
													<th>Kelas</th>
													<th>Keterangan</th>
													<th>Tanggal</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>#</th>
													<th>Nama Siswa</th>
													<th>Kelas</th>
													<th>Keterangan</th>
													<th>Tanggal</th>
												</tr>
											</tfoot>
											<tbody>
												<?php 
												$no = 1;
												// $Siswa 					 = mysqli_query($conn,"select id_siswa,nama,id_kelas from tb_siswa "); 
												// while ($Data = mysqli_fetch_array($Siswa)) {
												

													$DataMapel = mysqli_query($conn,"select * from tb_laporan_lainnya where month(tanggal)='".$bulan."' and year(tanggal)='".$tahun."'");
													while ($Data = mysqli_fetch_array($DataMapel)) {
												
													    $Siswa 					 = mysqli_fetch_array(mysqli_query($conn,"select id_siswa,nama,id_kelas from tb_siswa where id_siswa='".$Data['id_siswa']."'")); 
													$Kelas =mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$Siswa['id_kelas']."'"));
													?>
													<tr>
														<td><?=$no++;?></td>
														<td><?=$Siswa['nama'];?></td>
    <td><?=$Kelas['nama_kelas'].' / '.$Kelas['nama_jurusan'].' / '.$Kelas['periode'].' / '.$Kelas['semester'];?></td>
    <td><?=$Data['keterangan'];?></td>
    <td><?=date('d-m-Y',strtotime($Data['tanggal']));?></td>
													</tr>
													<?php 
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>



<script type="text/javascript">
	$("#FormTambah").on('submit',(function(e) {
		e.preventDefault();
		var kelas = '<?=$_GET['kelas'];?>';
		var Mapel = '<?=$_GET['mapel'];?>';
		var Tanggal = '<?=$_GET['tanggal'];?>';
		var FormTambah = $(this);
		$.ajax({
			url: 'App/Page/Laporan Lainnya/simpan.php?PostData',
			type: "POST",
			data: FormTambah.serialize(),
			dataType: "JSON",
			cache :"false",
			success: function (respone) {
				if (respone.status == 'success') {
					swal({title: "success", text: respone.message, type: "success"},
						function(){ 
							window.location = "web.php?Halaman=Laporan Lainnya&Aksi=Info&Data&kelas="+kelas+"&Mapel="+Mapel+"&Tanggal="+Tanggal;
						}
						);
				} else{
					swal({title: "error", text: respone.message, type: "error"},
						function(){
							location.reload(true);
						});
				}
			}
		});
	}));
	$("#FormEdit").on('submit',(function(e) {
		e.preventDefault();
		var kelas = '<?=$_GET['kelas'];?>';
		var Mapel = '<?=$_GET['mapel'];?>';
		var Tanggal = '<?=$_GET['tanggal'];?>';
		var FormEdit = $(this);
		$.ajax({
			url: 'App/Page/Laporan Lainnya/simpan.php?UpdateData',
			type: "POST",
			data: FormEdit.serialize(),
			dataType: "JSON",
			cache :"false",
			success: function (respone) {
				if (respone.status == 'success') {
					swal({title: "success", text: respone.message, type: "success"},
						function(){ 
							window.location = "web.php?Halaman=Laporan Lainnya&Aksi=Info&Data&kelas="+kelas+"&Mapel="+Mapel+"&Tanggal="+Tanggal;
						}
						);
				} else{
					swal({title: "error", text: respone.message, type: "error"},
						function(){
							location.reload(true);
						});
				}
			}
		});
	}));
</script>