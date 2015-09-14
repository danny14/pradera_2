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
$pdf->Image(routing::getInstance()->getUrlImg('fondoOriginal.jpg'),0,0,270);
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,85);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),120,0,'C');

$pdf->Ln(50);
$pdf->SetFillColor(175,238,238);
$pdf->Cell(228,10,'REPORTE PARTO',1,1,'C',true);


   
 $pdf->Ln(); 

foreach ($objReporteParto as $reporteParto){
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(40,10,  utf8_decode("FECHA_PARTO "),1,0,'C',true);
  $pdf->Cell(40,10,  utf8_decode(" ANIMALES VIVOS"),1,0,'C',true); 
  $pdf->Cell(48,10,  utf8_decode(" ANIMALES MUERTOS"),1,0,'C',true);
  $pdf->Cell(30,10,  utf8_decode(" MACHOS"),1,0,'C',true);
  $pdf->Cell(30,10,  utf8_decode(" HEMBRAS"),1,0,'C',true);
  $pdf->Cell(40,10,  utf8_decode("MADRE"),1,0,'C',true);
  $pdf ->Ln();
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(40,10,  utf8_decode($reporteParto->fecha_parto),1);
  $pdf->Cell(40,10,  utf8_decode($reporteParto->n_animales_vi),1);
  $pdf->Cell(48,10,  utf8_decode($reporteParto->n_animales_m),1);
  $pdf->Cell(30,10,  utf8_decode($reporteParto->n_machos),1);
  $pdf->Cell(30,10,  utf8_decode($reporteParto->n_hembras),1);
  $pdf->Cell(40,10,  utf8_decode(reportePartoTableClass::getNameFieldForaneaAnimal($reporteParto->id_animal)),1);
  $pdf ->Ln();
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(228,10,  utf8_decode("OBSERVACIONES"),1,1,'C',TRUE);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(228,10,  utf8_decode($reporteParto->observaciones),1); 
  $pdf->Ln();
  $pdf ->Ln();
  

 
  
  
  
}
$pdf->Output();
?>