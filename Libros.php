<?php
//Incluimos los ficheros necesarios
include_once 'Clases/Response.inc.php';
include_once 'Clases/CatalogoLibros.inc.php';
include_once 'variablesEntorno.inc.php';


$libros = new CatalogoLibros();

switch ($_SERVER['REQUEST_METHOD']) {

	//Si el método es GET
	case 'GET':
		$params = $_GET;
		$catalogo = $libros->get($params);
		$response = array('catalogo' => $catalogo);

		//Se devuelve la respuesta
		Response::result(SUCCESS, $response); 
		break;

	default:
		$response = array('result' => 'error');
		
		//Se devuelve la respuesta
		Response::result(RESOURCE_NO_FOUND, $response);
		break;
}
?>