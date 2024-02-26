<?php
//Incluimos los ficheros necesarios
include_once 'Response.inc.php';
include_once 'XMLReader.inc.php';
include_once './variablesEntorno.inc.php';

class CatalogoLibros extends ReaderXML {
	private $permitidos = array(
		'id',
		'autor',
		'genero',
		'pagina',
	);

	//Método get
	public function get($parametros) {
		
		foreach ($parametros as $key => $param) {
			
			if (!in_array($key, $this->permitidos)) {
				unset($parametros[$key]);
				
				$response = array(
					'result' => 'error',
					'details' => 'Error en la solicitud'
				);

				Response::result(BAD_REQUEST, $response);
				exit;
			}
		}

		//Llamamos al método obtenerDatos de la clase ReaderXML
		$catalogo = parent::obtenerDatos($parametros);
		return $catalogo;
	}
}
?>