<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?=Title();?></title>
	<meta name="description" content="Snoopy is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Snoopy Admin, Snoopyadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework"/>
	<link rel="icon" href="<?=PageLogo('Logo');?>/favicon-96x96.png" type="image/x-icon">
	<link href="<?=basePage('');?>/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=basePage('');?>/vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=basePage('');?>/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=basePage('');?>/vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
	
	<link href="<?=basePage('new');?>/dist/css/style.css" rel="stylesheet" type="text/css">
	<script src="<?=basePage('');?>/vendors/bower_components/jquery/dist/jquery.min.js"></script>


	<!-- Bootstrap Select JavaScript -->

	<script src="<?=basePage('');?>/vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
	<script src="<?=basePage('new');?>/dist/js/sweetalert-data.js"></script>
	
	<script src="<?=basePage('');?>/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

	<script src="<?=basePage('');?>/vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
	
	<!-- Bootstrap Select JavaScript -->
	<script src="<?=basePage('');?>/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

	<script type="text/javascript">
		$('#example').DataTable();
	</script>
</head>

<body>
	<!--Preloader-->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!--/Preloader-->
	<div class="wrapper  theme-1-active pimary-color-blue">

		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="web.php">
							<img class="brand-img" src="<?=PageLogo('');?>/Logo/logo.png" alt="brand"/>
							<span class="brand-text">SMA LaLan</span>
						</a>
					</div>
				</div>  
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>

			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">
					<?php 
					$Level = $_SESSION['id'];
					$LevelNya = $_SESSION['Level'];
					$DataUsers = mysqli_fetch_array(mysqli_query($conn,"SELECT id_users,KodeLogin from tb_users where id_users='".$Level."'"));
					$Guru = mysqli_fetch_array(mysqli_query($conn,"SELECT id,foto,nama_guru from tb_guru where id='".$DataUsers['id_users']."'"));
					$Siswa = mysqli_fetch_array(mysqli_query($conn,"SELECT id_siswa,nama,foto from tb_siswa where id_siswa='".$DataUsers['id_users']."'"));
					$Wali = mysqli_fetch_array(mysqli_query($conn,"SELECT id_ortu,nama_ortu from tb_ortu where id_ortu='".$DataUsers['id_users']."'"));
					?>
					<li class="dropdown auth-drp">
						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="
							<?=$DataUsers['id_users'] == $Guru['id'] ?  'App/Page/Guru/Image/'.$Guru['foto'].'' : 'App/Image/Default/avatar.jpg';?>" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
							<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
								<li>
									<a href="javascript:void(0);" class='Keluar' name="<?=$DataUsers['id_users'];?>"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
								</li>
							</ul>
						</li>
					</ul>
				</div>  
			</nav>
			<script>
				
			</script>
