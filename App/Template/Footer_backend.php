 <footer class="footer container-fluid pl-30 pr-30">
 	<div class="row">
 		<div class="col-sm-12">
 			<p>2018 &copy; Snoopy. Pampered by Hencework modifed by <?=nameDev();?></p>
 		</div>
 	</div>
 </footer>
 <!-- /Footer -->
</div>
</div>
<!-- /Main Content -->

</div>
<!-- /#wrapper -->
<script src="<?=basePage('');?>/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Data table JavaScript -->
<script src="<?=basePage('');?>/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?=basePage('new');?>/dist/js/jquery.slimscroll.js"></script>
<script src="<?=basePage('');?>/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<!-- Owl JavaScript -->
<script src="<?=basePage('');?>/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

<!-- Switchery JavaScript -->
<script src="<?=basePage('');?>/vendors/bower_components/switchery/dist/switchery.min.js"></script>
<!-- Fancy Dropdown JS -->
<script src="<?=basePage('new');?>/dist/js/dropdown-bootstrap-extended.js"></script>


<!-- Init JavaScript -->
<script src="<?=basePage('new');?>/dist/js/init.js"></script>
<script>
	$(document).ready(function() {
		$('.Keluar').on('click',function(){
			var name  = $('name').val();
			swal({
				title: "Apakah Anda Yakin",
				text: "Ingin Keluar ?",
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
						data: {name:name},
						url: 'Logout.php',
						dataType: "JSON",
						cache:"false",
						success: function(respone) {
							if (respone.status == 'success') {
								swal({title: "success", text: respone.message, type: "success"},
									function(){ 
										window.location = "index.php";
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
	});
</script>
</body>
</html>