<?php
use mvc\routing\routingClass as routing;
$id = proveedorTableClass::ID;
$nombre = proveedorTableClass::NOMBRE;
$apellido = proveedorTableClass::APELLIDO;
$direccion = proveedorTableClass::DIRECCION;
$telefono = proveedorTableClass::TELEFONO;
$correo = proveedorTableClass::CORREO;
$id_ciudad = proveedorTableClass::ID_CIUDAD;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',12);
$pdf->Image(routing::getInstance()->getUrlImg('fondoOriginal.jpg'),0,0,270);
//$pdf->Image(routing::getInstance()->getUrlImg('vak.jpg'),0,0,85);

$pdf->Image(routing::getInstance()->getUrlImg('sena.jpg'),110,0,'C');

$pdf ->Ln(50);
$pdf->SetFillColor(175,238,238);
$pdf->Cell(255,10,'FECUNDADOR',1,1,'C',true);




  $pdf->Cell(15,10,  utf8_decode("ID"),1,0,'C',true);
  $pdf->Cell(30,10,  utf8_decode("NOMBRE"),1,0,'C',true);
  $pdf->Cell(40,10,  utf8_decode("APELLIDO"),1,0,'C',true);
  $pdf->Cell(50,10,  utf8_decode("DIRECCION"),1,0,'C',true);
  $pdf->Cell(40,10,  utf8_decode("TELEFONO"),1,0,'C',true);
  $pdf->Cell(40,10,  utf8_decode("CORREO"),1,0,'C',true);
  $pdf->Cell(40,10,  utf8_decode("CIUDAD"),1,0,'C',true);
  $pdf->Ln();
  
foreach ($objProveedor as $proveedor){
  $pdf->Cell(15,10,  utf8_decode($proveedor->$id),1);
  $pdf->Cell(30,10,  utf8_decode($proveedor->$nombre),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$apellido),1);
  $pdf->Cell(50,10,  utf8_decode($proveedor->$direccion),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$telefono),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$correo),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$id_ciudad),1);
  $pdf->Ln();
  
}
$pdf->Output();
?>



