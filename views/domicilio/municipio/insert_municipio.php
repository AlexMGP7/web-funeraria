<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
}

require_once('../../controllers/municipio_controller.php');
$controller = new MunicipioController();
$result_municipio = $controller->BuscarUltimoMunicipio();
$numrows = mysqli_num_rows($result_municipio);

?>

<div class="container-i mt-5">
    <div class="page-content">
        <form action="?controller=Municipio&action=IngresarMunicipio1" method="POST">
            <div class="custom-form-background p-4">
                <div class="form-group">
                    <h4 class="mb-4">Ingreso de Municipios</h4>
                    <label for="codigo_municipio"><b>Municipio:</b></label>
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
