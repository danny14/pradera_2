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
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),90,8,70);

$pdf ->Ln(50);

$pdf->Cell(140,10,'REGISTRO CELO',1,1,'C');




  $pdf->Cell(20,10,  utf8_decode("ID"),1);
  $pdf->Cell(30,10,  utf8_decode("FECHA"),1);
  $pdf->Cell(50,10,  utf8_decode("ID FECUNDADOR"),1);
  $pdf->Cell(40,10,  utf8_decode("ID ANIMAL"),1);
  $pdf->Ln();
foreach ($objRegistroCelo as $registrocelo){
  $pdf->Cell(20,10,  utf8_decode($registrocelo->$id),1);
  $pdf->Cell(30,10,  utf8_decode($registrocelo->$fecha),1);
  $pdf->Cell(50,10,  utf8_decode($registrocelo->$id_fecundador),1);
  $pdf->Cell(40,10,  utf8_decode($registrocelo->$id_animal),1);
  
  $pdf ->Ln();
  
}
$pdf->Output();
?>