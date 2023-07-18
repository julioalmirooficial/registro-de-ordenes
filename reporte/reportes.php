<?php
require('../fpdf/fpdf.php');

require_once '../configuraciones/conexion.php';


class PDF extends FPDF
{
    function Header()
    {
        // Logo o título del documento (opcional)
        $this->Image('./logo.png', 10, 10, 30); // Ruta de la imagen, posición x, posición y, tamaño
        $this->SetFont('Arial', 'B', 12); // Fuente: Arial, negrita, tamaño 12
        $this->Cell(0, 10, 'Listado de pedidos de personas', 0, 1, 'C'); // Título centrado en negrita

        // Información adicional del encabezado (opcional)
        $this->SetFont('Arial', '', 10); // Fuente: Arial, tamaño 10
        $this->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R'); // Fecha actual alineada a la derecha
    }

    function Footer()
    {
        // Posición en centímetros desde el borde inferior de la página
        $this->SetY(-1.5);
        // Fuente Arial tamaño 8
        $this->SetFont('Arial', '', 8);
        // Número de página
        $this->Cell(0, 10, utf8_encode('Pagina') . $this->PageNo() . ' de {nb}', 0, 0, 'C');
    }

    function generarPDF()
    {
        
        // Crear página
        $this->AddPage();

        // Contenido del PDF
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, utf8_encode('Reporte de pedidos'), 0, 1, 'C');

        // Otro contenido y personalización del PDF...



        // Cabecera de la tabla
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 10, 'Persona', 1);
        $this->Cell(60, 10, 'Productos', 1);
        $this->Cell(30, 10, 'Cantidad', 1);
        $this->Cell(30, 10, 'Precio', 1);
        $this->Cell(30, 10, 'Total', 1);
        $this->Ln(); // Salto de línea




        $conexion = new Conexion();
        $conexion->obtenerConexion();
        $registros = $conexion->obtenerOrdenes();


        // Datos de los registros
        $this->SetFont('Arial', '', 12);
        foreach ($registros as $registro) {
            $this->Cell(40, 10, $registro['nombres'], 1);
            $this->Cell(60, 10, $registro['descripcion'], 1);
            $this->Cell(30, 10, $registro['cantidad'], 1);
            $this->Cell(30, 10, $registro['precio'], 1);
            $this->Cell(30, 10, $registro['total'], 1);
            $this->Ln(); // Salto de línea
        }
    }
}

// Crear instancia de la clase PDF
$pdf = new PDF();

// Generar PDF
$pdf->generarPDF();

// Salida del PDF (mostrar en el navegador o guardar en un archivo)
$pdf->Output();

// $pdf->Output('ruta/archivo.pdf', 'F'); 