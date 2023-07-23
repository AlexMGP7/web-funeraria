<?php

require_once('../../controllers/municipio_controller.php');
$controller = new MunicipioController();
$result_municipio = $controller->BuscarUltimoMunicipio();
$numrows = mysqli_num_rows($result_municipio);

?>

<div class="container">
    <div class="page-content">
        <form action="?controller=Municipio&action=IngresarMunicipio1" method="POST">
            <div class="col-12">
                <br>
                <h4>Ingreso de Municipios</h4>
                <br>
                <div class="alert alert-success">
                    <label for="codigo_municipio" align="right" size="40"><b>Municipio:</b></label>
                    <input class="form-control mr-sm-2" type="text" name="codigo_municipio" id="codigo_municipio" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese aqui el codigo del Municipio" />
                    <span class="text-black">Solo se permiten números.</span>
                    <br>
                    <label for="descripcion" align="right"><b>Descripción:</b></label>
                    <textarea class="form-control" maxlength="200" placeholder="Ingrese aquí la descripción del municipio" id="descripcion" name="descripcion" rows="4" required></textarea>
                    <br>
                    <label for="estado_codigo" align="right"><b>Estado:</b></label>
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
                    <br>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ingresar</button>
                </div>
            </div>
        </form>
    </div>
    <br>
</div>