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
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="table-wrap">
								<div class="table-responsive">
									<p class="text-danger">Jika Password Direset Maka password Login nya menjadi 123456</p>
									<table id="datable_1" class="table table-hover display  pb-30" >
										<thead>
											<tr>
												<th>#</th>
												<th>Kode Login</th>
												<th>Nama Pengguna</th>
												<th>Level Pengguna</th>
												<th>Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Kode Login</th>
												<th>Nama Pengguna</th>
												<th>Level Pengguna</th>
												<th>Action</th>
											</tr>
										</tfoot>
										<tbody>
											<?php 
											$no = 1;
											$DataPenguna = mysqli_query($conn,"select * from tb_users");

											while ($Data = mysqli_fetch_array($DataPenguna)) {
												$Guru = mysqli_fetch_array(mysqli_query($conn,"select id,nip,nama_guru from tb_guru where id='".$Data['id_users']."'"));
												$Ortu = mysqli_fetch_array(mysqli_query($conn,"select id_ortu,nama_ortu from tb_ortu where id_ortu='".$Data['id_users']."' "));
												$Siswa = mysqli_fetch_array(mysqli_query($conn,"select id_siswa,nama from tb_siswa where id_siswa='".$Data['id_users']."' "));
												$Level = mysqli_fetch_array(mysqli_query($conn,"select id_level,nama_level from tb_level where id_level='".$Data['id_level']."'"));
												?>
												<tr>
													<td><?=$no++;?></td>
													<td><?=$Data['KodeLogin'];?></td>
													<td><?=$Data['id_users'] == $Guru['id'] ? ''.$Guru['nama_guru'].'' : ($Data['id_users'] == $Ortu['id_ortu'] ? ''.$Ortu['nama_ortu'].'' : ($Data['id_users'] == $Siswa['id_siswa'] ? ''.$Siswa['nama'].'' : 'Tidak Diketahui'));?></td>
													<td><?=$Data['id_level'] == $Level['id_level'] ? ''.$Level['nama_level'].'' : ''?></td>
													<td>
														<button  id="<?=$Data['id_users'];?>" nama="<?=$Data['KodeLogin'];?>"  type="submit" class="Reset btn btn-danger btn-icon-anim btn-circle" title="Reset Password"><i class="icon-refresh"></i></button>
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