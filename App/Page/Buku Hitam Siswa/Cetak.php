<?php

require_once(__DIR__.'/../../../Assets/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('Data',array("Attachment"=>0));
