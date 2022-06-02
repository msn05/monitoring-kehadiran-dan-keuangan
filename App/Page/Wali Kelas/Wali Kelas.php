<div class="right-sidebar-backdrop"></div>
<div class="page-wrapper">
	<div class="container-fluid">

		<!-- Title -->
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
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Data <?=$_GET['Halaman'];?></h6>
						</div>
						<div class="pull-right">
							<a href="?Halaman=Wali Kelas&Aksi=form" class="btn btn-warning btn-anim"><i class="ti-plus"></i><span class="btn-text" title="Tambah Data">Tambah</span></a>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="table-wrap">
								<p class="text-danger"> Hanya Dapat Mengubah Data 1 x</p>
								<div class="table-responsive">
									<table id="datable_1" class="table table-hover display  pb-30" >
										<thead>
											<tr>
												<th>#</th>
												<th>Nama Guru</th>
												<th>Kelas</th>
												<th>Created</th>
												<th>Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Nama Guru</th>
												<th>Kelas</th>
												<th>Created</th>
												<th>Action</th>
											</tr>
										</tfoot>
										<tbody>
											<?php 
											$no = 1;
											$DataWaliKelas = mysqli_query($conn,"select * from tb_wali_kelas order by active='1'");

											while ($Data = mysqli_fetch_array($DataWaliKelas)){
												$sql=mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode  where id_kelas='".$Data['id_kelas']."'")); 

												$Guru = mysqli_fetch_array(mysqli_query($conn,"select id,nama_guru from tb_guru where id='".$Data['id_guru']."'"));
												?>
												<tr>
													<td><?=$no++;?></td>
													<td><?=$Data['id_guru'] == $Guru['id'] ? ''.$Guru['nama_guru'].'' : 'Tidak Diketahui';?></td>
													<td><?=$Data['id_kelas'] == $sql['id_kelas'] ? ''.$sql['nama_kelas'].' / '.$sql['nama_jurusan']. ' / '. $sql['semester']. ' / '.$sql['periode'].''  :  'Tidak Diketahui';?></td>
													<td><?=$Data['created'];?></td>
													<td>
														<a href="?Halaman=Wali Kelas&Aksi=form&Form&id=<?=base64_encode($Data['id']);?>" button  type="submit"><button class="btn btn-warning btn-icon-anim btn-circle" title="Ubah Data"><i class="fa fa-edit"></i></button></a>
													</td>
												</tr>

											<?php }

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
		<script>
			$('#datable_1').DataTable();

			$('#datable_1').on('click','.Reset',function(){
				var id            = $(this).attr('id');
				var nama          = $(this).attr('nama');
				swal({
					title: "Apakah Anda Yakin",
					text: "Ingin Mereset Akun ini dengan Kode Login " + nama+
					" ?",
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
							data: {id:id},
							url: 'App/Page/Pengguna/simpan.php?Reset',
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