<?php
//Llamamos a la libreria
require_once 'pdf_basePedido.php';
//creamos el objeto
$pdf=new PDF();


//Añadimos una pagina
$pdf->AddPage();

//Define el marcador de posición usado para insertar el número total de páginas en el documento
$pdf->AliasNbPages();
$pdf->SetFont('Arial','U',12);
$pdf->Cell(180,6,'Reporte de Pedidos '.$fecha_i.' y '.$fecha_f,0,1,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','U',12);
$pdf->Cell(70,6,'Pedidos',0,1,'L',0);
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,6,'Cod',1,0,'C',1);
$pdf->Cell(30,6,'Fecha',1,0,'C',1);
$pdf->Cell(18,6,'COD',1,0,'C',1);
$pdf->Cell(30,6,'Usuario Vendedor',1,0,'C',1);
$pdf->Cell(30,6,'Cliente',1,0,'C',1);
$pdf->Cell(25,6,'DNI ó RUC',1,0,'C',1);
$pdf->Cell(30,6,'Total de venta',1,0,'C',1);
$pdf->Cell(20,6,'Estado',1,0,'C',1);
$pdf->Ln();
$pdf->SetFont('Arial','',8);
foreach ($salesP as $m){
    $pdf->Cell(10,6,$m->id_pedido,1,0,'C',0);
    $pdf->CellFitSpace(30,6,$m->pedido_datetime,1,0,'C',0);
    $pdf->Cell(18,6,$m->pedido_correlativo,1,0,'C',0);
    $pdf->Cell(30,6,$m->user_nickname,1,0,'C',0);
    $pdf->Cell(30,6,$m->client_name,1,0,'C',0);
    $pdf->Cell(25,6,$m->client_number,1,0,'C',0);
    $pdf->Cell(30,6,$m->pedido_total,1,0,'C',0);
    $pdf->Cell(20,6,$mostrar ?? 0,1,1,'C',0);
}
$pdf->Cell(153,10,'TOTAL VENTA',0,0,'R',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,10,'S/. '.$ingresos_productos,0,0,'C',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Output();

?>