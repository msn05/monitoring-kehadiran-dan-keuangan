    <link href="<?=basePage('');?>/vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>
    <script src="<?=basePage('');?>/vendors/bower_components/raphael/raphael.min.js"></script>
    <script src="<?=basePage('');?>/vendors/bower_components/morris.js/morris.min.js"></script>
    <script src="<?=basePage('new');?>/dist/js/morris-data.js"></script>
    <?php 
       $Jadwal = mysqli_fetch_array(mysqli_query($conn,"select * from tb_wali_kelas where id_guru = '".$_SESSION['id']."' order by active='1'"));
        $sqlKelas=mysqli_fetch_array(mysqli_query($conn,"SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data as Hapus,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.id_kelas='".$Jadwal['id_kelas']."'"));?>
       ?>
    
    <div class="right-sidebar-backdrop"></div>
    <!-- /Right Sidebar Backdrop -->

    <!-- Main Content -->
    <div class="page-wrapper">
    	<div class="container-fluid">
    		<!-- Title -->
    		<div class="row heading-bg">
    			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    				<h5 class="txt-dark">Dashboard</h5>
    			</div>
    			<!-- Breadcrumb -->
    			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    				<ol class="breadcrumb">
    					<li><a href="web.php">Dashboard</a></li>
    				</ol>
    			</div>
    		</div>
        <?php 
        $NamaLevel = mysqli_fetch_array(mysqli_query($conn,"select id_level,nama_level from tb_level where id_level='".$LevelNya."'"));?>
        <div class="row">
          <div class="col-lg-12 col-md-12">
    
      
                 <div class="alert alert-success alert-dismissable">
              Anda Telah Login Sebagai <?=$NamaLevel['nama_level'];?>
               
       
           
          </div>
        </div>
      </div>
         <div class="row">
      <?php if($LevelNya == 3){?>
     
      <div class="col-lg-12">
  <div class="panel panel-default card-view">
   <div class="panel-heading">
    <div class="pull-left">
     <h6 class="panel-title txt-dark">Daftar Siswa Anda Pada Kelas <?=$sqlKelas['nama_kelas'].' / '.$sqlKelas['nama_jurusan'].' / '.$sqlKelas['periode'].' / '.$sqlKelas['semester'];?></h6>
   </div>
   <div class="clearfix"></div>
 </div>
 <div class="panel-wrapper collapse in">
  <div class="panel-body">
   <div class="table-wrap">
    <div class="table-responsive">
     <table id="datable_4" class="table table-hover display  pb-30" >
      <thead>
       <tr>
        <th>#</th>
        <th>NISN</th>
        <th>Nama Siswa</th>
        <th>Jenis Kelamin</th>
        <th>Nomor Telehphone</th>
      </tr>
    </thead>
    <tfoot>
     <tr>
         <th>#</th>
        <th>NISN</th>
        <th>Nama Siswa</th>
        <th>Jenis Kelamin</th>
        <th>Nomor Telehphone</th>
    </tr>
  </tfoot>
  <tbody>
   <?php 
 
   $no = 1;

  $Data = mysqli_query($conn,"select * from tb_siswa where id_kelas ='".$Jadwal['id_kelas']."'");
       while ($Siswa = mysqli_fetch_array($Data)) {
         ?>
       <tr>
     <td><?=$no++;?></td>
     <td><?=$Siswa['nisn'];?></td>
     <td><?=$Siswa['nama'];?></td>
     <td><?=$Siswa['JenisKelamin'] == 'Laki-laki' ? 'Laki-laki' : 'Perempuan';?></td>
     <td>
     <?=$Siswa['nomor_telphone'];?>
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
      
      
            <?php }elseif($LevelNya == 2){
        
            ?>
  
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
         <div class="panel-wrapper collapse in">
          <div class="panel-body pa-0">
           <div class="sm-data-box">
            <div class="container-fluid">
             <?php
             
             $KelasGuru = mysqli_fetch_array(mysqli_query($conn,"select id_kelas,hari,count(id_kelas) as Total, count(hari) as TotalHariGuru from tb_jadwal_penilaian_mata_pelajaran where id_guru='".$_SESSION['id']."' order by id_kelas"));?>
             <div class="row">
              <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
               <span class="txt-dark block counter"><span class="counter-anim"></span><?=$KelasGuru['Total'];?> Kelas</span>
               <span class="weight-500 uppercase-font block font-13">Total Kelas Anda</span>
             </div>
             <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                 <img class='data-right-rep-icon txt-grey' src="https://img.icons8.com/pastel-glyph/50/000000/classroom.png"/>
             
             </div>
           </div>	
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="panel panel-success card-view pa-0">
   <div class="panel-wrapper collapse in">
    <div class="panel-body pa-0">
     <div class="sm-data-box">
      <div class="container-fluid">
             <div class="row">
        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
         <span class="txt-dark block counter"><span class=""></span><?=$KelasGuru['TotalHariGuru'];?></span>
         <span class="weight-500 uppercase-font block font-13">Waktu Jam Belajar</span>
       </div>
       <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
        <img class='data-right-rep-icon txt-grey' src="https://img.icons8.com/pastel-glyph/50/000000/time.png"/>
       </div>
     </div>	
   </div>
 </div>
</div>
</div>
</div>
</div>
<div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
							<div class="panel panel-primary card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-light">Task To You</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<p>1. Mengelola Data Nilai</p>
										<p>2. Mengelola Data Absensi</p>
										<p>3. Mengelola Data Laporan Lainnya jika Ada</p>
									</div>
								</div>
							</div>
						</div>
      
      <?php }elseif($LevelNya == 5){?>
      
      
      <?php }else{?>
            <div class="row">
       <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
         <div class="panel-wrapper collapse in">
          <div class="panel-body pa-0">
           <div class="sm-data-box">
            <div class="container-fluid">
             <?php
             $Pengguna = mysqli_fetch_array(mysqli_query($conn,"select id_users,count(id_users) as Total from tb_users"));?>
             <div class="row">
              <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
               <span class="txt-dark block counter"><span class="counter-anim"></span><?=$Pengguna['Total'];?></span>
               <span class="weight-500 uppercase-font block font-13">Pengguna</span>
             </div>
             <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
               <i class="icon-user-following data-right-rep-icon txt-grey"></i>
             </div>
           </div>	
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
  <div class="panel panel-default card-view pa-0">
   <div class="panel-wrapper collapse in">
    <div class="panel-body pa-0">
     <div class="sm-data-box">
      <div class="container-fluid">
       <?php
       $Keuangan = mysqli_fetch_array(mysqli_query($conn,"select nominal,sum(nominal) as Total from tb_keuangan"));?>
       <div class="row">
        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
         <span class="txt-dark block counter"><span class=""></span>Rp <?=number_format($Keuangan['Total'],0,',','.');?></span>
         <span class="weight-500 uppercase-font block font-13">Keuangan</span>
       </div>
       <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
         <i class="fa  fa-money data-right-rep-icon txt-grey"></i>
       </div>
     </div>	
   </div>
 </div>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
  <div class="panel panel-default card-view pa-0">
   <div class="panel-wrapper collapse in">
    <div class="panel-body pa-0">
     <div class="sm-data-box">
      <div class="container-fluid">
       <?php
       $DataSiswa = mysqli_fetch_array(mysqli_query($conn,"select id_siswa,count(id_siswa) as Total from tb_siswa"));?>
       <div class="row">
        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
         <span class="txt-dark block counter"><span class=""></span><?=$DataSiswa['Total'];?></span>
         <span class="weight-500 uppercase-font block font-13">Siswa</span>
       </div>
       <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
         <i class="fa fa-users data-right-rep-icon txt-grey"></i>
       </div>
     </div>	
   </div>
 </div>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
  <div class="panel panel-default card-view pa-0">
   <div class="panel-wrapper collapse in">
    <div class="panel-body pa-0">
     <div class="sm-data-box">
      <div class="container-fluid">
       <?php
       $DataGuru = mysqli_fetch_array(mysqli_query($conn,"select id,count(id) as Total from tb_guru"));?>
       <div class="row">
        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
         <span class="txt-dark block counter"><span class=""></span><?=$DataGuru['Total'];?></span>
         <span class="weight-500 uppercase-font block font-13">Guru</span>
       </div>
       <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
         <i class="fa fa-users data-right-rep-icon txt-grey"></i>
       </div>
     </div>	
   </div>
 </div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
 <div class="col-lg-6">
  <div class="panel panel-default card-view">
   <div class="panel-heading">
    <div class="pull-left">
     <h6 class="panel-title txt-dark">Grafik</h6>
   </div>
   <div class="clearfix"></div>
 </div>
 <div class="panel-wrapper collapse in">
  <div id="morris_extra_bar_chart" class="morris-chart"></div>
</div>
</div>
</div>
<div class="col-lg-6">
  <div class="panel panel-default card-view">
   <div class="panel-heading">
    <div class="pull-left">
     <h6 class="panel-title txt-dark">Daftar Siswa</h6>
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
      </tr>
    </thead>
    <tfoot>
     <tr>
      <th>#</th>
      <th>NISN</th>
      <th>Nama Siswa</th>
      <th>Jenis Kelamin</th>
      <th>Kelas</th>
    </tr>
  </tfoot>
  <tbody>
   <?php 
   $no = 1;
   $Siswa = mysqli_query($conn,"select a.JenisKelamin,a.id_siswa,a.nama,a.nisn,a.id_kelas,a.status,a.id_kelas,a.id_ortu,a.nomor_telphone,b.id_ortu,b.nama_ortu,c.id_users from tb_siswa as a left join tb_ortu as b on b.id_ortu=a.id_ortu left join tb_users as c on c.id_users=b.id_ortu order by id_kelas and status=NULL limit 2 ");
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
<?php }?>
</div>
</div>
<script>
    $('#datable_4').DataTable();
    
</script>
<script src="<?=basePage('');?>/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="<?=basePage('');?>/vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>
<script src="<?=basePage('');?>/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
<script src="<?=basePage('new');?>/dist/js/dashboard-data.js"></script>

