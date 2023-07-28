<?php

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}

// Verificar si se han enviado los datos del formulario a través de POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $rif = $_POST['rif'];
    $nombre = $_POST['nombre'];
    $ciudadCodigo = $_POST['ciudad_codigo'];

    require_once('../../controllers/personaJuridica_controller.php');
    $controller = new PersonaJuridicaController();

    // Actualizar la persona jurídica y obtener el resultado
    $result_persona_juridica = $controller->UpdatePersonaJ2($rif, $nombre, $ciudadCodigo);

    // Verificar si la actualización fue exitosa
    if ($result_persona_juridica) {
        $_SESSION['mensaje'] = "La persona jurídica se ha actualizado correctamente.";
        $_SESSION['mensaje_tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la persona jurídica. Por favor, intenta nuevamente.";
        $_SESSION['mensaje_tipo'] = "warning";
    }

    // Redirigir a la página de listado de personas jurídicas después de intentar actualizar.
    echo '<script>window.location.href = "?controller=PersonaJuridica&action=ListarPersonaJ";</script>';
    exit();
}

if (isset($_GET['i'])) {
    $rif = $_GET['i'];
    require_once('../../controllers/personaJuridica_controller.php');
    $controller = new PersonaJuridicaController();
    $result_persona_juridica = $controller->BuscarPersonaJByRif($rif);
    $numrows = mysqli_num_rows($result_persona_juridica);

    if ($numrows != 0) {
        while ($row = mysqli_fetch_array($result_persona_juridica)) {
            // Extract data
            if (isset($row["rif"])) {
                $rif = $row["rif"];
            }
            if (isset($row["nombre"])) {
                $nombre = $row["nombre"];
            }
            if (isset($row["Ciudad_Codigo"])) {
                $ciudad_codigo = $row["Ciudad_Codigo"];
            }
        }
?>
        <div class="container-i mt-5">
            <div class="page-content">
                <form action="?controller=PersonaJuridica&action=UpdatePersonaJ" method="POST">
                    <div class="custom-form-background p-4">
                        <h4>Actualización de Persona Jurídica</h4>
                        <div class="form-group">
                            <label for="rif"><b>RIF:</b></label>
                            <input class="form-control" type="text" name="rif" value="<?php echo $rif; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nombre"><b>Nombre:</b></label>
                            <input class="form-control" type="text" name="nombre" value="<?php echo $nombre; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="ciudad_codigo"><b>Ciudad Código:</b></label>
                            <select class="form-control" name="ciudad_codigo" id="ciudad_codigo" required>
                                <?php
                                $controller = new PersonaJuridicaController();
                                $result_ciudad = $controller->ListarCiudades();

                                while ($row_ciudad = mysqli_fetch_array($result_ciudad)) {
                                    $codigo_ciudad = $row_ciudad['codigo'];
                                    $descripcion_ciudad = $row_ciudad['descripcion'];
                                    echo "<option value='$codigo_ciudad'>$codigo_ciudad - $descripcion_ciudad</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Add other fields related to Persona Juridica table here -->

                        <button class="btn btn-success" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
<?php
    } else {
        // If Persona Juridica not found, redirect to the list of personas juridicas
        require_once('../../views/persona_juridica/list_persona_juridica.php');
    }
} else {
    // If 'i' parameter not provided in the URL, redirect to the list of personas juridicas
    require_once('../../views/persona_juridica/list_persona_juridica.php');
}
?>
