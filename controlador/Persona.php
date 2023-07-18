<?php
// Incluye el archivo que contiene la clase Conexion y otras configuraciones
require_once '../configuraciones/conexion.php';
require_once '../modelos/Persona.php';


// Creamos una instancia de la clase Conexion
$conexion = new Conexion();

// Conectamos a la base de datos
$conexion->obtenerConexion();

// Creamos una instancia de la clase Personas y le pasamos la conexión
$personas = new Persona($conexion);

// Procesamos el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtenemos el nombre enviado desde el formulario
    $nombre = $_POST["nombres"];

    // Insertamos la persona en la base de datos
    $resultado = $personas->insertarPersona($nombre);

    // Verificar si la inserción fue exitosa y mostrar un mensaje al usuario
    if ($resultado) {
        echo "Registro insertado correctamente.";
        header('Location: ../registrarPersona.php');
    } else {
        echo "Hubo un error al insertar el registro.";
    }
}

// Cerramos la conexión cuando ya no sea necesaria
$conexion->cerrarConexion();
