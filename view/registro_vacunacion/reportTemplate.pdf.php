<?php
use mvc\routing\routingClass as routing;
$id = registro_vacunacionTableClass::ID;
$fecha_registro = registroVacunacionTableClass::FECHA_REGISTRO;
$id_trabajador = registroVacunacionTableClass::ID_TRABAJADOR;
$dosis_vacuna = registroVacunacionTableClass::DOSIS_VACUNA;
$hora_vacuna = registroVacunacionTableClass::HORA_VACUNA;
$id_animal = registroVacunacionTableClass::ID_ANIMAL;
$id_insumo = registroVacunacionTableClass::ID_INSUMO;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('fondoOriginal.jpg'),0,0,270);
$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,90);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),120,0,'C');

$pdf ->Ln(50);

$pdf->Cell(255,10,'REGISTRO_VACUNACION',1,1,'C');




  $pdf->Cell(40,10,  utf8_decode("ID"),1);
  $pdf->Cell(45,10,  utf8_decode("FECHA_REGISTRO"),1);
  $pdf->Cell(40,10,  utf8_decode("ID_TRABAJADOR"),1);
  $pdf->Cell(40,10,  utf8_decode("DOSIS_VACUNA"),1);
  $pdf->Cell(40,10,  utf8_decode("HORA_VACUNA"),1);
  $pdf->Cell(40,10,  utf8_decode("ID_ANIMAL"),1);
  $pdf->Cell(40,10,  utf8_decode("ID_INSUMO"),1);
  $pdf->Ln();
  
foreach ($objRegistroVacunacion as $registro_vacunacion){
  $pdf->Cell(40,10,  utf8_decode($registro_vacunacion->$id),1);
  $pdf->Cell(45,10,  utf8_decode($registro_vacunacion->$fecha_registro),1);
  $pdf->Cell(40,10,  utf8_decode($registro_vacunacion->$id_trabajador),1);
  $pdf->Cell(40,10,  utf8_decode($registro_vacunacion->$dosis_vacuna),1);
  $pdf->Cell(40,10,  utf8_decode($registro_vacunacion->$hora_vacuna),1);
  $pdf->Cell(40,10,  utf8_decode($registro_vacunacion->$id_animal),1);
  $pdf->Cell(40,10,  utf8_decode($registro_vacunacion->$id_insumo),1);
  $pdf->Ln();
  
}
$pdf->Output();
?>



