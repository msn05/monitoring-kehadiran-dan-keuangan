<?php
require_once(__DIR__.'/../../Function/base_url.php');
require_once(__DIR__.'/../../Function/db.php');


$requestData= $_REQUEST;
$columns = array( 
	0 => 'periode',
	1 => 'id',
	2 => 'id'
);

$sql=" SELECT id,periode ";
$sql.=" FROM tb_periode ";
$query 	 		= mysqli_query($conn, $sql) or die();
$totalData 		= mysqli_num_rows($query);
$totalFiltered 	= $totalData; 

if(!empty($requestData['search']['value']) ) {  
	$sql=" SELECT id,periode ";
	$sql.=" FROM tb_periode ";
	$sql.=" WHERE periode LIKE '".$requestData['search']['value']."%' ";

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
	$nestedData[] = test_input($row["periode"]);
	$nestedData[] = '
	<a href="?Halaman=Periode&Aksi=form&Form&id='.base64_encode($row['id']).'" button  type="submit"><button class="Edit btn btn-warning btn-icon-anim btn-circle" title="Edit Data"><i class="fa fa-edit"></i></button></a>

	<button  type="submit" id='.$row['id'].' nama='.$row['periode'].' class="Delete btn btn-danger btn-icon-anim btn-circle" title="Hapus Data"><i class="fa fa-trash"></i></button>' ;
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