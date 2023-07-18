<?php
// Clase para manejar la inserción de datos
class Ordenes
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function insertarOrden(int $idProducto, int $idPersona, int $cantidad, float $precio, float $total)
    {

        $query = "INSERT INTO ordenes (idproducto ,idpersona ,cantidad,precio,total) VALUES ($idProducto,$idPersona, $cantidad, $precio,$total)";

        $resultado = $this->conexion->ejecutarConsulta($query);

        return $resultado;
    }
}
