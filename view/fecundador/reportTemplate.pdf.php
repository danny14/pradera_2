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
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),90,8,70);

$pdf ->Ln(50);

$pdf->Cell(255,10,'FECUNDADOR',1,1,'C');




  $pdf->Cell(40,10,  utf8_decode("ID"),1);
  $pdf->Cell(45,10,  utf8_decode("NOMBRE"),1);
  $pdf->Cell(40,10,  utf8_decode("EDAD"),1);
  $pdf->Cell(50,10,  utf8_decode("PESO"),1);
  $pdf->Cell(40,10,  utf8_decode("OBSERVACION"),1);
  $pdf->Cell(40,10,  utf8_decode("ID_RAZA"),1);
  $pdf->Ln();
  
foreach ($objFecundador as $fecundador){
  $pdf->Cell(40,10,  utf8_decode($fecundador->$id),1);
  $pdf->Cell(45,10,  utf8_decode($fecundador->$nombre),1);
  $pdf->Cell(40,10,  utf8_decode($fecundador->$edad),1);
  $pdf->Cell(50,10,  utf8_decode($fecundador->$peso),1);
  $pdf->Cell(40,10,  utf8_decode($fecundador->$observacion),1);
  $pdf->Cell(40,10,  utf8_decode($fecundador->$id_raza),1);
  $pdf->Ln();
  
}
$pdf->Output();
?>



