<?php 

require "vendor/autoload.php";
$mpdf= new \Mpdf\Mpdf();

$mpdf->SetTitle("Doc Title");
$mpdf->SetAuthor("Ego Buster");
$mpdf->SetCreator("Black Creator");
$mpdf->SetSubject("Subject here");
$mpdf->SetKeywords("key","key2");


$html="<h1>HEEEEELO WORLD</h1>";

$mpdf->WriteHTML($html);
$mpdf->Output("test.pdf");



?>