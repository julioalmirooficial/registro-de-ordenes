<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de productos</title>
    <link rel="stylesheet" href="./styles/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" href="./styles/bootstrap/js/bootstrap.js">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    require './componentes/menu.php'
    ?>

    <div class="container">

        <?php
        require './componentes/modalProductos.php';

        require_once './configuraciones/conexion.php';


        $conexion = new Conexion();
        $conexion->obtenerConexion();
        $registros = $conexion->obtenerRegistros('productos');
        ?>

        <h1 class="fs-3 mt-4 text-primary">Listado de productos</h1>
        <div class="mt-3">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $registro) : ?>
                        <tr>
                            <td><?php echo $registro['descripcion']; ?></td>
                            <td><?php echo $registro['precio']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <?php

                $conexion->cerrarConexion();
                ?>
            </table>
        </div>
    </div>

</body>

</html>