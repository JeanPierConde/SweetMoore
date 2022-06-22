<?php 
//incluir la conexion de base de datos
require_once "../modelo/IngresoModelo.php";
require_once "../config/Conexion.php";

class Ingreso{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro
public function insertar(IngresoModelo $datos,$idarticulo,$cantidad,$precio_compra,$precio_venta){
	//$sql="INSERT INTO ingreso (idproveedor,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_compra,estado) VALUES ('$datos->idproveedor','$datos->idusuario','$datos->tipo_comprobante','$datos->serie_comprobante','$datos->num_comprobante','$datos->fecha_hora','$datos->impuestos','$datos->total_compra','Aceptado')";
	$sql = "CALL usp_compra_registrar('$datos->idproveedor',
		 							  '$datos->idusuario',
									  '$datos->tipo_comprobante',
									  '$datos->serie_comprobante',
									  '$datos->num_comprobante',
									  '$datos->fecha_hora',
									  '$datos->impuestos',
									  '$datos->total_compra',
									  'Aceptado', 
									  @PO_CODE,
									  @PO_MESSAGE)";

	 $rspta = ejecutarConsultaSimpleFila($sql);
	 //$idingresonew=ejecutarConsulta_retornarID($sql);

	 $idingresonew = $rspta["idIngreso"];
	 $num_elementos=0;
	 $sw=true;
	 while ($num_elementos < count($idarticulo)) {

		
	 	//$sql_detalle="INSERT INTO detalle_ingreso (idingreso,idarticulo,cantidad,precio_compra,precio_venta) VALUES('$idingresonew','$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_compra[$num_elementos]','$precio_venta[$num_elementos]')";

		clearStoredResults();
		 $sql_detalle = "CALL usp_compradetalle_registrar('$idingresonew',
														  '$idarticulo[$num_elementos]',
														  '$cantidad[$num_elementos]',
														  '$precio_compra[$num_elementos]',
														  '$precio_venta[$num_elementos]',
														  @PO_CODE,
														  @PO_MESSAGE)";

	 	 ejecutarConsulta($sql_detalle) or $sw=false;

	 	$num_elementos=$num_elementos+1;
	 }
	 return $sw;
}

public function anular($idingreso){
	//$sql="UPDATE ingreso SET estado='Anulado' WHERE idingreso='$idingreso'";
	clearStoredResults();
	$sql = "CALL usp_compra_anular('$idingreso',
								   @PO_CODE,
								   @PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idingreso){
	//$sql="SELECT i.idingreso,DATE(i.fecha_hora) as fecha,i.idproveedor,p.nombre as proveedor,u.idusuario,u.nombre as usuario, i.tipo_comprobante,i.serie_comprobante,i.num_comprobante,i.total_compra,i.impuesto,i.estado FROM ingreso i INNER JOIN persona p ON i.idproveedor=p.idpersona INNER JOIN usuario u ON i.idusuario=u.idusuario WHERE idingreso='$idingreso'";
	clearStoredResults();
	$sql = "CALL usp_compra_buscar_id('$idingreso',
									  @PO_CODE,
									  @PO_MESSAGE)";
	return ejecutarConsultaSimpleFila($sql);
}

public function listarDetalle($idingreso){
	//$sql="SELECT di.idingreso,di.idarticulo,a.nombre,di.cantidad,di.precio_compra,di.precio_venta FROM detalle_ingreso di INNER JOIN articulo a ON di.idarticulo=a.idarticulo WHERE di.idingreso='$idingreso'";
	clearStoredResults();
	$sql = "CALL usp_compradetalle_buscar_id('$idingreso',
									         @PO_CODE,
									         @PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

//listar registros
public function listar(){
	//$sql="SELECT i.idingreso,DATE(i.fecha_hora) as fecha,i.idproveedor,p.nombre as proveedor,u.idusuario,u.nombre as usuario, i.tipo_comprobante,i.serie_comprobante,i.num_comprobante,i.total_compra,i.impuesto,i.estado FROM ingreso i INNER JOIN persona p ON i.idproveedor=p.idpersona INNER JOIN usuario u ON i.idusuario=u.idusuario ORDER BY i.idingreso DESC";
	clearStoredResults();
	$sql = "CALL usp_compra_listar(@PO_CODE,@PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

}
