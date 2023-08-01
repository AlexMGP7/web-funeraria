<?php
$controllers = array(
    'Estado' => ['ListarEstado', 'IngresarEstado', 'UpdateEstado', 'DeleteEstado'],
    'Municipio' => ['ListarMunicipio', 'IngresarMunicipio', 'UpdateMunicipio', 'DeleteMunicipio'],
    'Parroquia' => ['ListarParroquia', 'IngresarParroquia', 'UpdateParroquia', 'DeleteParroquia'],
    'Ciudad' => ['ListarCiudad', 'IngresarCiudad', 'UpdateCiudad', 'DeleteCiudad'],
    'Persona' => ['ListarPersona', 'IngresarPersona', 'UpdatePersona', 'DeletePersona'],
    'PersonaNatural' => ['ListarPersonaN', 'IngresarPersonaN', 'UpdatePersonaN', 'DeletePersonaN'],
    'PersonaJuridica' => ['ListarPersonaJ', 'IngresarPersonaJ', 'UpdatePersonaJ', 'DeletePersonaJ'],
    'Usuario' => ['ListarUsuario', 'IngresarUsuario', 'UpdateUsuario', 'DeleteUsuario'],
    'Cementerio' => ['ListarCementerio', 'IngresarCementerio', 'UpdateCementerio', 'DeleteCementerio'],
    'Difunto' => ['ListarDifunto', 'IngresarDifunto', 'UpdateDifunto', 'DeleteDifunto'],
    'ResponsableJ' => ['ListarResponsableJ', 'IngresarResponsableJ', 'UpdateResponsableJ', 'DeleteResponsableJ'],
    'Funeraria' => ['ListarFuneraria', 'IngresarFuneraria', 'UpdateFuneraria', 'DeleteFuneraria'],
    'ServiciosP' => ['ListarServiciosP', 'IngresarServiciosP', 'UpdateServiciosP', 'DeleteServiciosP'],
    'ServiciosXfuneraria' => ['ListarServiciosXfuneraria', 'IngresarServiciosXfuneraria', 'UpdateServiciosXfuneraria', 'DeleteServiciosXfuneraria']
);

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];

    if (array_key_exists($controller, $controllers) && in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('Usuario', 'ListarUsuario');
    }
} else {
    call('Usuario', 'ListarUsuario');
}

function call($controller, $action)
{
    require_once('../../controllers/' . $controller . '_controller.php');

    switch ($controller) {
        case 'Estado':
            $estadoController = new EstadoController();

            switch ($action) {
                case 'ListarEstado':
                    $estadoController->ListarEstado();
                    break;
                case 'IngresarEstado':
                    $estadoController->IngresarEstado();
                    break;
                case 'UpdateEstado':
                    $estadoController->UpdateEstado();
                    break;
                case 'DeleteEstado':
                    $estadoController->DeleteEstado();
                    break;
                default:
                    $estadoController->ListarEstado();
                    break;
            }
            break;
        case 'Municipio':
            $municipioController = new MunicipioController();

            switch ($action) {
                case 'ListarMunicipio':
                    $municipioController->ListarMunicipio();
                    break;
                case 'IngresarMunicipio':
                    $municipioController->IngresarMunicipio();
                    break;
                case 'UpdateMunicipio':
                    $municipioController->UpdateMunicipio();
                    break;
                case 'DeleteMunicipio':
                    $municipioController->DeleteMunicipio();
                    break;

                default:
                    $municipioController->ListarMunicipio();
                    break;
            }
            break;
        case 'Parroquia':
            $parroquiaController = new ParroquiaController();

            switch ($action) {
                case 'ListarParroquia':
                    $parroquiaController->ListarParroquia();
                    break;
                case 'IngresarParroquia':
                    $parroquiaController->IngresarParroquia();
                    break;
                case 'UpdateParroquia':
                    $parroquiaController->UpdateParroquia();
                    break;
                case 'DeleteParroquia':
                    $parroquiaController->DeleteParroquia();
                    break;
                default:
                    $parroquiaController->ListarParroquia();
                    break;
            }
            break;
        case 'Ciudad':
            $ciudadController = new CiudadController();

            switch ($action) {
                case 'ListarCiudad':
                    $ciudadController->ListarCiudad();
                    break;
                case 'IngresarCiudad':
                    $ciudadController->IngresarCiudad();
                    break;
                case 'UpdateCiudad':
                    $ciudadController->UpdateCiudad();
                    break;
                case 'DeleteCiudad':
                    $ciudadController->DeleteCiudad();
                    break;
                default:
                    $ciudadController->ListarCiudad();
                    break;
            }
            break;
        case 'Persona':
            $personaController = new PersonaController();

            switch ($action) {
                case 'ListarPersona':
                    $personaController->ListarPersona();
                    break;
                case 'IngresarPersona':
                    $personaController->IngresarPersona();
                    break;
                case 'UpdatePersona':
                    $personaController->UpdatePersona();
                    break;
                case 'DeletePersona':
                    $personaController->DeletePersona();
                    break;
                default:
                    $personaController->ListarPersona();
                    break;
            }
            break;
        case 'PersonaNatural':
            $personaNaturalController = new PersonaNaturalController();

            switch ($action) {
                case 'ListarPersonaN':
                    $personaNaturalController->ListarPersonaN();
                    break;
                case 'IngresarPersonaN':
                    $personaNaturalController->IngresarPersonaN();
                    break;
                case 'UpdatePersonaN':
                    $personaNaturalController->UpdatePersonaN();
                    break;
                case 'DeletePersonaN':
                    $personaNaturalController->DeletePersonaN();
                    break;
                default:
                    $personaNaturalController->ListarPersonaN();
                    break;
            }
            break;
        case 'Usuario':
            $usuarioController = new UsuarioController();

            switch ($action) {
                case 'ListarUsuario':
                    $usuarioController->ListarUsuario();
                    break;
                case 'IngresarUsuario':
                    $usuarioController->IngresarUsuario();
                    break;
                case 'UpdateUsuario':
                    $usuarioController->UpdateUsuario();
                    break;
                case 'DeleteUsuario':
                    $usuarioController->DeleteUsuario();
                    break;
                default:
                    $usuarioController->ListarUsuario();
                    break;
            }
            break;
        case 'PersonaJuridica':
            $personaJuridicaController = new PersonaJuridicaController();
            switch ($action) {
                case 'ListarPersonaJ':
                    $personaJuridicaController->ListarPersonaJ();
                    break;
                case 'IngresarPersonaJ':
                    $personaJuridicaController->IngresarPersonaJ();
                    break;
                case 'UpdatePersonaJ':
                    $personaJuridicaController->UpdatePersonaJ();
                    break;
                case 'DeletePersonaJ':
                    $personaJuridicaController->DeletePersonaJ();
                    break;
                default:
                    $personaJuridicaController->ListarPersonaJ();
                    break;
            }
            break;
        case 'Cementerio':
            $cementerioController = new CementerioController();

            switch ($action) {
                case 'ListarCementerio':
                    $cementerioController->ListarCementerios();
                    break;
                case 'IngresarCementerio':
                    $cementerioController->IngresarCementerio();
                    break;
                case 'UpdateCementerio':
                    $cementerioController->UpdateCementerio();
                    break;
                case 'DeleteCementerio':
                    $cementerioController->DeleteCementerio();
                    break;
                default:
                    $cementerioController->ListarCementerios();
                    break;
            }
            break;
        case 'Difunto':
            $difuntoController = new DifuntoController();

            switch ($action) {
                case 'ListarDifunto':
                    $difuntoController->ListarDifuntos();
                    break;
                case 'IngresarDifunto':
                    $difuntoController->IngresarDifunto();
                    break;
                case 'UpdateDifunto':
                    $difuntoController->UpdateDifunto();
                    break;
                case 'DeleteDifunto':
                    $difuntoController->DeleteDifunto();
                    break;
                default:
                    $difuntoController->ListarDifuntos();
                    break;
            }
            break;
        case 'ResponsableJ':
            $responsableJController = new ResponsableJuridicoController();

            switch ($action) {
                case 'ListarResponsableJ':
                    $responsableJController->ListarResponsableJ();
                    break;
                case 'IngresarResponsableJ':
                    $responsableJController->IngresarResponsableJ();
                    break;
                case 'UpdateResponsableJ':
                    $responsableJController->UpdateResponsableJ();
                    break;
                case 'DeleteResponsableJ':
                    $responsableJController->DeleteResponsableJ();
                    break;
                default:
                    $responsableJController->ListarResponsableJ();
                    break;
            }
            break;
        case 'Funeraria':
            $funerariaController = new FunerariaController();

            switch ($action) {
                case 'ListarFuneraria':
                    $funerariaController->ListarFuneraria();
                    break;
                case 'IngresarFuneraria':
                    $funerariaController->IngresarFuneraria();
                    break;
                case 'UpdateFuneraria':
                    $funerariaController->UpdateFuneraria();
                    break;
                case 'DeleteFuneraria':
                    $funerariaController->DeleteFuneraria();
                    break;
                default:
                    $funerariaController->ListarFuneraria();
                    break;
            }
            break;
        case 'ServiciosP':
            $serviciosPController = new ServiciosPController();

            switch ($action) {
                case 'ListarServiciosP':
                    $serviciosPController->ListarServiciosP();
                    break;
                case 'IngresarServiciosP':
                    $serviciosPController->IngresarServicioP();
                    break;
                case 'UpdateServiciosP':
                    $serviciosPController->UpdateServicioP();
                    break;
                case 'DeleteServiciosP':
                    $serviciosPController->DeleteServicioP();
                    break;
                default:
                    $serviciosPController->ListarServiciosP();
                    break;
            }
            break;
        case 'ServiciosXfuneraria':
            $serviciosXfunerariaController = new ServiciosXfunerariaController();

            switch ($action) {
                case 'ListarServiciosXfuneraria':
                    $serviciosXfunerariaController->ListarServiciosXfuneraria();
                    break;
                case 'IngresarServiciosXfuneraria':
                    $serviciosXfunerariaController->IngresarServicioXfuneraria();
                    break;
                case 'UpdateServiciosXfuneraria':
                    $serviciosXfunerariaController->UpdateServicioXfuneraria();
                    break;
                case 'DeleteServiciosXfuneraria':
                    $serviciosXfunerariaController->DeleteServicioXfuneraria();
                    break;
                default:
                    $serviciosXfunerariaController->ListarServiciosXfuneraria();
                    break;
            }
            break;
    }
}
