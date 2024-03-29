<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de inserción.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el código, la descripción y el código de municipio enviados a través del formulario.
    $codigo = $_POST['codigo_parroquia'];
    $descripcion = $_POST['descripcion'];
    $municipio_codigo = $_POST['municipio_codigo'];

    require_once('../../controllers/parroquia_controller.php');
    $controller = new ParroquiaController();

    // Intentar insertar la nueva parroquia utilizando el método 'IngresarParroquia2' del controlador.
    $result_parroquia = $controller->IngresarParroquia2($codigo, $descripcion, $municipio_codigo);

    if ($result_parroquia) {
        // Si la inserción fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "La parroquia se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        // Si la inserción falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo registrar la parroquia.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
    // Redirigir a la página de listado de parroquias después de intentar insertar.
    echo '<script>window.location.href = "?controller=Parroquia&action=ListarParroquia";</script>';
    exit();
}
?>

<div class="container-i mt-5">
    <form action="?controller=Parroquia&action=IngresarParroquia" method="POST">
        <div class="custom-form-background p-4">
            <h4 class="mb-4">Ingreso de Parroquias</h4>
            <div class="form-group">
                <label for="codigo_parroquia"><b>Codigo de la Parroquia:</b></label>
                <input class="form-control" type="text" name="codigo_parroquia" id="codigo_parroquia" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese aquí el código de la parroquia" />
                <small class="form-text text-muted">Solo se permiten números.</small>
            </div>
            <div class="form-group">
                <label for="descripcion"><b>Descripción:</b></label>
                <textarea class="form-control" maxlength="200" placeholder="Ingrese aquí la descripción de la parroquia" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="form-group">
                        <label for="estado_codigo"><b>Estado:</b></label>
                        <select class="form-control" name="estado_codigo" id="estado_codigo" required>
                            <?php
                            $controller = new ParroquiaController();
                            $result_estados = $controller->ListarEstados();

                            while ($row_estado = mysqli_fetch_array($result_estados)) {
                                $codigo_estado = $row_estado['codigo'];
                                $descripcion_estado = $row_estado['descripcion'];
                                $selected = ($codigo_estado == $estado_codigo) ? 'selected' : '';
                                echo "<option value='$codigo_estado' $selected>$codigo_estado - $descripcion_estado</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="municipio_codigo"><b>Municipio:</b></label>
                        <select class="form-control" id="municipio_codigo" name="municipio_codigo" required>
                        </select>
                    </div>
            <button class="btn btn-success" type="submit">Ingresar</button>
        </div>
    </form>
</div>
