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
			<div class="col-sm-6">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark"><?=$_GET['Halaman'];?></h6>
						</div>
						<div class="pull-right">
							<a href="?Halaman=Mata Pelajaran&Aksi=form" class="btn btn-warning btn-anim"><i class="ti-plus"></i><span class="btn-text" title="Tambah Data">Tambah</span></a>
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
												<th>Kode Mata Pelajaran</th>
												<th>Nama Pelajaran</th>
												<th>Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Kode Mata Pelajaran</th>
												<th>Nama Pelajaran</th>
												<th>Action</th>
											</tr>
										</tfoot>
										<tbody>
											<?php 
											$no =1 ;
											$MataPelajaran = mysqli_query($conn,"select id_pelajaran,kode_mata_pelajaran,nama_pelajaran from tb_mata_pelajaran where active='1'");
											while ($Data = mysqli_fetch_array($MataPelajaran)) {
												echo "<tr>
												<td>".$no++."</td>
												<td>".$Data['kode_mata_pelajaran']."</td>
												<td>".$Data['nama_pelajaran']."</td>
												<td>
												<a href='?Halaman=Mata Pelajaran&Aksi=form&Form=".base64_encode($Data['id_pelajaran'])."'><button  type='submit' id=".$Data['id_pelajaran']." nama=".$Data['nama_pelajaran']." class='Edit btn btn-warning btn-icon-anim btn-circle' title='Edit Data'><i class='fa fa-edit'></i></button></a>
												<button  type='submit' id=".$Data['id_pelajaran']." nama=".$Data['nama_pelajaran']." class='Delete btn btn-danger btn-icon-anim btn-circle' title='Hapus Data'><i class='fa fa-trash-o'></i></button>
												</td>
												</tr>";
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
			<div class="col-sm-6">
				<div class="panel panel-default card-view">
					
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="table-wrap">
								<div class="table-responsive">
									<table id="example" class="table table-hover display  pb-30" >
										<thead>
											<tr>
												<th>#</th>
												<th>Nama Pelajaran</th>
												<th>Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Nama Pelajaran</th>
												<th>Action</th>
											</tr>
										</tfoot>
										<tbody>
											<?php 
											$no =1 ;
											$MataPelajaran = mysqli_query($conn,"select id_pelajaran,nama_pelajaran from tb_mata_pelajaran where active='2'");
											while ($Data = mysqli_fetch_array($MataPelajaran)) {
												echo "<tr>
												<td>".$no++."</td>
												<td>".$Data['nama_pelajaran']."</td>
												<td>
												<button  type='submit' id=".$Data['id_pelajaran']." nama=".$Data['nama_pelajaran']." class='Kembalikan btn btn-danger btn-icon-anim btn-circle' title='Kembalikan Data'><i class='ti-back-left'></i></button>
												<button  type='submit' id=".$Data['id_pelajaran']." nama=".$Data['nama_pelajaran']." class='Deletes btn btn-warning btn-icon-anim btn-circle' title='Hapus Data'><i class='fa fa-trash-o'></i></button>
												</td>
												</tr>";
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
	<script>

		$('#example').DataTable();
		$('#datable_1').DataTable();
		$('#datable_1').on('click','.Delete',function(){
			var id            = $(this).attr('id');
			var nama          = $(this).attr('nama');
			swal({
				title: "Apakah Anda Yakin",
				text: "Ingin Menghapus Mata Pelajan " + nama+
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
						url: 'App/Page/Mata Pelajaran/simpan.php?Delete',
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

		$('#example').on('click','.Kembalikan',function(){
			var id            = $(this).attr('id');
			var nama          = $(this).attr('nama');
			swal({
				title: "Apakah Anda Yakin",
				text: "Ingin Mengembalikan Mata Pelajaran " + nama+
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
						url: 'App/Page/Mata Pelajaran/simpan.php?Repair',
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

		$('#example').on('click','.Deletes',function(){
			var id            = $(this).attr('id');
			var nama          = $(this).attr('nama');
			swal({
				title: "Apakah Anda Yakin",
				text: "Ingin Menghapus Mata Pelajaran " + nama+
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
						url: 'App/Page/Mata Pelajaran/simpan.php?Deletes',
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