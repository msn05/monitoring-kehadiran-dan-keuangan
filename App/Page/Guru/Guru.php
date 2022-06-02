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
					<li><a href="#"><span>Master Data</span></a></li>
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
							<a href="?Halaman=Guru&Aksi=form" class="btn btn-warning btn-anim"><i class="ti-plus"></i><span class="btn-text" title="Tambah Data">Tambah</span></a>
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
												<th>NIP</th>
												<th>Nama Guru</th>
												<th>Nomor Telphone</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>NIP</th>
												<th>Nama Guru</th>
												<th>Nomor Telphone</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</tfoot>
										<tbody>
											
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

			$('#datable_1').DataTable({
				"searching": true,
				"processing": true,
				"serverSide": true,
				"ajax":{
					url :"App/Page/Guru/data.php",
					type: "post",
					error: function(){
						$("#datable_1 error").html("");
					}
				},
			});




			$('#datable_1').on('click','.Delete',function(){
				var id            = $(this).attr('id');
				var nama          = $(this).attr('nama');
				swal({
					title: "Apakah Anda Yakin",
					text: "Ingin Menonaktifkan guru ini dengan nama " + nama+
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
							url: 'App/Page/Guru/simpan.php?Delete',
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