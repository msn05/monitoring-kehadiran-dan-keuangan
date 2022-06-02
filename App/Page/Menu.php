  <div class="fixed-sidebar-left">
  	<ul class="nav navbar-nav side-nav nicescroll-bar">
  		<li class="navigation-header">
  			<span>Main</span> 
  			<i class="zmdi zmdi-more"></i>
  		</li>

     <li><a href="web.php" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
     </li>
     <?php if ($LevelNya == 1){?>
       <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><div class="pull-left"><i class="ti-folder mr-20"></i><span class="right-nav-text">Master Data</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
        <ul id="ecom_dr" class="collapse collapse-level-1">
         <li>
          <a href="?Halaman=Jurusan">Jurusan</a>
        </li>
        <li>
          <a href="?Halaman=Periode">Periode</a>
        </li>
        <li>
          <a href="?Halaman=KelasSekolah">Kelas</a>
        </li>
        <li>
          <a href="?Halaman=Mata Pelajaran">Mata Pelajaran</a>
        </li>
        <li>
          <a href="?Halaman=Jadwal Mata Pelajaran">Jadwal Mata Pelajaran</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr"><div class="pull-left"><i class="pe-7s-users mr-20"></i><span class="right-nav-text">Data Users </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
      <ul id="app_dr" class="collapse collapse-level-1">
       <li>
        <a href="?Halaman=Guru">Data Guru</a>
      </li>
      <li>
        <a href="?Halaman=Siswa">Data Siswa</a>
      </li>
      <li>
        <a href="?Halaman=Wali Kelas">Data Wali Kelas</a>
      </li>
      <li>
        <a href="?Halaman=Pengguna">Data Pengguna</a>
      </li>
    </ul>
  </li>

<?php }elseif($LevelNya == 2){?>
 <li>
  <a href="?Halaman=Nilai"><div class="pull-left"><i class="ti-folder mr-20"></i><span class="right-nav-text" data-target='#dropdown_dr_lv2'>Nilai</span></div><div class="clearfix"></div></a>
</li>
<li>
  <a href="?Halaman=Absensi"><div class="pull-left"><i class="ti-folder mr-20"></i><span class="right-nav-text" data-target='#dropdown_dr_lv2'>Absensi</span></div><div class="clearfix"></div></a>
</li>
<li>
  <a href="?Halaman=Laporan Lainnya"><div class="pull-left"><i class="zmdi zmdi-book mr-20"></i><span class="right-nav-text" data-target='#dropdown_dr_lv2'>Laporan Lainnya</span></div><div class="clearfix"></div></a>
</li>
<?php }elseif($LevelNya == 3){?>
  <li>
    <a href="?Halaman=Keuangan"><div class="pull-left"><i class="ti-money mr-20"></i><span class="right-nav-text" data-target='#dropdown_dr_lv2'>Keuangan</span></div><div class="clearfix"></div></a>
  </li>
  <li>
    <a href="?Halaman=Laporan Lainnya Info"><div class="pull-left"><i class="zmdi zmdi-book mr-20"></i><span class="right-nav-text" data-target='#dropdown_dr_lv2'>Laporan Lainnya</span></div><div class="clearfix"></div></a>
  </li>

<?php }elseif($LevelNya == 4){?>
 <li>
  <a href="?Halaman=Buku Hitam Siswa"><div class="pull-left"><i class="zmdi zmdi-book mr-20"></i><span class="right-nav-text" data-target='#dropdown_dr_lv2'>Monitoring Siswa</span></div><div class="clearfix"></div></a>
</li>
<li>
  <a href="?Halaman=Laporan Lainnya Info"><div class="pull-left"><i class="zmdi zmdi-book mr-20"></i><span class="right-nav-text" data-target='#dropdown_dr_lv2'>Laporan Lainnya</span></div><div class="clearfix"></div></a>
</li>
<?php  }elseif($LevelNya == 5 || $LevelNya == 7){
  echo '
  <li>
  <a href="javascript:void(0);" data-toggle="collapse" data-target="#form_dr"><div class="pull-left"><i class="ti-folder mr-20"></i><span class="right-nav-text">Monitoring Data</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
  <ul id="form_dr" class="collapse collapse-level-1 two-col-list">
  <li>
  <a href="?Halaman=Keuangan">Keuangan</a>
  </li>
  <li>
  <a href="?Halaman=Absensi">Absensi</a>
  </li>
  <li>
  <a href="?Halaman=Nilai">Nilai</a>
  </li>
  </ul>
  </li>
  <li>
  <a href="?Halaman=Buku Hitam Siswa"><div class="pull-left"><i class="zmdi zmdi-book mr-20"></i><span class="right-nav-text">Catatan Monitorin</span></div><div class="clearfix"></div></a>
  </li>
  <li>
  <a href="?Halaman=Laporan Lainnya Info"><div class="pull-left"><i class="zmdi zmdi-book mr-20"></i><span class="right-nav-text" data-target="#dropdown_dr_lv2">Laporan Lainnya</span></div><div class="clearfix"></div></a>
  </li>

  '
  ;

  }else{?>

    <li>
    <a href="?Halaman=Laporan"><div class="pull-left"><i class="ti-folder mr-20"></i><span class="right-nav-text" data-target='#dropdown_dr_lv2'>Laporan Monitoring</span></div><div class="clearfix"></div></a>
    </li>
    
    <li>
    <a href="?Halaman=Laporan Lainnya"><div class="pull-left"><i class="ti-folder mr-20"></i><span class="right-nav-text" data-target='#dropdown_dr_lv2'>Laporan Lainnya</span></div><div class="clearfix"></div></a>
    </li>
  <?php }?>
 
  <li>
    <a href="?Halaman=Panduan"><div class="pull-left"><i class="ti-help mr-20"></i><span class="right-nav-text" data-target='#dropdown_dr_lv2'>Tentang</span></div><div class="clearfix"></div></a>
  </li>
 <li>
    <a href="javascript:void(0);" class='Keluar' name="<?=$DataUsers['id_users'];?>"><div class="pull-left"><i class="zmdi zmdi-power mr-20"></i><span class="right-nav-text" data-target='#dropdown_dr_lv2'>Logout</span></div><div class="clearfix"></div></a>
  </li>

</ul>
</div>