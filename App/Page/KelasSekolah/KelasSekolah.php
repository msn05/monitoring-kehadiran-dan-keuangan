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
							<a href="?Halaman=KelasSekolah&Aksi=form" class="btn btn-warning btn-anim"><i class="ti-plus"></i><span class="btn-text" title="Tambah Data">Tambah</span></a>
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
												<th>Nama Kelas</th>
												<th>Jurusan</th>
												<th>Periode</th>
												<th>Semester</th>
												<th>Created</th>
												<th>Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Nama Kelas</th>
												<th>Jurusan</th>
												<th>Periode</th>
												<th>Semester</th>
												<th>Created</th>
												<th>Action</th>
											</tr>
										</tfoot>
										<tbody>
											<?php
											$no=1;
											$sql=mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode  order by a.nama_kelas and periode and semester desc");
											while ($Data = mysqli_fetch_array($sql)) {?>
												<tr>
													<td><?=$no++;?></td>
													<td><?=$Data['nama_kelas'];?></td>
													<td><?=$Data['nama_jurusan'];?></td>
													<td><?=$Data['periode'];?></td>
													<td><?=$Data['semester'];?></td>
													<td><?=date('d-m-Y',strtotime($Data['created']));?></td>
													<td><?php if($Data['Hapus'] == 1){?>
														<a href='?Halaman=KelasSekolah&Aksi=form&Form&id=<?=base64_encode($Data['id_kelas']);?>' type="submit"><button class="Edit btn btn-warning btn-icon-anim btn-circle" title="Edit Data"><i class="fa fa-edit"></i></a>

															<button  type="submit" id="<?=$Data['id_kelas'];?> nama="<?=$Data['nama_kelas'];?>" class="Delete btn btn-danger btn-icon-anim btn-circle" title="Hapus Data"><i class="fa fa-trash"></i></button>
														<?php }else{?>
															<button  type="submit" id='<?=$Data['id_kelas'];?>' nama='<?=$Data['nama_kelas'];?>' class="Repair btn btn-danger btn-icon-anim btn-circle" title="Kembalikan Data"><i class="ti-back-left"></i></button>
															<a href="?Halaman=KelasSekolah&Aksi=Info&id=<?=base64_encode($Data['id_kelas']);?>" button  type="submit"><button class="Info btn btn-info btn-icon-anim btn-circle" title="Informasi Data"><i class="fa fa-edit"></i></button></a>
														<?php }?>
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

			$('#datable_1').on('click','.Delete',function(){
				var id            = $(this).attr('id');
				var nama          = $(this).attr('nama');
				swal({
					title: "Apakah Anda Yakin",
					text: "Ingin Menghapus Kelas ini dengan nama " + nama+ " Jika Kelas ini dihapus maka akan berpengaruh pada akitivitas lain..?",
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
							url: 'App/Page/KelasSekolah/simpan.php?Delete',
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


			$('#datable_1').on('click','.Repair',function(){
				var id            = $(this).attr('id');
				var nama          = $(this).attr('nama');
				swal({
					title: "Apakah Anda Yakin",
					text: "Ingin Mengembalikann Kelas ini dengan nama " + nama+ " Jika Kelas ini dikembalikan maka akan berpengaruh pada akitivitas lain.. ?",
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
							url: 'App/Page/KelasSekolah/simpan.php?Repair',
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