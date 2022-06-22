<?php

class PersonaModelo {

    public $idpersona;
    public $tipo_persona;
    public $nombre;
    public $tipo_documento;
    public $num_documento;
    public $direccion;
    public $telefono;
    public $email;
   
    public function getIdpersona() {
        return $this->idpersona;
    }

    public function getTipo_persona() {
        return $this->tipo_persona;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTipo_documento() {
        return $this->tipo_documento;
    }

    public function getNum_documento() {
        return $this->num_documento;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setIdpersona($idpersona) {
        $this->idpersona = $idpersona;
    }

    public function setTipo_persona($tipo_persona) {
        $this->tipo_persona = $tipo_persona;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setTipo_documento($tipo_documento) {
        $this->tipo_documento = $tipo_documento;
    }

    public function setNum_documento($num_documento) {
        $this->num_documento = $num_documento;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

}
