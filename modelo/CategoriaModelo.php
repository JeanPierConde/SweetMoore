<?php
class CategoriaModelo
{

    public $idcategoria;
    public $nombre;
    public $descripcion;
    public $condicion;

    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getCondicion()
    {
        return $this->condicion;
    }

    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setCondicion($condicion)
    {
        $this->condicion = $condicion;
    }
}
