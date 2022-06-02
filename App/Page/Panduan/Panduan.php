<div class="right-sidebar-backdrop"></div>
<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row heading-bg">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">Sistem Monitoring Data</h5>
			</div>
			<!-- Breadcrumb -->
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="index.html">Dashboard</a></li>
					<li><a href="#"><span>Monitoring</span></a></li>
					<li class="active"><span><?=$_GET['Halaman'];?></span></li>
				</ol>
			</div>
		</div>

		<?php
		$idSession = $_SESSION['Level'];
		if ($idSession == 1) {?>
			<div class="row">
				<div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
					<div class="panel panel-default card-view panel-refresh">
						<div class="refresh-container">
							<div class="la-anim-1"></div>
						</div>
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">Master Data</h6>
							</div>
							<div class="pull-right">
								<a class="pull-left inline-block mr-15" data-toggle="collapse" href="#collapse_1" aria-expanded="true">
									<i class="zmdi zmdi-chevron-down"></i>
									<i class="zmdi zmdi-chevron-up"></i>
								</a>
								<a href="#" class="pull-left inline-block full-screen mr-15">
									<i class="zmdi zmdi-fullscreen"></i>
								</a>

							</div>
							<div class="clearfix"></div>
						</div>
						<div  id="collapse_1" class="panel-wrapper collapse in">
							<div  class="panel-body">
								<p>Berisikan data yang dilakukan pertama kali untuk melakukan proses lainnya karena data saling berhubungan antar lainnya.</p>
								<p>1. Data Jurusan -> Tambah -> Edit -> Hapus -> Recovery</p>
								<p>2. Data Jurusan -> Tambah -> Edit -> Hapus </p>
								<p>3. Data Kelas -> Tambah -> Edit -> Hapus </p>
								<p>4. Data Mata Pelajaran -> Tambah -> Edit -> Hapus -> Recovery </p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="panel panel-default card-view panel-refresh">
						<div class="refresh-container">
							<div class="la-anim-1"></div>
						</div>
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">Data Users</h6>
							</div>
							<div class="pull-right">
								<a class="pull-left inline-block mr-15" data-toggle="collapse" href="#collapse_1" aria-expanded="true">
									<i class="zmdi zmdi-chevron-down"></i>
									<i class="zmdi zmdi-chevron-up"></i>
								</a>
								<a href="#" class="pull-left inline-block full-screen mr-15">
									<i class="zmdi zmdi-fullscreen"></i>
								</a>

							</div>
							<div class="clearfix"></div>
						</div>
						<div  id="collapse_1" class="panel-wrapper collapse in">
							<div  class="panel-body">
								<p></p>
								<p>1. Data Guru -> Tambah -> Edit -> Hapus -> Recovery => Info</p>
								<p>1. Data Siswa -> Tambah -> Edit -> Hapus -> Recovery => Info</p>
								<p>2. Data Wali Kelas -> Tambah -> Edit -> Hapus ->Recovery</p>
								<p>3. Data Pengguna -> Reset</p>
								<p> </p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Row -->

		<?php }else{?>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default card-view">
						<div class="panel-body">
							<ul class="timeline">
								<li>
									<div class="timeline-badge bg-yellow">
										<i class="pe-7s-user-female" ></i>
									</div>
									<div class="timeline-panel pa-30">
										<div class="timeline-heading">
											<h6 class="mb-15">Siswa</h6>
										</div>
										<div class="timeline-body">
											<p class="lead head-font mb-20">Siswa Mengikuti aktivitas sekolah</p>
										</div>
									</div>
								</li>

								<li class="timeline-inverted">
									<div class="timeline-badge bg-pink">
										<i class="icon-magnifier-add" ></i>
									</div>
									<div class="timeline-panel pa-30">
										<div class="timeline-heading">
											<h6 class="mb-15">Guru</h6>
										</div>
										<div class="timeline-body">
											<p class="lead  mb-20">Guru Mencari siswa tersebut kemudian mengisi data monitoring tersebut</p>
										</div>
									</div>
								</li>

								<li>
									<div class="timeline-badge bg-red">
										<i class="pe-7s-note2" ></i>
									</div>
									<div class="timeline-panel pa-30">
										<div class="timeline-heading">
											<h6 class="mb-15">Guru BK</h6>
										</div>
										<div class="timeline-body">
											<p class="lead  mb-20">Jika Siswa Bermasalah maka akan dilakukan proses pemanggilan ke ruangan bk dengan menerbitkan surat pemanggilan siswa</p>
										</div>
									</div>
								</li>

								<li class="timeline-inverted">
									<div class="timeline-badge bg-green">
										<i class="pe-7s-note2" ></i>
									</div>
									<div class="timeline-panel pa-30">
										<div class="timeline-heading">
											<h6 class="mb-15">Hasil Monitoring</h6>
										</div>
										<div class="timeline-body">
											<p class="lead  mb-20">Hasil monitoring langsung dapat dilihat oleh oleh tua siswa jika memasuki sistem</p>
										</div>
									</div>
								</li>

								<li class="clearfix no-float"></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<?php }?>


	</div>
