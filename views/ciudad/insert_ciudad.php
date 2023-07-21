<?php

require_once('../../controllers/ciudad_controller.php');
$controller = new CiudadController();
$result_parroquia = $controller->BuscarUltimaCiudad();
$numrows = mysqli_num_rows($result_parroquia);

?>

<div class="container">
    <div class="page-content">
        <form action="?controller=Ciudad&action=IngresarCiudad1" method="POST">
            <div class="col-12">
                <br>
                <h4>Ingreso de Ciudades</h4>
                <br>
                <div class="alert alert-success">
                    <div class="row">
                        <div class="col-6">
                            <label for="codigo_ciudad" align="right" size="40"><b>Codigo de la ciudad:</b></label>
                            <input class="form-control mr-sm-2" type="text" name="codigo_ciudad" id="codigo_ciudad" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese el código de la ciudad" />
                            <span class="text-black">Solo se permiten números.</span>
                            <br>
                            <label for="descripcion" align="right"><b>Descripción:</b></label>
                            <textarea class="form-control" maxlength="200" placeholder="Ingrese aquí la descripción de la ciudad" id="descripcion" name="descripcion" rows="4" required></textarea>
                            <br>
                            <label for="estado_codigo" align="right"><b>Código del Estado:</b></label>
                            <select class="form-control" name="estado_codigo" id="estado_codigo" required>
                                <?php
                                $result_estados = $controller->ListarEstados();

                                while ($row_estado = mysqli_fetch_array($result_estados)) {
                                    $codigo_estado = $row_estado['codigo'];
                                    $descripcion_estado = $row_estado['descripcion'];
                                    echo "<option value='$codigo_estado'>$codigo_estado - $descripcion_estado</option>";
                                }
                                ?>
                            </select>
                            <br>
                            <label for="municipio_codigo" align="right"><b>Código del Municipio:</b></label>
                            <select class="form-control" name="municipio_codigo" id="municipio_codigo" required>
                                <?php
                                $result_municipios = $controller->ListarMunicipios();

                                while ($row_municipio = mysqli_fetch_array($result_municipios)) {
                                    $codigo_municipio = $row_municipio['codigo'];
                                    $descripcion_municipio = $row_municipio['descripcion'];
                                    echo "<option value='$codigo_municipio'>$codigo_municipio - $descripcion_municipio</option>";
                                }
                                ?>
                            </select>
                            <br>
                            <label for="parroquia_codigo" align="right"><b>Código de la Parroquia:</b></label>
                            <select class="form-control" name="parroquia_codigo" id="parroquia_codigo" required>
                                <?php
                                $controller = new CiudadController();
                                $result_parroquias = $controller->ListarParroquias();

                                while ($row_parroquia = mysqli_fetch_array($result_parroquias)) {
                                    $codigo_parroquia = $row_parroquia['codigo'];
                                    $descripcion_parroquia = $row_parroquia['descripcion'];
                                    echo "<option value='$codigo_parroquia'>$codigo_parroquia - $descripcion_parroquia</option>";
                                }
                                ?>
                            </select>
                            <br>


                        </div>
                    </div>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ingresar</button>
                </div>
            </div>
        </form>
    </div>
    <br>
</div>