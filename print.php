<?php
require 'autoload.php';
require 'app/models/Log.php';
require 'core/Database.php';
require 'app/view/report/conversor.php';
require 'app/models/Sell.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;
$connector = new WindowsPrintConnector("EPSON");
$printer = new Printer($connector);
/* Initialize */
$printer -> initialize();
$sell = new Sell();

$id = $_GET['id'];
$sale = $sell->listSale($id);
$productssale = $sell->listSaledetail($id);
/* Text */
$printer -> text("                   TIENDA 3BETA\n\n");
$printer -> text("                 RUC 10053537010\n");
$printer -> text("          Calle Condamine con Tavara 599\n");
$printer -> text("              LORETO - MAYNAS - IQUITOS\n\n");
$printer -> text("                  Ticket de Venta\n");
$printer -> text("                  ".$sale->saleproduct_correlative."\n\n");
$printer -> text("   ".$sale->saleproduct_date."\n");
$printer -> text("   Detalle                             Subtotal\n");
$printer -> text("   --------------------------------------------\n");
$monto=0;
foreach ($productssale as $p){
    $subtotal = 0;
    $subtotal = $p->sale_productstotalprice;
    $monto = $monto + $subtotal;
    $cant = $p->sale_productstotalselled;
    $nombre = $p->sale_productname;
    $printer -> text("   ".$cant."   ".$nombre."                      ".$p->sale_price."    ".$subtotal." \n");
}
$num_ = explode(".",$monto);
$dec = round($num_[1],2);
if(strlen($dec)==1){
    $dec = $dec ."0";
    ($dec==0) ? $monto = $monto.".00": $monto = $monto."0";
}
$printer -> text("   --------------------------------------------\n");
$printer -> text("                               TOTAL: S/. ".$monto." \n");
$printer -> text("                               I.G.V: S/. 0.00 \n");
$printer -> text("                           Imp Total: S/. ".$monto." \n");
$printer -> text("   --------------------------------------------\n");
//$printer -> text("   Son ".convertir($monto)."\n\n\n\n");
$printer -> text("\n\n\n\n");
$printer -> text("            *Una vez salida la mercadería\n");
$printer -> text("         no se aceptan cambios ni devoluciones\n");
$printer -> text("         Canjea tu ticket por una boleta\n");
$printer -> text("             **Gracias por su compra** \n");

$printer -> cut();
/* Pulse */
$printer -> pulse();
/* Always close the printer! On some PrintConnectors, no actual
 * data is sent until the printer is closed. */
$printer -> close();