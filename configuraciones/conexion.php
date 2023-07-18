<?php

class Conexion
{
    private $conexion;
    
    private string $host = 'localhost';
    private string $username = 'root';
    private string $password = '123456';
    private string $dbname = 'yeni';

    public function __construct()
    {

        $this->conexion = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conexion->connect_error) {
            die('Error de conexión: ' . $this->conexion->connect_error);
        }
    }

    public function obtenerConexion()
    {
        return $this->conexion;
    }




    public function cerrarConexion()
    {
        if ($this->conexion) {
            $this->conexion->close();
            $this->conexion = null;
        }
    }



    public function ejecutarConsulta($query)
    {
        if (!$this->conexion) {
            $this->obtenerConexion();
        }

        $result = $this->conexion->query($query);

        if (!$result) {
            return "error";
        }

        return "registrado";
    }

    
    /**
     * Metodo para lidas datos
     * @param string nombre la de la tabla
     */

    public function obtenerRegistros($tabla)
    {
        $query = "SELECT * FROM $tabla";
        $resultados = $this->conexion->query($query);

        if (!$resultados) {
            die('Error en la consulta: ' . $this->conexion->error);
        }

        $registros = [];
        while ($fila = $resultados->fetch_assoc()) {
            $registros[] = $fila;
        }

        return $registros;
    }



    
    public function obtenerOrdenes()
    {
        $query = "SELECT o.cantidad, o.precio, o.total, p.descripcion, u.nombres 
         FROM ordenes o 
        INNER JOIN productos p ON p.id = o.idproducto
        INNER JOIN personas u ON u.id = o.idpersona
        ORDER BY o.id DESC
        ";
        $resultados = $this->conexion->query($query);

        if (!$resultados) {
            die('Error en la consulta: ' . $this->conexion->error);
        }

        $registros = [];
        while ($fila = $resultados->fetch_assoc()) {
            $registros[] = $fila;
        }

        return $registros;
    }
}
