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
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),90,8,70);

$pdf ->Ln(50);

$pdf->Cell(254,10,'PAGO TRABAJADORES',1,1,'C');




  $pdf->Cell(20,10,  utf8_decode("ID"),1);
  $pdf->Cell(30,10,  utf8_decode("FECHA_INICIO "),1);
  $pdf->Cell(30,10,  utf8_decode("FECHA_FIN"),1);
  $pdf->Cell(30,10,  utf8_decode("SUBTOTAL"),1);
  $pdf->Cell(30,10,  utf8_decode("VALOR_HORA"),1);
  $pdf->Cell(40,10,  utf8_decode("ID_TRABAJADOR"),1);
  $pdf->Cell(35,10,  utf8_decode("HORAS_EXTRAS"),1);
  $pdf->Cell(40,10,  utf8_decode("CANTIDAD_DIAS"),1);
  
  $pdf->Ln();
foreach ($objPagoTrabajadores as $pagoTrabajadores){
  
  $pdf->Cell(20,10,  utf8_decode($pagoTrabajadores->id),1);
  $pdf->Cell(30,10,  utf8_decode($pagoTrabajadores->fecha_inicio),1);
  $pdf->Cell(30,10,  utf8_decode($pagoTrabajadores->fecha_fin),1);
  $pdf->Cell(30,10,  utf8_decode($pagoTrabajadores->subtotal),1);
  $pdf->Cell(30,10,  utf8_decode($pagoTrabajadores->valor_hora),1);
  $pdf->Cell(40,10,  utf8_decode($pagoTrabajadores->id_trabajador),1);
  $pdf->Cell(35,10,  utf8_decode($pagoTrabajadores->horas_extras),1);
  $pdf->Cell(40,10,  utf8_decode($pagoTrabajadores->cantidad_dias),1);
  
  $pdf ->Ln();
  
}
$pdf->Output();
?>