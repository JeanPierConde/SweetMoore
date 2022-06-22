<?php

class VentaModelo {

    public $idventa;
    public $idcliente;
    public $idusuario;
    public $tipo_comprobante;
    public $serie_comprobante;
    public $num_comprobante;
    public $fecha_hora;
    public $impuesto;
    public $total_venta;
    public $estado;
    
    public function getIdventa() {
        return $this->idventa;
    }

    public function getIdcliente() {
        return $this->idcliente;
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function getTipo_comprobante() {
        return $this->tipo_comprobante;
    }

    public function getSerie_comprobante() {
        return $this->serie_comprobante;
    }

    public function getNum_comprobante() {
        return $this->num_comprobante;
    }

    public function getFecha_hora() {
        return $this->fecha_hora;
    }

    public function getImpuesto() {
        return $this->impuesto;
    }

    public function getTotal_venta() {
        return $this->total_venta;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setIdventa($idventa) {
        $this->idventa = $idventa;
    }

    public function setIdcliente($idcliente) {
        $this->idcliente = $idcliente;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function setTipo_comprobante($tipo_comprobante) {
        $this->tipo_comprobante = $tipo_comprobante;
    }

    public function setSerie_comprobante($serie_comprobante) {
        $this->serie_comprobante = $serie_comprobante;
    }

    public function setNum_comprobante($num_comprobante) {
        $this->num_comprobante = $num_comprobante;
    }

    public function setFecha_hora($fecha_hora) {
        $this->fecha_hora = $fecha_hora;
    }

    public function setImpuesto($impuesto) {
        $this->impuesto = $impuesto;
    }

    public function setTotal_venta($total_venta) {
        $this->total_venta = $total_venta;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }




}