<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rif = $_POST['rif'];
        $tipo = $_POST['tipo'];

        require_once('../../controllers/funeraria_controller.php');
        $controller = new FunerariaController();
        $result_funeraria = $controller->IngresarFuneraria2($rif, $tipo);
        if ($result_funeraria) {
            $_SESSION['mensaje'] = "La funeraria se ha registrado correctamente.";
            $_SESSION['mensaje_tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al registrar la funeraria. Por favor, intenta nuevamente.";
            $_SESSION['mensaje_tipo'] = "warning";
        }
        // Redirigir a la página de listado de responsables jurídicos después de intentar insertar.
        echo '<script>window.location.href = "?controller=Funeraria&action=ListarFuneraria";</script>';
        exit();
    }

    require_once('../../controllers/personaJuridica_controller.php');
    $persona_juridica_controller = new PersonaJuridicaController();
    $result_persona_juridica = $persona_juridica_controller->ListarPersonaJ1();
?>

<div class="container-i mt-5">
    <div class="page-content">
        <form action="?controller=Funeraria&action=IngresarFuneraria" method="POST">
            <div class="custom-form-background p-4">
                <h4>Ingreso de Funerarias</h4>
                <div class="form-group">
                    <label for="rif"><b>RIF:</b></label>
                    <select class="form-control" name="rif" id="rif" required>
                        <?php
                            while ($row_persona_juridica = mysqli_fetch_array($result_persona_juridica)) {
                                $rif_persona_juridica = $row_persona_juridica['rif'];
                                $nombre_persona_juridica = $row_persona_juridica['nombre'];
                                echo "<option value='$rif_persona_juridica'>$rif_persona_juridica - $nombre_persona_juridica</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo"><b>Tipo:</b></label>
                    <input class="form-control" type="text" name="tipo" id="tipo" maxlength="100" required placeholder="Ingrese aquí el tipo de funeraria" />
                </div>
                <button class="btn btn-success" type="submit">Ingresar</button>
            </div>
        </form>
    </div>
</div>