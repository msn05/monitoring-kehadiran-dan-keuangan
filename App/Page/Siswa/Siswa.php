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
							<a href="?Halaman=Siswa&Aksi=form" class="btn btn-warning btn-anim"><i class="ti-plus"></i><span class="btn-text" title="Tambah Data">Tambah</span></a>
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
												<th>NISN</th>
												<th>Nama Siswa</th>
												<th>Jenis Kelamin</th>
												<th>Kelas</th>
												<th>Nomor Telphone</th>
												<th>Orang Tua</th>
												<th>Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>NISN</th>
												<th>Nama Siswa</th>
												<th>Jenis Kelamin</th>
												<th>Kelas</th>
												<th>Nomor Telphone</th>
												<th>Orang Tua</th>
												<th>Action</th>
											</tr>
										</tfoot>
										<tbody>
											<?php 
											$no = 1;
											$Siswa = mysqli_query($conn,"select a.JenisKelamin,a.id_siswa,a.nama,a.nisn,a.id_kelas,a.status,a.id_kelas,a.id_ortu,a.nomor_telphone,b.id_ortu,b.nama_ortu,c.id_users from tb_siswa as a left join tb_ortu as b on b.id_ortu=a.id_ortu left join tb_users as c on c.id_users=b.id_ortu order by id_kelas and status=NULL asc");


											while ($Data = mysqli_fetch_array($Siswa)) {
												$sql=mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$Data['id_kelas']."'"));?>
												<tr>
													<td><?=$no++;?></td>
													<td><?=$Data['nisn'];?></td>
													<td><?=$Data['nama'];?></td>
													<td><?=$Data['JenisKelamin'] == 'Laki-laki' ? 'Laki-laki' : 'Perempuan';?></td>
													<td>
														<?php if($Data['id_kelas'] == $sql['id_kelas']){ echo "".$sql['nama_kelas']."";}else{ echo "";}?>
													</td>
													<td><?=$Data['nomor_telphone'];?></td>

													<td>
														<a href="?Halaman=Siswa&Aksi=Info&id=<?=base64_encode($Data['id_ortu']);?>" button  type="submit"><button class="Edit btn btn-info btn-icon-anim btn-circle" title="Info Data"><i class="fa fa-exclamation-circle"></i></button></a>
													</td>
													<td>
														<a href="?Halaman=Siswa&Aksi=form&Form&id=<?=base64_encode($Data['id_siswa']);?>" button  type="submit"><button class="Edit btn btn-warning btn-icon-anim btn-circle" title="Edit Data"><i class="fa fa-edit"></i></button></a>
														<?php if ($Data['status'] != NULL) {
														}else{?>
															<button  id="<?=$Data['id_siswa'];?>" nama="<?=$Data['nama'];?>"  type="submit" class="Delete btn btn-danger btn-icon-anim btn-circle" title="Non Aktifkan"><i class="fa fa-sign-out"></i></button>
														<?php }?>
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


			$('#datable_1').on('click','.Delete',function(){
				var id            = $(this).attr('id');
				var nama          = $(this).attr('nama');
				swal({
					title: "Apakah Anda Yakin",
					text: "Ingin Menonaktifkan Siswa ini dengan nama " + nama+
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
							url: 'App/Page/Siswa/simpan.php?Delete',
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