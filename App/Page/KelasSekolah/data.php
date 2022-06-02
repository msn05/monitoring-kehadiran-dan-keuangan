<?php
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');


$requestData= $_REQUEST;
$columns = array( 
	0 => 'nama_kelas',
	1 => 'nama_jurusan',
	2 => 'periode',
	3 => 'semester',
	4 => 'created',
	5 => 'id_kelas',
	6 => 'remove_data',
);

$sql="SELECT a.created,a.id_kelas,a.nama_kelas,a.remove_data,a.id_jurusan,a.id_periode,a.semester,b.id,b.nama_jurusan,c.id,c.periode ";
$sql.=" FROM tb_kelas as a left join tb_jurusan as b on b.id = a.id_jurusan left join tb_periode as c on c.id = a.id_periode where a.remove_data='1'";
$query 	 		= mysqli_query($conn, $sql) or die();
$totalData 		= mysqli_num_rows($query);
$totalFiltered 	= $totalData; 

if(!empty($requestData['search']['value']) ) {  
	
	$sql.=" WHERE nama_kelas LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR nama_jurusan LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR periode LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR semester LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR created LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR id_kelas LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR remove_data LIKE '".$requestData['search']['value']."%'  ";

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
	$nestedData[] = test_input($row["nama_kelas"]);
	$nestedData[] = test_input($row["nama_jurusan"]);
	$nestedData[] = test_input($row["periode"]);
	$nestedData[] = test_input($row["semester"]);
	$nestedData[] = test_input($row["created"]);
	$nestedData[] = '
	<a href="?Halaman=Kelas&Aksi=form&Form&id='.base64_encode($row['id']).'" button  type="submit"><button class="Edit btn btn-warning btn-icon-anim btn-circle" title="Edit Data"><i class="fa fa-edit"></i></button></a>

	<button  type="submit" id='.$row['id_kelas'].' nama='.$row['nama_kelas'].' class="Delete btn btn-danger btn-icon-anim btn-circle" title="Hapus Data"><i class="fa fa-trash"></i></button>' ;
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