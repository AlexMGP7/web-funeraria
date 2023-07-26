<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit(); // Salir para evitar cargar el formulario si el usuario no ha iniciado sesión.
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si el formulario ha sido enviado (se verifica por el método POST), procesar la lógica de inserción.

    // Obtener el código, descripción y estado del municipio enviados a través del formulario de inserción.
    $codigo = $_POST['codigo_municipio'];
    $descripcion = $_POST['descripcion'];
    $estado_codigo = $_POST['estado_codigo'];

    require_once('../../controllers/municipio_controller.php');
    $controller = new MunicipioController();

    // Intentar insertar el nuevo municipio utilizando el método 'IngresarMunicipio2' del controlador.
    $result_municipio = $controller->IngresarMunicipio2($codigo, $descripcion, $estado_codigo);

    if ($result_municipio) {
        // Si la inserción fue exitosa, mostrar un mensaje de éxito.
        $_SESSION['mensaje'] = "El municipio se ha registrado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";

        // Redirigir a la página de listado de municipios después de intentar insertar.
        echo '<script>window.location.href = "?controller=Municipio&action=ListarMunicipio";</script>';
        exit();
    } else {
        // Si la inserción falló, mostrar un mensaje de advertencia.
        $_SESSION['mensaje'] = "Error: No se pudo registrar el municipio.";
        $_SESSION['mensaje_tipo'] = "warning";
    }
}

?>

<div class="container-i mt-5">
    <div class="page-content">
        <form action="?controller=Municipio&action=IngresarMunicipio" method="POST">
            <div class="custom-form-background p-4">
                <div class="form-group">
                    <h4 class="mb-4">Ingreso de Municipios</h4>
                    <label for="codigo_municipio"><b>Codigo de Municipio:</b></label>
                    <input class="form-control" type="text" name="codigo_municipio" id="codigo_municipio" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese aquí el código del Municipio" />
                    <small class="form-text text-muted">Solo se permiten números.</small>
                </div>
                <div class="form-group">
                    <label for="descripcion"><b>Descripción:</b></label>
                    <textarea class="form-control" maxlength="200" placeholder="Ingrese aquí la descripción del municipio" id="descripcion" name="descripcion" required></textarea>
                </div>
                <div class="form-group">
                    <label for="estado_codigo"><b>Estado:</b></label>
                    <select class="form-control" name="estado_codigo" id="estado_codigo" required>
                        <?php
                        $controller = new MunicipioController();
                        $result_estados = $controller->ListarEstados();

                        while ($row_estado = mysqli_fetch_array($result_estados)) {
                            $codigo_estado = $row_estado['codigo'];
                            $descripcion_estado = $row_estado['descripcion'];
                            echo "<option value='$codigo_estado'>$codigo_estado - $descripcion_estado</option>";
                        }
                        ?>
                    </select>
                </div>
                <button class="btn btn-success" type="submit">Ingresar</button>
            </div>
        </form>
    </div>
</div>
