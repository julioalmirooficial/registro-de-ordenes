<?php 
// Clase para manejar la inserción de datos
class Persona
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function insertarPersona($nombre)
    {

        // Query para insertar el nuevo registro
        $query = "INSERT INTO personas (nombres) VALUES ('$nombre')";

        // Ejecutar la consulta
        $resultado = $this->conexion->ejecutarConsulta($query);

        // Retornar el resultado (puede ser útil para saber si la inserción fue exitosa)
        return $resultado;
    }
}
