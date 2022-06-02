<?php 
session_start();
if (@$_SESSION['id'] != '') {
  header("location:web.php");
}else{
  include(__DIR__.'/App/Function/base_url.php');
  ?>
 <!DOCTYPE html>
  <html lang="en">
  <head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?=title();?></title>
    <meta name="description" content="Monitoring/">
    <meta name="keywords" content="Monitoring Sma Lalan" />
    <meta name="keywords" content="Palcomtech" />
    <meta name="keywords" content="Andika dan Fathur" />
    <meta name="author" content="hencework"/>
    <style>
    .grad1 {
      background: linear-gradient(to right, #6666ff 16%, #ffcc99 83%);
    }
  </style>
  <!-- Favicon -->
  <link rel="icon" href="<?=PageLogo('Logo');?>/favicon-96x96.png" type="image/x-icon">

  <!-- vector map CSS -->
  <link href="<?=basePage('');?>/vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>

  <link href="<?=basePage('');?>/vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">


  <!-- Custom CSS -->
  <link href="<?=basePage('');?>/new/dist/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
  <!--Preloader-->
  <div class="preloader-it">
    <div class="la-anim-1"></div>
  </div>
  <!--/Preloader-->

  <div class="wrapper  pa-0">
    <div class="page-wrapper pa-0 ma-0 auth-page">
      <div class="container-fluid">
        <!-- Row -->
        <div class="table-struct full-width full-height">
          <div class="table-cell vertical-align-middle auth-form-wrap">
            <div class="auth-form  ml-auto mr-auto no-float">
              <div class="row grad1" >
                <div class="col-sm-12 col-xs-12">
                  <div class="mb-30">
                    <h3 class="text-center txt-dark mb-10">Masuk Ke Sistem Monitoring</h3>
                  </div>  
                  <hr>
                  <div class="form-wrap">
                    <form id="LoginData" method="POST">
                      <div class="form-group">
                        <label class="control-label mb-10" for="exampleInputEmail_2">Kode Login</label>
                        <input type="text" class="form-control" id="exampleInputEmail_1" name="exampleInputEmail_1" placeholder="Kode Login Anda">
                      </div>
                      <div class="form-group">
                        <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label>
                        <div class="clearfix"></div>
                        <input type="password" class="form-control" id="exampleInputpwd_2" name="exampleInputpwd_2" placeholder="Enter pwd">
                      </div>
                      <div class="form-group text-center">
                        <button type="submit" id="Login" class="btn btn-warning  btn-rounded">Masuk</button>
                      </div>
                    </form>
                  </div>
                </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?=basePage('');?>/vendors/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?=basePage('');?>/vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
  <script src="<?=basePage('new');?>/dist/js/sweetalert-data.js"></script>
  <script src="<?=basePage('');?>/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?=basePage('');?>/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
  <script src="<?=basePage('');?>/new/dist/js/jquery.slimscroll.js"></script>
  <script src="<?=basePage('');?>/new/dist/js/init.js"></script>
  <script>
    $(document).ready(function(){
      $('#Login').on('click', function (e) {
        e.preventDefault();
        var data = $('#LoginData').serialize()
        $.ajax({
          type: "POST",
          data: data,
          url: 'Login.php',
          dataType: "json",
          cache   : "false",
          success: function (respone) {
            if (respone.status == 'success') {
              swal({title: "success", text: respone.message, type: "success"},
                function(){ 
                  window.location = "web.php";
                }
                );

            } else{
              swal({title: "error", text: respone.message, type: "error"},
                function(){ 
                  location.reload();
                }
                );
            }

          }
        });
      });
    });

  </script>



  </body>

  </html>
  <?php }?>