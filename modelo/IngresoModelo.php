<?php

class IngresoModelo
{

    public $idingreso;
    public $idproveedor;
    public $idusuario;
    public $tipo_comprobante;
    public $serie_comprobante;
    public $num_comprobante;
    public $fecha_hora;
    public $impuestos;
    public $total_compra;
    public $estado;

    public function getIdingreso() {
        return $this->idingreso;
    }

    public function getIdproveedor() {
        return $this->idproveedor;
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

    public function getImpuestos() {
        return $this->impuestos;
    }

    public function getTotal_compra() {
        return $this->total_compra;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setIdingreso($idingreso) {
        $this->idingreso = $idingreso;
    }

    public function setIdproveedor($idproveedor) {
        $this->idproveedor = $idproveedor;
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

    public function setImpuestos($impuestos) {
        $this->impuestos = $impuestos;
    }

    public function setTotal_compra($total_compra) {
        $this->total_compra = $total_compra;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }


}
