<?php
// Incluye el archivo que contiene la clase Conexion y otras configuraciones
require_once '../configuraciones/conexion.php';
require_once '../modelos/Ordenes.php';


// Creamos una instancia de la clase Conexion
$conexion = new Conexion();

// Conectamos a la base de datos
$conexion->obtenerConexion();

// Creamos una instancia de la clase Personas y le pasamos la conexión
$personas = new Ordenes($conexion);

// Procesamos el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $idProducto = $_POST["idProducto"];
    $idPersona = $_POST["idPersona"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];
    $total = $_POST["total"];

    // Insertamos la persona en la base de datos
    $resultado = $personas->insertarOrden(intval($idProducto), intval($idPersona), intval($cantidad), floatval($precio), floatval($total));

    // Verificar si la inserción fue exitosa y mostrar un mensaje al usuario
    if ($resultado) {
        echo "Registro insertado correctamente.";
        header('Location: ../');
    } else {
        echo "Hubo un error al insertar el registro.";
    }
}

// Cerramos la conexión cuando ya no sea necesaria
$conexion->cerrarConexion();
