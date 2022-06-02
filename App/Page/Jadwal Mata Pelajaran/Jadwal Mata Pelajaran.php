<div class="right-sidebar-backdrop"></div>
<!-- /Right Sidebar Backdrop -->

<!-- Main Content -->
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
					<li><a href="#"><span>Master Data</span></a></li>
					<li class="active"><span><?=$_GET['Halaman'];?></span></li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark"><?=$_GET['Halaman'];?></h6>
						</div>
						<div class="pull-right">
							<a href="?Halaman=Jadwal Mata Pelajaran&Aksi=form" class="btn btn-warning btn-anim"><i class="ti-plus"></i><span class="btn-text" title="Tambah Data">Tambah</span></a>
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
												<th>Nama Guru</th>
												<th>Nama Pelajaran</th>
												<th>Kelas</th>
												<th>Hari</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Nama Guru</th>
												<th>Nama Pelajaran</th>
												<th>Kelas</th>
												<th>Hari</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</tfoot>
										<tbody>
											<?php
											$no=1;
											$DataJadwal = mysqli_query($conn,"select * from tb_jadwal_penilaian_mata_pelajaran ");
											while ($Data = mysqli_fetch_array($DataJadwal)) {
												$sqlKelas= mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,d.id_kelas,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode left join tb_siswa as d on d.id_kelas=a.id_kelas where d.id_kelas='".$Data['id_kelas']."' and a.remove_data='1' order by a.nama_kelas asc"));
												$MataPelajaran = mysqli_fetch_array(mysqli_query($conn,"select id_pelajaran,kode_mata_pelajaran,nama_pelajaran from tb_mata_pelajaran where id_pelajaran='".$Data['id_pelajaran']."'"));
												$sql1= mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tb_guru where id='".$Data['id_guru']."'"));
												?>
												<tr>
													<td><?=$no++;?></td>
													<td><?=$sql1['nama_guru'];?></td>
													<td><?=$MataPelajaran['kode_mata_pelajaran']. '/'.$MataPelajaran['nama_pelajaran'];?></td>
													<td><?=$sqlKelas['nama_kelas']. ' / '.$sqlKelas['nama_jurusan']. ' / '.$sqlKelas['semester']. ' / '.$sqlKelas['periode'];?></td>
													<td><?=$Data['hari']. ' / '.$Data['pukul'];?></td>
													<td><?=$Data['actice'] == 1 ? 'Aktif' : 'Tidak Aktif';?></td>
													<td>
														<?=$Data['actice'] == 1 ? '
														<a href="?Halaman=Jadwal Mata Pelajaran&Aksi=form&Form&id='.base64_encode($Data['id']).'" button  type="submit"><button class="btn btn-warning btn-icon-anim btn-circle" title="Ubah Data"><i class="fa fa-edit"></i></button></a>
														<button  id='.$Data['id'].' nama='.$sql1['nama_guru'].' pelajaran='.$MataPelajaran['nama_pelajaran'].' type="submit" class="Matikan btn btn-danger btn-icon-anim btn-circle" title="Non Aktifkan"><i class="pe-7s-close"></i></button>':'	<button  id='.$Data['id'].' nama='.$sql1['nama_guru'].' pelajaran='.$MataPelajaran['nama_pelajaran'].' type="submit" class=" Aktifkan btn btn-warning btn-icon-anim btn-circle" title="Aktifkan"><i class="icon-refresh"></i></button>';?>
														<button  id="<?=$Data['id'];?>" nama="<?=$sql1['nama_guru'];?>" pelajaran="<?=$MataPelajaran['nama_pelajaran'];?>" type="submit" class="DeleteTotal btn btn-default btn-icon-anim btn-circle" title="Delete Total"><i class="fa fa-trash-o"></i></button>
													</td>
												</tr>
											<?php		}?>
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

			$('#datable_1').on('click','.Matikan',function(){
				var id            = $(this).attr('id');
				var nama          = $(this).attr('nama');
				var pelajaran      = $(this).attr('pelajaran');
				swal({
					title: "Apakah Anda Yakin",
					text: "Ingin Menonaktifkan nama pelajaran " +pelajaran+ " atas nama guru "+nama+ " ..?",
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
							url: 'App/Page/Jadwal Mata Pelajaran/simpan.php?Matikan',
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
									swal("Warning!", respone.message, "error").then(function() {
									})
								}
							}
						});
					} else {
						swal("Cancelled", "Your imaginary file is safe", "error");
					}
				});
				return false;
			});

			$('#datable_1').on('click','.DeleteTotal',function(){
				var id            = $(this).attr('id');
				var nama          = $(this).attr('nama');
				var pelajaran      = $(this).attr('pelajaran');
				swal({
					title: "Apakah Anda Yakin",
					text: "Ingin Menonaktifkan nama pelajaran " +pelajaran+ " atas nama guru "+nama+ " ..?",
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
							url: 'App/Page/Jadwal Mata Pelajaran/simpan.php?DeleteTotal',
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
									swal("Warning!", respone.message, "error").then(function() {
									})
								}
							}
						});
					} else {
						swal("Cancelled", "Your imaginary file is safe", "error");
					}
				});
				return false;
			});


			$('#datable_1').on('click','.Aktifkan',function(){
				var id            = $(this).attr('id');
				var nama          = $(this).attr('nama');
				var pelajaran      = $(this).attr('pelajaran');
				swal({
					title: "Apakah Anda Yakin",
					text: "Ingin Mengembalikann mata pelajaran " + pelajaran + " Atas nama guru " +nama+ " .. ?",
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
							url: 'App/Page/Jadwal Mata Pelajaran/simpan.php?Repair',
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
									swal("Warning!", respone.message, "error").then(function() {
									})
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