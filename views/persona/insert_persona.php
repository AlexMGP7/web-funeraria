<?php
require_once('../../controllers/persona_controller.php');
$controller = new PersonaController();
$result_persona = $controller->BuscarUltimaPersona();
$numrows = mysqli_num_rows($result_persona);
?>

<div class="container">
    <div class="page-content">
        <form action="?controller=Persona&action=IngresarPersona1" method="POST">
            <br>
            <h4>Ingreso de Personas</h4>
            <br>
            <div class="alert alert-success">
                <label for="cedula" align="right"><b>Cédula:</b></label>
                <input class="form-control mr-sm-2" type="text" name="cedula" id="cedula" pattern="[0-9]+" maxlength="10" required placeholder="Ingrese aquí la cédula de la Persona" />
                <span class="text-black">Solo se permiten números.</span>
                <br>
                <label for="nombre" align="right"><b>Nombre:</b></label>
                <input class="form-control mr-sm-2" type="text" name="nombre" id="nombre" maxlength="50" required placeholder="Ingrese aquí el nombre de la Persona" />
                <br>
                <label for="apellido" align="right"><b>Apellido:</b></label>
                <input class="form-control mr-sm-2" type="text" name="apellido" id="apellido" maxlength="50" required placeholder="Ingrese aquí el apellido de la Persona" />
                <br>
                <label for="ciudad_codigo" align="right"><b>Ciudad Código:</b></label>
                <input class="form-control mr-sm-2" type="text" name="ciudad_codigo" id="ciudad_codigo" pattern="[0-9]+" maxlength="5" required placeholder="Ingrese aquí el código de la Ciudad" />
                <span class="text-black">Solo se permiten números.</span>
                <br>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ingresar</button>
            </div>
        </form>
    </div>
</div>
