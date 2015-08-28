<?php
use mvc\routing\routingClass as routing;

 $id = usuarioTableClass::ID;
 $user_name = usuarioTableClass::USER; 
 $created_at = usuarioTableClass::CREATED_AT;




$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),90,8,70);

$pdf ->Ln(50);

$pdf->Cell(255,10,'ANIMAL',1,1,'C');




  $pdf->Cell(10,10,  utf8_decode("ID"),1);
  $pdf->Cell(40,10,  utf8_decode("NOMBRE"),1);
  $pdf->Cell(20,10,  utf8_decode("GENERO"),1);
  $pdf->Cell(20,10,  utf8_decode("EDAD"),1);
  $pdf->Cell(20,10,  utf8_decode("PESO"),1);
  $pdf->Cell(40,10,  utf8_decode("FECHA_INGRESO"),1);
  $pdf->Cell(35,10,  utf8_decode("NUMERO_PARTOS"),1);
  $pdf->Cell(40,10,  utf8_decode("ID_RAZA"),1);
  $pdf->Cell(30,10,  utf8_decode("ID_ESTADO"),1);
  $pdf->Ln();
foreach ($objAnimal as $animal){
  $pdf->Cell(10,10,  utf8_decode($animal->$id),1);
  $pdf->Cell(40,10,  utf8_decode($animal->$nombre),1);
  $pdf->Cell(20,10,  utf8_decode($animal->$genero),1);
  $pdf->Cell(20,10,  utf8_decode($animal->$edad),1);
  $pdf->Cell(20,10,  utf8_decode($animal->$peso),1);
  $pdf->Cell(40,10,  utf8_decode($animal->$fecha_ingreso),1);
  $pdf->Cell(35,10,  utf8_decode($animal->$numero_partos),1);
  $pdf->Cell(40,10,  utf8_decode($animal->$id_raza),1);
  $pdf->Cell(30,10,  utf8_decode($animal->$id_estado),1);
  
  
  
  $pdf ->Ln();
  
  
}
$pdf->Output();

?>

