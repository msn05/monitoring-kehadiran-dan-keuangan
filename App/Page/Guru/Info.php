 <?php
 $Data = base64_decode(test_input($_GET['id']));
 $Keterangan = mysqli_fetch_array(mysqli_query($conn,"select a.active,a.id,a.nama_guru,a.nip,a.alamat,a.no_telphone,a.status_guru,a.created,b.id_users,a.foto,b.id_level,b.KodeLogin from tb_guru as a left join tb_users as b on b.id_users=a.id where a.id='".$Data."'"));
 $Level = mysqli_fetch_array(mysqli_query($conn,"select id_level,nama_level from tb_level where id_level='".$Keterangan['id_level']."'"));
 ?>

 <div class="right-sidebar-backdrop"></div>
 <!-- /Right Sidebar Backdrop -->

 <!-- Main Content -->
 <div class="page-wrapper">
 	<div class="container-fluid pt-30">

 		<!-- Row -->
 		<div class="row">
 			<div class="col-lg-3 col-xs-12">
 				<div class="panel panel-default card-view  pa-0">
 					<div class="panel-wrapper collapse in">
 						<div class="panel-body  pa-0">
 							<div class="profile-box">
 								<div class="profile-cover-pic">
 									<div class="profile-image-overlay"></div>
 								</div>
 								<div class="profile-info text-center">
 									<div class="profile-img-wrap">
 										<img class="inline-block mb-10" src="App/Page/Guru/Image/<?=$Keterangan['foto'];?>" alt="user"/>
 									</div>	
 									<h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-orange"><?=$Keterangan['nama_guru'];?></h5>
 									<h6 class="block capitalize-font pb-20">Status Terakhir <p><?=$Level['nama_level'];?></p></h6>
 								</div>	

 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="col-lg-9 col-xs-12">
 				<div class="panel panel-default card-view pa-0">
 					<div class="panel-wrapper collapse in">
 						<div  class="panel-body pb-0">
 							<div  class="tab-struct custom-tab-1">
 								<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
 									<li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>Informasi</span></a></li>
 									<li>
 										<a href="App/Page/Cetak/Cetak.php?Guru=<?=$Data;?>" target="_blank"  ><span>Cetak</span></a></li>
 									</ul>
 									<div class="tab-content" id="myTabContent_8">
 										<div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
 											<div class="row">
 												<div class="col-lg-12">
 													<div class="">
 														<div class="panel-wrapper collapse in">
 															<div class="panel-body pa-0">
 																<div class="col-sm-12 col-xs-12">
 																	<div class="form-wrap">
 																		<form action="#">
 																			<div class="form-body overflow-hide">
 																				<div class="row">
 																					<div class="col-sm-4">
 																						<div class="form-group">
 																							<label class="control-label mb-10" for="exampleInputuname_01">Nama Guru</label>
 																							<div class="input-group">
 																								<div class="input-group-addon"><i class="icon-user"></i></div>
 																								<input type="text" class="form-control" value="<?=$Keterangan['nama_guru'];?>" id="exampleInputuname_01" placeholder="willard bryant" readonly/>
 																							</div>
 																						</div>
 																					</div>
 																					<div class="col-sm-4">
 																						<div class="form-group">
 																							<label class="control-label mb-10" for="exampleInputEmail_01">NIP</label>
 																							<div class="input-group">
 																								<div class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></div>
 																								<input type="email" class="form-control" value="<?=$Keterangan['nip'];?>" id="exampleInputEmail_01" placeholder="xyz@gmail.com" readonly/>
 																							</div>
 																						</div>
 																					</div>
 																					<div class="col-sm-4">
 																						<div class="form-group">
 																							<label class="control-label mb-10" for="exampleInputContact_01">Kode Login</label>
 																							<div class="input-group">
 																								<div class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></div>
 																								<input type="email" class="form-control" value="<?=$Keterangan['KodeLogin'];?>" id="exampleInputContact_01" placeholder="+102 9388333" readonly/>
 																							</div>
 																						</div>
 																					</div>
 																				</div>
 																				<div class="row">
 																					<div class="col-sm-4">
 																						<div class="form-group">
 																							<label class="control-label mb-10" for="exampleInputuname_01">Nomor Telphone</label>
 																							<div class="input-group">
 																								<div class="input-group-addon"><i class="icon-phone"></i></div>
 																								<input type="text" class="form-control" value="<?=$Keterangan['no_telphone'];?>" id="exampleInputuname_01" placeholder="willard bryant" readonly/>
 																							</div>
 																						</div>
 																					</div>
 																					<div class="col-sm-4">
 																						<div class="form-group">
 																							<label class="control-label mb-10" for="exampleInputEmail_01">Status Guru</label>
 																							<div class="input-group">
 																								<div class="input-group-addon"><i class=" glyphicon glyphicon-pawn"></i></div>
 																								<input type="email" class="form-control" value="<?=$Keterangan['status_guru'] == 1 ? 'PNS' : ($Keterangan['status_guru'] == 2 ? 'Honor' : 'Magang');?>" id="exampleInputEmail_01" placeholder="xyz@gmail.com" readonly/>
 																							</div>
 																						</div>
 																					</div>
 																					<div class="col-sm-4">
 																						<div class="form-group">
 																							<label class="control-label mb-10" for="exampleInputContact_01">Alamat</label>
 																							<div class="input-group">
 																								<div class="input-group-addon"><i class=" glyphicon glyphicon-road"></i></div>
 																								<textarea class="form-control" readonly/><?=$Keterangan['alamat'];?></textarea>
 																							</div>
 																						</div>
 																					</div>
 																				</div>
 																				<div class="row">
 																					<div class="col-sm-4">
 																						<div class="form-group">
 																							<label class="control-label mb-10" for="exampleInputuname_01">Tanggal Dibuat</label>
 																							<div class="input-group">
 																								<div class="input-group-addon"><i class="icon-calender"></i></div>
 																								<input type="text" class="form-control" value="<?=date('d-m-Y H:i:s',strtotime($Keterangan['created']));?>" id="exampleInputuname_01" placeholder="willard bryant" readonly/>
 																							</div>
 																						</div>
 																					</div>
 																					<div class="col-sm-4">
 																						<div class="form-group">
 																							<label class="control-label mb-10" for="exampleInputEmail_01">Status Akun</label>
 																							<div class="input-group">
 																								<div class="input-group-addon"><i class=" glyphicon glyphicon-log-in"></i></div>
 																								<input type="email" class="form-control" value="<?=$Keterangan['active'] == 1 ? 'Aktif' :  'Tidak Aktif';?>" id="exampleInputEmail_01" placeholder="xyz@gmail.com"readonly/>
 																							</div>
 																						</div>
 																					</div>
 																					<div class="col-sm-4">
 																						<div class="form-group">
 																							<label class="control-label mb-10" for="exampleInputContact_01">Level Login</label>
 																							<div class="input-group">
 																								<div class="input-group-addon"><i class=" glyphicon glyphicon-pawn"></i></div>
 																								<input type="text" value="<?=$Keterangan['id_level'] == $Level['id_level'] ? "".$Level['nama_level']."" : 'Tidak Diketahui';?>" class='form-control' name="" readonly/>
 																							</div>
 																						</div>
 																					</div>
 																				</div>
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

 								</div>
 							</div>
 						</div>
 					</div>
 				</div>


 			</div>
 		</div>