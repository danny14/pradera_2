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
//$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,85);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),110,0,'C');

$pdf ->Ln(50);
$pdf->SetFillColor(175,238,238);
$pdf->Cell(255,10,'Trabajador',1,1,'C',true);


  $pdf->Cell(40,10,  utf8_decode("NOMBRE"),1,0,'C',true);
  $pdf->Cell(50,10,  utf8_decode("APELLIDO"),1,0,'C',true);
  $pdf->Cell(40,10,  utf8_decode("DIRECCION"),1,0,'C',true);
  $pdf->Cell(30,10,  utf8_decode("TELEFONO"),1,0,'C',true);
  $pdf->Cell(30,10,  utf8_decode("TURNO"),1,0,'C',true);
  $pdf->Cell(35,10,  utf8_decode("CREDENCIAL"),1,0,'C',true);
  $pdf->Cell(30,10,  utf8_decode("CIUDAD"),1,0,'C',true);
  $pdf->Ln();
foreach ($objTrabajador as $trabajador){
  $pdf->Cell(40,10,  utf8_decode($trabajador->$nombre),1);
  $pdf->Cell(50,10,  utf8_decode($trabajador->$apellido),1);
  $pdf->Cell(40,10,  utf8_decode($trabajador->$direccion),1);
  $pdf->Cell(30,10,  utf8_decode($trabajador->$telefono),1);
  $pdf->Cell(30,10,  utf8_decode(trabajadorTableClass::getNameFieldForaneaTurno($trabajador->$id_turno)),1);
  $pdf->Cell(35,10,  utf8_decode(trabajadorTableClass::getNameFieldForaneaCredencial($trabajador->$id_credencial)),1);
  $pdf->Cell(30,10,  utf8_decode(trabajadorTableClass::getNameFieldForaneaCiudad($trabajador->$id_ciudad)),1);
  
  
  
  $pdf ->Ln();
  
  
}
$pdf->Output();

?>

