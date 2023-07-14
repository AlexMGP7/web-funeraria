
<?php


$controllers=array(
	
	'Estado'=>['ListarEstado', 'IngresarEstado', 'IngresarEstado1', 'UpdateEstado', 'UpdateEstado1', 'DeleteEstado']
	// este arreglo ira creciendo a la medida que va creciendo las opciones de menu me mi sistema
);

if (@array_key_exists($controller, $controllers)) {
	
	if (in_array($action, $controllers[$controller])) {
		call($controller, $action);
	}
	else{
		call('Estado','ListarEstado');
	}		
}else{
	
		call('Estado','ListarEstado');
}

function call($controller, $action){
	

	require_once('controllers/'.$controller.'Controller.php');

	switch ($controller) {
		 
		case 'Estado': 
			  $controller= new EstadoController();
			  break;
			 // en este switche habran tantos case como listas del menu se tengan
	}
	
	$controller->{$action}();
}

?>

