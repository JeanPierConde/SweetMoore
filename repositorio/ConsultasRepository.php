<?php 
//incluir la conexion de base de datos
require_once "../modelo/ConsultarCompraModelo.php";
require_once "../modelo/ConsultaVentaModelo.php";
require_once "../config/Conexion.php";
class Consultas{


	//implementamos nuestro constructor
public function __construct(){

}

//listar registros
public function comprasfecha(ConsultarCompraModelo $datos){
	clearStoredResults();
	//$sql="SELECT DATE(i.fecha_hora) as fecha, u.nombre as usuario, p.nombre as proveedor, i.tipo_comprobante, i.serie_comprobante, i.num_comprobante, i.total_compra,i.impuesto,i.estado, 
	//a.nombre as c_producto, di.cantidad as c_cantidad, di.precio_compra as c_pcompra, di.precio_venta as c_pventa,a.stock as c_stock
	
	//FROM Compra i INNER JOIN Cliente_Provedor p ON i.idproveedor=p.idpersona 
	//INNER JOIN Usuario u ON i.idusuario=u.idusuario
	//INNER JOIN Detalle_Compra di ON i.idingreso = di.idingreso 
	//INNER JOIN Producto a  ON di.idarticulo= a.idarticulo 
	//WHERE DATE(i.fecha_hora)>='$datos->fecha_inicio' AND DATE(i.fecha_hora)<='$datos->fecha_fin'";
	
	$sql = "CALL usp_consulta_compras_fecha('$datos->fecha_inicio',
											'$datos->fecha_fin',
											@PO_CODE,
											@PO_MESSAGE)";
	return ejecutarConsulta($sql);
}


public function ventasfechacliente(ConsultarVentaModelo $datos){
	clearStoredResults();
	if( $datos->idcliente == 8){

		//$sql="SELECT DATE(v.fecha_hora) as fecha, u.nombre as usuario, p.nombre as cliente, dv.cantidad as cantidad, dv.precio_venta as pventa,
		// dv.descuento as descuento,
		  //v.tipo_comprobante,v.serie_comprobante, v.num_comprobante , v.total_venta, v.impuesto, v.estado, a.nombre as producto,a.stock as stock
		 //FROM Venta v INNER JOIN Cliente_Proveedor p ON v.idcliente=p.idpersona 
		 //INNER JOIN Usuario u ON v.idusuario=u.idusuario 
		 //INNER JOIN Detalle_Venta dv ON v.idventa=dv.idventa 
		 //INNER JOIN Producto a ON dv.idarticulo = a.idarticulo";

		 $sql = "CALL usp_consulta_venta_cliente(@PO_CODE,@PO_MESSAGE)"; 
		return ejecutarConsulta($sql);
		
	}else{
		//$sql="SELECT DATE(v.fecha_hora) as fecha, u.nombre as usuario, p.nombre as cliente, dv.cantidad as cantidad, dv.precio_venta as pventa, dv.descuento as descuento, v.tipo_comprobante,v.serie_comprobante, v.num_comprobante , v.total_venta, v.impuesto, v.estado, a.nombre as producto,a.stock as stock FROM Venta v INNER JOIN Cliente_Proveedor p ON v.idcliente=p.idpersona INNER JOIN Usuario u ON v.idusuario=u.idusuario INNER JOIN Detalle_Venta dv ON v.idventa=dv.idventa INNER JOIN Producto a ON dv.idarticulo = a.idarticulo WHERE DATE(v.fecha_hora)>='$datos->fecha_inicio' AND DATE(v.fecha_hora)<='$datos->fecha_fin' AND v.idcliente='$datos->idcliente'";
	
		$sql = "CALL usp_consulta_venta_cliente_fechas('$datos->fecha_inicio',
													   '$datos->fecha_fin',
													   '$datos->idcliente',
														@PO_CODE,
														@PO_MESSAGE)";
	
		return ejecutarConsulta($sql);

	}
	
}

public function totalcomprahoy(){
	//$sql="SELECT IFNULL(SUM(total_compra),0) as total_compra FROM Compra WHERE DATE(fecha_hora)=curdate()";
	clearStoredResults();
	$sql = "CALL usp_consulta_compra_totalhoy(@PO_CODE,@PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

public function totalventahoy(){
	//$sql="SELECT IFNULL(SUM(total_venta),0) as total_venta FROM Venta WHERE DATE(fecha_hora)=curdate()";
	clearStoredResults();
	$sql = "CALL usp_consulta_venta_totalhoy(@PO_CODE,@PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

public function comprasultimos_10dias(){
	//$sql=" SELECT CONCAT(DAY(fecha_hora),'-',MONTH(fecha_hora)) AS fecha, SUM(total_compra) AS total FROM Compra GROUP BY fecha_hora ORDER BY fecha_hora DESC LIMIT 0,10";
	clearStoredResults();
	$sql = "CALL usp_consulta_compra_u10dias(@PO_CODE,@PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

public function ventasultimos_12meses(){
	//$sql=" SELECT DATE_FORMAT(fecha_hora,'%M') AS fecha, SUM(total_venta) AS total FROM Venta GROUP BY MONTH(fecha_hora) ORDER BY fecha_hora DESC LIMIT 0,12";
	clearStoredResults();
	$sql = "CALL usp_consulta_venta_u12dias(@PO_CODE,@PO_MESSAGE)";
	return ejecutarConsulta($sql);
}


}
