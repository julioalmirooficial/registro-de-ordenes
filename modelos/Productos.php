<?php
// Clase para manejar la inserción de datos
class Productos
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function insertarProducto(string $descripcion,float $precio)
    {

        $query = "INSERT INTO productos (descripcion, precio) VALUES ('$descripcion',$precio)";

        $resultado = $this->conexion->ejecutarConsulta($query);

        return $resultado;
    }
}
