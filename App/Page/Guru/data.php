<?php

require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');


$requestData= $_REQUEST;
$columns = array( 
	0 => 'nama_guru',
	1 => 'nip',
	2 => 'no_telphone',
	3 => 'id',
	4 => 'id_users'
);

$sql=" SELECT a.id,a.nama_guru,a.nip,a.active,a.no_telphone,b.id_users,a.status_guru,b.KodeLogin ";
$sql.=" FROM tb_guru as a left join tb_users as b on b.id_users=a.id ";
$query 	 		= mysqli_query($conn, $sql) or die();
$totalData 		= mysqli_num_rows($query);
$totalFiltered 	= $totalData; 

if(!empty($requestData['search']['value']) ) {  
	$sql=" SELECT a.id,a.nama_guru,a.nip,a.active,a.no_telphone,b.id_users,b.id_level,a.status_guru,b.KodeLogin ";
	$sql.=" FROM tb_guru as a left join tb_users as b on b.id_users=a.id ";
	$sql.=" WHERE nama_guru LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR nip LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR no_telphone LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR nama_guru LIKE '".$requestData['search']['value']."%' ";

	$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$totalFiltered = mysqli_num_rows($query); 
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
	$query=mysqli_query($conn, $sql) or die(mysqli_error($conn)); 

} else {	
	$query=mysqli_query($conn, $sql) or die();

	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die();
}
$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	$nestedData[] = $i;
	$nestedData[] = test_input($row["nip"]);
	$nestedData[] = test_input($row["nama_guru"]);
	$nestedData[] = test_input($row["no_telphone"]);
	$nestedData[] = test_input($row["active"]) == 1 ? '<span class="btn btn-primary">Aktif</span>' : '<span class="btn btn-danger">Tidak Aktif</span>';
	$nestedData[] = test_input($row['active']) == 1 ? '
	<a href="?Halaman=Guru&Aksi=form&Form&id='.base64_encode($row['id']).'" button  type="submit"><button class="Edit btn btn-warning btn-icon-anim btn-circle" title="Edit Data"><i class="fa fa-edit"></i></button></a>
	<button  type="submit" id='.$row['id'].' nama='.$row['nama_guru'].' class="Delete btn btn-danger btn-icon-anim btn-circle" title="Non Aktifkan"><i class="fa fa-trash"></i></button> <a href="?Halaman=Guru&Aksi=Info&id='.base64_encode($row['id']).'" button  type="submit"><button class="Info btn btn-info btn-icon-anim btn-circle" title="Informasi Data"><i class="fa fa-exclamation-circle"></i></button></a>' : '<a href="?Halaman=Guru&Aksi=Info&id='.base64_encode($row['id']).'" button  type="submit"><button class="Info btn btn-info btn-icon-anim btn-circle" title="Informasi Data"><i class="fa fa-exclamation-circle"></i></button></a>' ;
	$data[] = $nestedData;
	$i++;
}

$json_data = array(
	"draw"            => intval( $requestData['draw'] ), 
	"recordsTotal"    => intval( $totalData ), 
	"recordsFiltered" => intval( $totalFiltered ), 
	"data"            => $data 
);
// send data as json format
echo json_encode($json_data);
?>