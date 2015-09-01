<?php
use mvc\routing\routingClass as routing;

$id = trabajadorTableClass::ID;
$nombre = trabajadorTableClass::NOMBRE;
$apellido = trabajadorTableClass::APELLIDO;
$direccion = trabajadorTableClass::DIRECCION;
$telefono = trabajadorTableClass::TELEFONO;
$id_turno = trabajadorTableClass::ID_TURNO;
$id_credencial = trabajadorTableClass::ID_CREDENCIAL;
$id_ciudad = trabajadorTableClass::ID_CIUDAD;




$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('fondoOriginal.jpg'),0,0,270);
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,90);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),120,0,'C');

$pdf ->Ln(50);

$pdf->Cell(255,10,'Trabajador',1,1,'C');




  $pdf->Cell(10,10,  utf8_decode("ID"),1);
  $pdf->Cell(40,10,  utf8_decode("NOMBRE"),1);
  $pdf->Cell(20,10,  utf8_decode("APELLIDO"),1);
  $pdf->Cell(20,10,  utf8_decode("DIRECCION"),1);
  $pdf->Cell(20,10,  utf8_decode("TELEFONO"),1);
  $pdf->Cell(40,10,  utf8_decode("TURNO"),1);
  $pdf->Cell(35,10,  utf8_decode("CREDENCIAL"),1);
  $pdf->Cell(40,10,  utf8_decode("CIUDAD"),1);
  $pdf->Ln();
foreach ($objTrabajador as $trabajador){
  $pdf->Cell(10,10,  utf8_decode($trabajador->$id),1);
  $pdf->Cell(40,10,  utf8_decode($trabajador->$nombre),1);
  $pdf->Cell(20,10,  utf8_decode($trabajador->$apellido),1);
  $pdf->Cell(20,10,  utf8_decode($trabajador->$direccion),1);
  $pdf->Cell(20,10,  utf8_decode($trabajador->$telefono),1);
  $pdf->Cell(40,10,  utf8_decode($trabajador->$id_turno),1);
  $pdf->Cell(35,10,  utf8_decode($trabajador->$id_credencial),1);
  $pdf->Cell(40,10,  utf8_decode($trabajador->$id_ciudad),1);
  
  
  
  $pdf ->Ln();
  
  
}
$pdf->Output();

?>

