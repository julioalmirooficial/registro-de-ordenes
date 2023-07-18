<?php
require_once './configuraciones/conexion.php';

$conexion = new Conexion();
$conexion->obtenerConexion();
$personas = $conexion->obtenerRegistros('personas');
$productos = $conexion->obtenerRegistros('productos');
$conexion->cerrarConexion();
?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Nuevo registro
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de nuevas ordenes</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./controlador/Ordenes.php" method="POST">
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="idPersona">
                            <option selected>Selecciona la persona</option>
                            <?php
                            foreach ($personas as $registro) : ?>
                                <option value="<?php echo $registro['id']; ?>"><?php echo $registro['nombres']; ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" id="productos">
                            <option selected>Selecciona tus productos</option>
                            <?php
                            foreach ($productos as $registro) : ?>
                                <option value="<?php echo $registro['id'] . '|' . $registro['precio']; ?>">
                                    <?php echo $registro['descripcion']; ?>
                                </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" id="cantidad" placeholder="Cantidad" value="1">
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" name="total" class="form-control" id="total" placeholder="Total" readonly>
                    </div>
                    <input type="number" name="precio" class="form-control" id="precio" hidden value="">
                    <input type="number" name="idProducto" class="form-control" id="idProducto" hidden value="">

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    const select = document.getElementById('productos');

    const precio = document.getElementById('precio')
    const id = document.getElementById('idProducto')
    const cantidad = document.getElementById('cantidad')
    const total = document.getElementById('total')

    const calcularImporte = function(cantidad, precio) {
        const importe = parseInt(cantidad) * parseFloat(precio)
        total.value = importe

    }

    select.addEventListener('change', function() {

        const datos = select.value
        const datosDelSelect = datos.split('|');

        id.value = datosDelSelect[0]
        precio.value = datosDelSelect[1]

        calcularImporte(cantidad.value, datosDelSelect[1])

        cantidad.addEventListener('keyup', function() {
            calcularImporte(cantidad.value, datosDelSelect[1])
        })


    })
</script>