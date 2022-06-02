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
   <div class="col-sm-7">
    <div class="panel panel-default card-view">
     <div class="panel-heading">
      <div class="pull-left">
       <h6 class="panel-title txt-dark"><?=$_GET['Halaman'];?></h6>
      </div>
      <div class="pull-right">
       <a href="?Halaman=Jurusan&Aksi=form" class="btn btn-warning btn-anim"><i class="ti-plus"></i><span class="btn-text" title="Tambah Data">Tambah</span></a>
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
            <th>Nama Jurusan</th>
            <th>Created</th>
            <th>Action</th>
           </tr>
          </thead>
          <tfoot>
           <tr>
            <th>#</th>
            <th>Nama Jurusan</th>
            <th>Created</th>
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
   <div class="col-sm-5">
    <div class="panel panel-default card-view">
     <div class="panel-heading">
      <div class="pull-left">
       <h6 class="panel-title txt-dark">Histori Delete <?=$_GET['Halaman'];?></h6>
      </div>
      <div class="clearfix"></div>
     </div>
     <div class="panel-wrapper collapse in">
      <div class="panel-body">
       <div class="table-wrap">
        <div class="table-responsive">
         <table id="example" class="table table-hover">
          <thead>
           <tr>
            <th>#</th>
            <th>Nama Jurusan</th>
            <th>Delete</th>
            <th>Action</th>
           </tr>
          </thead>
          <tfoot>
           <tr>
            <th>#</th>
            <th>Nama Jurusan</th>
            <th>Delete</th>
            <th>Action</th>
           </tr>
          </tfoot>
          <tbody>
           <?php
           $no=1;
           $DataDelete = mysqli_query($conn,"select id,nama_jurusan,created,remove_data  from tb_jurusan where remove_data='2'");
           while ($Data = mysqli_fetch_array($DataDelete)) {
            echo'
            <tr>
            <td>'.$no++.'</td>
            <td>'.$Data['nama_jurusan'].'</td>
            <td>'.date('d-m-Y',strtotime($Data['created'])).'</td>
            <td>
            <button  type="submit" id='.$Data['id'].' nama='.$Data['nama_jurusan'].' class="Repair btn btn-danger btn-icon-anim btn-circle" title="Kembalikan Data"><i class="ti-back-left"></i></button>
            <td>
            </tr>';
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
  <script>

   $('#datable_1').DataTable({
    "searching": true,
    "processing": true,
    "serverSide": true,
    "order":[2,"desc"],
    "ajax":{
     url :"App/Page/Jurusan/data.php",
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
     text: "Ingin Menghapus Jurusan ini dengan nama " + nama+
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
       url: 'App/Page/Jurusan/simpan.php?Delete',
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

   
   $('#example').on('click','.Repair',function(){
    var id            = $(this).attr('id');
    var nama          = $(this).attr('nama');
    swal({
     title: "Apakah Anda Yakin",
     text: "Ingin Mengembalikan Jurusan ini dengan nama " + nama+
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
       url: 'App/Page/Jurusan/simpan.php?Repair',
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