<?php
use mvc\routing\routingClass as routing;
$id = fecundadorTableClass::ID;
$nombre = fecundadorTableClass::NOMBRE;
$edad = fecundadorTableClass::EDAD;
$peso = fecundadorTableClass::PESO;
$observacion = fecundadorTableClass::OBSERVACION;
$id_raza = fecundadorTableClass::ID_RAZA;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('fondoOriginal.jpg'),0,0,270);
//$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,85);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),110,0,'C');

$pdf ->Ln(50);
$pdf->SetFillColor(175,238,238);
$pdf->Cell(255,10,'FECUNDADOR',1,1,'C',true);

  $pdf->Cell(50,10,  utf8_decode("NOMBRE"),1,0,'C',true);
  $pdf->Cell(40,10,  utf8_decode("EDAD"),1,0,'C',true);
  $pdf->Cell(50,10,  utf8_decode("PESO"),1,0,'C',true);
  $pdf->Cell(70,10,  utf8_decode("OBSERVACION"),1,0,'C',true);
  $pdf->Cell(46,10,  utf8_decode("RAZA"),1,0,'C',true);
  $pdf->Ln();
  
foreach ($objFecundador as $fecundador){
  $pdf->Cell(50,10,  utf8_decode($fecundador->$nombre),1);
  $pdf->Cell(40,10,  utf8_decode($fecundador->$edad),1);
  $pdf->Cell(50,10,  utf8_decode($fecundador->$peso),1);
  $pdf->Cell(70,10,  utf8_decode($fecundador->$observacion),1);
  $pdf->Cell(46,10,  utf8_decode(fecundadorTableClass::getNameFieldForaneaRaza($fecundador->$id_raza)),1);
  $pdf->Ln();
  
}
$pdf->Output();
?>



