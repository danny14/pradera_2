<?php
use mvc\routing\routingClass as routing;
$id = reportePartoTableClass::ID;
$fecha_parto = reportePartoTableClass::FECHA_PARTO;
$n_animales_vi = reportePartoTableClass::N_ANIMALES_VI;
$n_animales_m = reportePartoTableClass::N_ANIMALES_M;
$n_machos = reportePartoTableClass::N_MACHOS;
$n_hembras = reportePartoTableClass::N_HEMBRAS;
$id_animal = reportePartoTableClass::ID_ANIMAL;
$observaciones = reportePartoTableClass::OBSERVACIONES;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),90,8,70);

$pdf ->Ln(50);

$pdf->Cell(263,10,'REPORTE PARTO',1,1,'C');




  $pdf->Cell(20,10,  utf8_decode("ID"),1);
  $pdf->Cell(35,10,  utf8_decode("FECHA_PARTO "),1);
  $pdf->Cell(30,10,  utf8_decode("N_ANIMALES_VI"),1);
  $pdf->Cell(30,10,  utf8_decode("N_ANIMALES_M"),1);
  $pdf->Cell(30,10,  utf8_decode("N_MACHOS"),1);
  $pdf->Cell(30,10,  utf8_decode("N_HEMBRAS"),1);
  $pdf->Cell(30,10,  utf8_decode("ID_ANIMAL"),1);
  $pdf->Cell(58,10,  utf8_decode("OBSERVACIONES"),1);
  
  $pdf->Ln();
foreach ($objReporteParto as $reporteParto){
  
  $pdf->Cell(20,10,  utf8_decode($reporteParto->id),1);
  $pdf->Cell(35,10,  utf8_decode($reporteParto->fecha_parto),1);
  $pdf->Cell(30,10,  utf8_decode($reporteParto->n_animales_vi),1);
  $pdf->Cell(30,10,  utf8_decode($reporteParto->n_animales_m),1);
  $pdf->Cell(30,10,  utf8_decode($reporteParto->n_machos),1);
  $pdf->Cell(30,10,  utf8_decode($reporteParto->n_hembras),1);
  $pdf->Cell(30,10,  utf8_decode($reporteParto->id_animal),1);
  $pdf->Cell(58,10,  utf8_decode($reporteParto->observaciones),1);
  
  $pdf ->Ln();
  
}
$pdf->Output();
?>