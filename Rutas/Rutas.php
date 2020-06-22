<?php

class Rutas{

	public function BuscarRuta(){
		// Obtenemos las rutas en un array
		$RutasRecibidas = explode("/", $_SERVER['REQUEST_URI']);

		// Definimos las rutas
		$RutasDefinidas = array("api",
								"gui",
								"intensidades",
								"canales");

		// Array que contendrá la ruta en que estamos trabajando, se inicializa null por que se buscará en la uri para después hacer el debido desvío.
		$InformacionURI = array("RutaUtilizar" => null,
								"ID" => null);

		// Comparamos la información del array que contiene las rutas definidas con el array que trae la respuesta del servidor
		for($ContadorRutasRecibidas = 0; $ContadorRutasRecibidas < count($RutasRecibidas); $ContadorRutasRecibidas++){
			for($ContadorRutasDefinidas = 0; $ContadorRutasDefinidas < count($RutasDefinidas); $ContadorRutasDefinidas++){
				if($RutasDefinidas[$ContadorRutasDefinidas] == strtolower($RutasRecibidas[$ContadorRutasRecibidas])){
					// Guardamos la ruta con la que estamos ingresando desde le URI
					$InformacionURI["RutaUtilizar"] = $RutasDefinidas[$ContadorRutasDefinidas];
					// Como ya tenemos la ruta, vamos a buscar si le sigue un ID a la ruta.
					// Creamos una variable temporal para poder obtener la posición actual y usar la siguiente
					$Temporal = $ContadorRutasRecibidas;
					$Temporal += 1;
					if ($Temporal != count($RutasRecibidas)){
						if(is_numeric($RutasRecibidas[$Temporal])){
							// Guardamos el id con el que necesitamos trabajar
							$InformacionURI["ID"] = $RutasRecibidas[$Temporal];
						}else{
							$InformacionURI["RutaUtilizar"] = null;
							$InformacionURI["ID"] = null;
						}
					}
					
				}
			}
		}

		
		// Luego con condiciones lo redirigimos
		if($InformacionURI["RutaUtilizar"] == ""){
			// Saltamos a la página principal
			header("Location: guiPrincipal.html");
			// Preparamos el Json
            /*$json = array(
                "status" => 404,
                "detalle" => "No encontrado"
             );

            header('Content-Type: application/json');
            echo json_encode($json);*/
		}
			elseif ($InformacionURI["RutaUtilizar"] == "api") {
				// Si estamos recibiendo un verbo en la url vamos a verificar a cual lo redirigimos
				if(isset($_SERVER["REQUEST_METHOD"])){
					// Con un Switch bucaremos el verbo
					switch ($_SERVER["REQUEST_METHOD"]) {
						case "GET":
							//echo "Hola Mundo";
							$Mostrar = new ObtenerDatosControlador();
							$Mostrar->mostrar();
							break;
					}
				}
			}
			elseif ($InformacionURI["RutaUtilizar"] == "gui") {
				// Si estamos recibiendo un verbo en la url vamos a verificar a cual lo redirigimos
				if(isset($_SERVER["REQUEST_METHOD"])){
					// Con un Switch bucaremos el verbo
					switch ($_SERVER["REQUEST_METHOD"]) {
						case "GET":
							header("Location: guiPrincipal.html");
							break;
					}
				}
			}
			elseif ($InformacionURI["RutaUtilizar"] == "intensidades") {
				// Si estamos recibiendo un verbo en la url vamos a verificar a cual lo redirigimos
				if(isset($_SERVER["REQUEST_METHOD"])){
					// Con un Switch bucaremos el verbo
					switch ($_SERVER["REQUEST_METHOD"]) {
						case "GET":
							//echo "Hola Mundo";
							$Mostrar = new ObtenerDatosControlador();
							$Mostrar->datosChart();
							break;
					}
				}
			}
			elseif ($InformacionURI["RutaUtilizar"] == "intensidades") {
				// Si estamos recibiendo un verbo en la url vamos a verificar a cual lo redirigimos
				if(isset($_SERVER["REQUEST_METHOD"])){
					// Con un Switch bucaremos el verbo
					switch ($_SERVER["REQUEST_METHOD"]) {
						case "GET":
							//echo "Hola Mundo";
							$Mostrar = new ObtenerDatosControlador();
							$Mostrar->datosChart();
							break;
					}
				}
			}
	}
}