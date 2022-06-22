<?php

class ConsultarVentaModelo {

    public $fecha_inicio;
    public $fecha_fin;
    public $idcliente;
  
    public function getFecha_inicio() {
        return $this->fecha_inicio;
    }

    public function getFecha_fin() {
        return $this->fecha_fin;
    }

    public function getIdcliente() {
        return $this->idcliente;
    }

    public function setFecha_inicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
    }

    public function setFecha_fin($fecha_fin) {
        $this->fecha_fin = $fecha_fin;
    }

    public function setIdcliente($idcliente) {
        $this->idcliente = $idcliente;
    }



}
