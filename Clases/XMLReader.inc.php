<?php
class ReaderXML {
	//Atributos
	private $tipo = null;
	private $valor = null;
	
	//Getters y Setters
	public function getTipo(){
		return $this->tipo;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}

	public function getValor(){
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}


	//Metodos
	//Funcion que lee el fichero
	private function leer() {
		$libros = [];
		if (!$xml = simplexml_load_file(__DIR__ . '/books.xml')) {
			echo "No se ha podido cargar el archivo";
		} else {
			foreach ($xml as $libro) {
				$libros[] = [
					'id' => (string) $libro['id'],
					'autor' => (string) $libro->author,
					'titulo' => (string) $libro->title,
					'genero' => (string) $libro->genre,
					'precio' => (float) $libro->price,
					'año de publicación' => (string) $libro->publish_date,
					'descripción' => (string) $libro->description,
				];
			}
		}
		return $libros;
	}

	//Funcion que obtiene los datos
	public function obtenerDatos($param = null) {		
		$libros = $this->leer();
		
		if ($param != null) {
			foreach ($param as $key => $data) {
				$this->setTipo($key);
				$this->setValor($data);
			}
			
			if ($this->getTipo() == 'pagina') {
				if ($this->getValor() > 0 && $this->getValor() < count($libros) +1) {
					$arrayDatos = [];
					for ($i = $this->getValor() - 1; $i >= 0; $i--) {
						array_push($arrayDatos, $libros[$i]);
					}
					return array_reverse($arrayDatos);
				} else {
					return []; 
				}

			} else {
				if ($this->getTipo() != null && $this->getValor() != null) {
					$arrayDatos = [];
					foreach ($libros as $libro) {
						if ($libro[$this->getTipo()] == $this->getValor()) {
							array_push($arrayDatos, $libro);
						}
					}
					return $arrayDatos;
				} else {
					return $libros;
				}
			}

		} else {
			return $libros;
		}
	}
}
?>