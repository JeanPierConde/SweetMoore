<?php

require_once "../modelo/ConsultarCompraModelo.php";
require_once "../modelo/ConsultaVentaModelo.php";
require_once "../repositorio/ConsultasRepository.php";

$consulta = new Consultas();

$objconsultacompramodelo = new ConsultarCompraModelo();
$objconsultaventamodelo = new ConsultarVentaModelo();

switch ($_GET["op"]) {


  case 'comprasfecha':
    $fecha_inicio = $_REQUEST["fecha_inicio"];
    $fecha_fin = $_REQUEST["fecha_fin"];

    $objconsultacompramodelo->setFecha_inicio($fecha_inicio);
    $objconsultacompramodelo->setFecha_fin($fecha_fin);

    $rspta = $consulta->comprasfecha($objconsultacompramodelo);
    $data = array();

    while ($reg = $rspta->fetch_object()) {
      $data[] = array(
        "0" => $reg->fecha,
        "1" => $reg->usuario,
        "2" => $reg->proveedor,
        "3" => $reg->tipo_comprobante,
        "4" => $reg->serie_comprobante . ' ' . $reg->num_comprobante,
        "5" => $reg->c_producto,
        "6" => $reg->c_cantidad,
        "7" => $reg->c_pcompra,
        "8" => $reg->c_pventa,
        "9" => $reg->total_compra,
        "10" => $reg->impuesto,
        "11" => $reg->c_stock,
        "12" => ($reg->estado == 'Aceptado') ? '<span class="label bg-green">Aceptado</span>' : '<span class="label bg-red">Anulado</span>'
      );
    }
    $results = array(
      "sEcho" => 1, //info para datatables
      "iTotalRecords" => count($data), //enviamos el total de registros al datatable
      "iTotalDisplayRecords" => count($data), //enviamos el total de registros a visualizar
      "aaData" => $data
    );
    echo json_encode($results);
    break;

  case 'ventasfechacliente':
    $fecha_inicio = $_REQUEST["fecha_inicio"];
    $fecha_fin = $_REQUEST["fecha_fin"];
    $idcliente = $_REQUEST["idcliente"];
    
    $objconsultaventamodelo->setFecha_inicio($fecha_inicio);
    $objconsultaventamodelo->setFecha_fin($fecha_fin);
    $objconsultaventamodelo->setIdcliente($idcliente);

    $rspta = $consulta->ventasfechacliente($objconsultaventamodelo);
    $data = array();

    while ($reg = $rspta->fetch_object()) {
      $data[] = array(
        "0" => $reg->fecha,
        "1" => $reg->usuario,
        "2" => $reg->cliente,
        "3" => $reg->tipo_comprobante,
        "4" => $reg->serie_comprobante . ' ' . $reg->num_comprobante,
        "5" => $reg->producto,
        "6" => $reg->cantidad,
        "7" => $reg->pventa,
        "8" => $reg->descuento,
        "9" => $reg->total_venta,
        "10" => $reg->impuesto,
        "11" => $reg->stock,
        "12" => ($reg->estado == 'Aceptado') ? '<span class="label bg-green">Aceptado</span>' : '<span class="label bg-red">Anulado</span>'
      );
    }
    $results = array(
      "sEcho" => 1, //info para datatables
      "iTotalRecords" => count($data), //enviamos el total de registros al datatable
      "iTotalDisplayRecords" => count($data), //enviamos el total de registros a visualizar
      "aaData" => $data
    );
    echo json_encode($results);
    break;
}
