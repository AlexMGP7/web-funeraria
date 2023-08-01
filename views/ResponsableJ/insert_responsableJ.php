 <?php
    // Verificar si se han enviado los datos del formulario a través de POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario
        $rif = $_POST['rif'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $razon_social = $_POST['razon_social'];

        //echo $rif,$correo,$telefono,$razon_social;

        require_once('../../controllers/responsableJ_controller.php');
        $controller = new ResponsableJuridicoController();
        // Insertar el responsable jurídico y obtener el resultado
        $result_responsable_juridico = $controller->IngresarResponsableJ2($rif, $correo, $telefono, $razon_social);
        // Verificar si el insert fue exitoso
        if ($result_responsable_juridico) {
            $_SESSION['mensaje'] = "El responsable jurídico se ha registrado correctamente.";
            $_SESSION['mensaje_tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al registrar el responsable jurídico. Por favor, intenta nuevamente.";
            $_SESSION['mensaje_tipo'] = "warning";
        }
        // Redirigir a la página de listado de responsables jurídicos después de intentar insertar.
        echo '<script>window.location.href = "?controller=ResponsableJ&action=ListarResponsableJ";</script>';
        exit();
    }

    require_once('../../controllers/personaJuridica_controller.php');
    $persona_juridica_controller = new PersonaJuridicaController();
    $result_persona_juridica = $persona_juridica_controller->ListarPersonaJ1();

    ?>
 <div class="container-i mt-5">
     <div class="page-content">
         <form action="?controller=ResponsableJ&action=IngresarResponsableJ" method="POST">
             <div class="custom-form-background p-4">
                 <h4>Ingreso de Responsables Jurídicos</h4>
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
                     <label for="correo"><b>Correo:</b></label>
                     <input class="form-control" type="email" name="correo" id="correo" maxlength="100" required placeholder="Ingrese aquí el correo del responsable jurídico" />
                 </div>
                 <div class="form-group">
                    <label class="telefono">Teléfono</label>
                    <div class="input-group">
                        <select class="input-group select-custom" name="codigo_telefono" id="codigo_telefono" required>
                            <option value="0414">0414</option>
                            <option value="0424">0424</option>
                            <option value="0416">0416</option>
                            <option value="0426">0426</option>
                            <option value="0412">0412</option>
                        </select>
                        <input class="form-control" type="text" name="telefono" id="telefono" pattern="[0-9]{7}" maxlength="7" required placeholder="Ingrese aquí el resto del número" />
                    </div>
                </div>
                 <div class="form-group">
                     <label for="razon_social"><b>Razón Social:</b></label>
                     <input class="form-control" type="text" name="razon_social" id="razon_social" maxlength="100" required placeholder="Ingrese aquí la razón social del responsable jurídico" />
                 </div>
                 <button class="btn btn-success" type="submit">Ingresar</button>
             </div>
         </form>
     </div>
 </div>