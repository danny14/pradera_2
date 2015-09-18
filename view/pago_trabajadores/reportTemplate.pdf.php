<?php
use mvc\routing\routingClass as routing;
$id = pagoTrabajadoresTableClass::ID;
$fecha_inicio = pagoTrabajadoresTableClass::FECHA_INICIO;
$fecha_fin = pagoTrabajadoresTableClass::FECHA_FIN;
$subtotal = pagoTrabajadoresTableClass::SUBTOTAL;
$valor_hora = pagoTrabajadoresTableClass::VALOR_HORA;
$id_trabajador = pagoTrabajadoresTableClass::ID_TRABAJADOR;
$horas_extras = pagoTrabajadoresTableClass::HORAS_EXTRAS;
$cantidad_dias = pagoTrabajadoresTableClass::CANTIDAD_DIAS;
$trabajador_id = trabajadorTableClass::ID;
$nombreTrabajador = trabajadorTableClass::NOMBRE;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('fondoOriginal.jpg'),0,0,270);
//$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,85);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),110,0,'C');

$pdf ->Ln(50);
$pdf->SetFillColor(175,238,238);
$pdf->Cell(0,10,'PAGO TRABAJADORES',1,1,'C',true);




  $pdf->Ln();
  $pdf->Cell(35,10,  utf8_decode("FECHA_INICIO "),1,0,'C',true);
  $pdf->Cell(35,10,  utf8_decode("FECHA_FIN"),1,0,'C',true);
  $pdf->Cell(35,10,  utf8_decode("SUBTOTAL"),1,0,'C',true);
  $pdf->Cell(35,10,  utf8_decode("VALOR_HORA"),1,0,'C',true);
  $pdf->Cell(40,10,  utf8_decode("TRABAJADOR"),1,0,'C',true);
  $pdf->Cell(40,10,  utf8_decode("HORAS_EXTRAS"),1,0,'C',true);
  $pdf->Cell(40,10,  utf8_decode("CANTIDAD_DIAS"),1,0,'C',true);
  
  $pdf->Ln();
foreach ($objPagoTrabajadores as $pagoTrabajadores){
  
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(35,10,  utf8_decode($pagoTrabajadores->fecha_inicio),1);
  $pdf->Cell(35,10,  utf8_decode($pagoTrabajadores->fecha_fin),1);
  $pdf->Cell(35,10,  utf8_decode($pagoTrabajadores->subtotal),1);
  $pdf->Cell(35,10,  utf8_decode($pagoTrabajadores->valor_hora),1);
  $pdf->Cell(40,10,  utf8_decode(pagoTrabajadoresTableClass::getNameFieldForaneaTrabajador($pagoTrabajadores->id_trabajador)),1);
  $pdf->Cell(40,10,  utf8_decode($pagoTrabajadores->horas_extras),1);
  $pdf->Cell(40,10,  utf8_decode($pagoTrabajadores->cantidad_dias),1);
  
  $pdf ->Ln();
  
}
$pdf->Output();
?>