<?php
use mvc\routing\routingClass as routing;
$id = detalleSalidaTableClass::ID;
$cantidad = detalleSalidaTableClass::CANTIDAD;
$id_salida_bodega = detalleSalidaTableClass::ID_SALIDA_BODEGA;
$id_insumo = detalleSalidaTableClass::ID_INSUMO;
$id_tipo_insumo = detalleSalidaTableClass::ID_TIPO_INSUMO;



$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),90,8,70);

$pdf ->Ln(50);

$pdf->Cell(0,10,'DETALLE SALIDA',1,1,'C');
  
  $pdf->Ln();
  $pdf->Cell(40,10,  utf8_decode("CANTIDAD "),1);
  $pdf->Cell(40,10,  utf8_decode("SALIDA BODEGA"),1);
  $pdf->Cell(80,10,  utf8_decode("INSUMO"),1);
  $pdf->Cell(100,10,  utf8_decode("TIPO INSUMO"),1);
  
  $pdf->Ln();
foreach ($objDetalleSalida as $detalleSalida){
  
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(40,10,  utf8_decode($detalleSalida->cantidad),1);
  $pdf->Cell(40,10,  utf8_decode(detalleSalidaTableClass::getNameFieldForaneaSalidaBodega($detalleSalida->$id_salida_bodega)),1);
  $pdf->Cell(80,10,  utf8_decode(detalleSalidaTableClass::getNameFieldForaneaInsumo($detalleSalida->$id_insumo)),1);
  $pdf->Cell(100,10,  utf8_decode(detalleSalidaTableClass::getNameFieldForaneaTipoInsumo($detalleSalida->$id_tipo_insumo)),1);
  
  $pdf ->Ln();
  
}
$pdf->Output();
?>