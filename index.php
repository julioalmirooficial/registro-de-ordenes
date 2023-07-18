<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva orden</title>
    <link rel="stylesheet" href="./styles/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" href="./styles/bootstrap/js/bootstrap.js">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    require './componentes/menu.php';
    require './configuraciones/conexion.php';

    $conexion = new Conexion();
    $conexion->obtenerConexion();
    ?>

    <div class="container">
        <h1 class="fs-3 mt-4 text-primary">Listado de producto comprados por el usuario</h1>

        <?php
        require './componentes/modalPedidos.php';

        require_once './configuraciones/conexion.php';


        $conexion = new Conexion();
        $conexion->obtenerConexion();
        $registros = $conexion->obtenerOrdenes();
        ?>
        <a href="reporte/reportes.php" class="btn btn-success mt-3" target="_blank">
            Expotar
        </a>
        <div class="mt-3">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">Persona</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $registro) : ?>
                        <tr>
                            <td><?php echo $registro['nombres']; ?></td>
                            <td><?php echo $registro['descripcion']; ?></td>
                            <td><?php echo $registro['cantidad']; ?></td>
                            <td><?php echo $registro['precio']; ?></td>
                            <td><?php echo $registro['total']; ?></td>
                        </tr>
                    <?php
                    endforeach;
                    $conexion->cerrarConexion();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>