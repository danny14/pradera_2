<?php
use mvc\routing\routingClass as routing;
$id = insumoTableClass::ID;
$nombre = insumoTableClass::NOMBRE;
$fecha_fabricacion = insumoTableClass::FECHA_FABRICACION;
$fecha_vencimiento = insumoTableClass::FECHA_VENCIMIENTO;
$valor = insumoTableClass::VALOR;
$id_tipo_insumo = insumoTableClass::ID_TIPO_INSUMO;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('fondoOriginal.jpg'),0,0,270);
//$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,85);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),110,0,'C');

$pdf ->Ln(50);
$pdf->SetFillColor(175,238,238);
$pdf->Cell(255,10,'INSUMO',1,1,'C',true);


  $pdf->Cell(50,10,  utf8_decode("NOMBRE"),1,0,'C',true);
  $pdf->Cell(60,10,  utf8_decode("FECHA_FABRICACION"),1,0,'C',true);
  $pdf->Cell(60,10,  utf8_decode("FECHA_VENCIMIENTO"),1,0,'C',true);
  $pdf->Cell(40,10,  utf8_decode("VALOR"),1,0,'C',true);
  $pdf->Cell(45,10,  utf8_decode("TIPO INSUMO"),1,0,'C',true);
  $pdf->Ln();
  
foreach ($objInsumo as $insumo){
  
  $pdf->Cell(50,10,  utf8_decode($insumo->$nombre),1);
  $pdf->Cell(60,10,  utf8_decode($insumo->$fecha_fabricacion),1);
  $pdf->Cell(60,10,  utf8_decode($insumo->$fecha_vencimiento),1);
  $pdf->Cell(40,10,  utf8_decode($insumo->$valor),1);
  $pdf->Cell(45,10,  utf8_decode($insumo->$id_tipo_insumo),1);
  $pdf->Ln();
  
}
$pdf->Output();
?>



