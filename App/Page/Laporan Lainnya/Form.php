<?php 

$kelas 	 	= $_GET['kelas'];
$Mapel 			= $_GET['mapel'];
$tanggal 	= $_GET['tanggal'];
$id 						= $_GET['id'];
$GuruNya 						= $_GET['Guru'];
if ($id != '') {
	$CekData = mysqli_fetch_array(mysqli_query($conn,"select * from tb_laporan_lainnya where id_siswa='".$id."' and tanggal='".$tanggal."' and id_mata_pelajaran='".$Mapel."'"));
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
								<h6 class="panel-title txt-dark">FORM CATATAN</h6>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-wrap">
											<?php if(isset($_GET['form'])){
												$id 		= $_GET['form'];
												?>
												<form class="form-horizontal" id="FormEdit" method="POST">
												<?php }else{?>
													<form class="form-horizontal" id="FormTambah" method="POST">
													<?php }?>
													<div class="form-body">
														<div class="row">
															<div class="col-md-12">
																<input type="hidden" name="id_siswa" id="id_siswa" value="<?=$id;?>">
																<input type="hidden" name="id_guru" id="id_guru" value="<?=$GuruNya;?>">
																<input type="hidden" name="tanggal" id="tanggal" value="<?=$tanggal;?>">
																<input type="hidden" name="mapel" id="mapel" value="<?=$Mapel;?>">
																<label class="control-label"><span class="text-danger"> * </span> Catatan</label>
																<?php if(isset($_GET['form'])){?>
																	<input type="hidden" name="name_id" id="name_id" value="<?=$CekData['id_laporan_lainnya'];?>">
																	<textarea class="form-control" name="keterangan" id="keterangan"><?=$CekData['keterangan'];?></textarea>
																<?php }else{?>
																	<textarea class="form-control" name="keterangan" id="keterangan"></textarea>
																<?php }?>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-offset-4 col-md-12">
																<button type="submit"  class="btn btn-success btn-anim"><i class="ti-save"></i><span class="btn-text" title="Simpan">Simpan</span></button>
																<a href="?Halaman=Laporan Lainnya&Aksi=Info&Data&kelas=<?=$kelas;?>&Mapel=<?=$Mapel;?>&Tanggal=<?=$tanggal;?>" class="btn btn-primary btn-anim"><i class="ti-angle-double-left"></i><span class="btn-text" title="Kembali">Kembali</span></a>
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
</div>
<?php }else{
	require_once(__DIR__.'/../../Error/404.php');
}
?>

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