<?php
$file = './uploads/'.$pdf_file;
$filename= $pdf_file;
header('Content-type: application/pdf');
header('Content-Disposition: inline;filename="'. $filename .'"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
@readfile($file);
 ?>
