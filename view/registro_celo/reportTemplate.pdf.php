<?php
use mvc\routing\routingClass as routing;
$id = registroCeloTableClass::ID;
$fecha = registroCeloTableClass::FECHA;
 $id_fecundador = registroCeloTableClass::ID_FECUNDADOR;
 $id_animal = registroCeloTableClass::ID_ANIMAL;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('fondoOriginal.jpg'),0,0,270);
//$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,85);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),110,0,'C');

$pdf ->Ln(50);
$pdf->SetFillColor(175,238,238);
$pdf->Cell(0,10,'REGISTRO CELO',1,1,'C',true);



 $pdf->Ln();
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(86,10,  utf8_decode("FECHA CELO"),1,0,'C',TRUE);
  $pdf->Cell(86,10,  utf8_decode(" FECUNDADOR"),1,0,'C',TRUE);
  $pdf->Cell(87,10,  utf8_decode(" ANIMAL"),1,0,'C',TRUE);
  $pdf->Ln();
foreach ($objRegistroCelo as $registrocelo){
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(86,10,  utf8_decode($registrocelo->$fecha),1);
  $pdf->Cell(86,10,  utf8_decode(registroCeloTableClass::getNameFieldForaneaFecundador($registrocelo->$id_fecundador)),1);
  $pdf->Cell(87,10,  utf8_decode(registroCeloTableClass::getNameFieldForaneaAnimal($registrocelo->$id_animal)),1);
  
  $pdf ->Ln();
  
}
$pdf->Output();
?>