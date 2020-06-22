<?php
    class ObtenerDatosControlador {
        
        // GET: /api
        static public function mostrar(){
            $lecturas = self::obtenerDatos();
            // Preparamos el Json
            $json = array(
                "status" => 200,
                "cantidad_datos" => count($lecturas),
                "detalle" => $lecturas
            );
            header('Content-Type: application/json');
            //header('Access-Control-Allow-Origin: http://localhost/');
            header('Access-Control-Allow-Methods: GET, POST');
            header("Access-Control-Allow-Headers: X-Requested-With");
            echo json_encode($json);
        }

        // GET: /intensidades
        static public function datosChart(){
            // Obtenemos la data
            $lecturas = self::obtenerDatos();
            // Creamos el array
            $arrayTiemposdBm = array();
            // Agregaremos todas las tomas de los dBm a un array con su respectiva hora de toma
			if(count($lecturas) < 20){
				$inicio = count($lecturas);
			}
			else{
				$inicio = count($lecturas)-20;
			}
			$final = count($lecturas);
            for($contador = $inicio; $contador < $final; $contador++){
                $arrayTemporal = array(
                                          "id" => $lecturas[$contador]["id"],
                                          "hora" => $lecturas[$contador]["hora"],
                                          "intensidad" => $lecturas[$contador]["SignalLevel"]
                );
                // Agregamos el objeto al array principal
                array_push($arrayTiemposdBm, $arrayTemporal);
            }
            // Preparamos el Json
            $json = array(
                "status" => 200,
                "cantidad_datos" => count($arrayTiemposdBm),
                "detalle" => $arrayTiemposdBm
            );
            // Devolvemos ldo datos
            header('Content-Type: application/json');
            //header('Access-Control-Allow-Origin: http://localhost/');
            //header('Access-Control-Allow-Methods: GET, POST');
            //header("Access-Control-Allow-Headers: X-Requested-With");
            echo json_encode($json);
        }

        // Funcion principal
        static public function obtenerDatos(){
            // Abrimos el archivo en modo lectura
            $archivo = fopen("/home/drkprdx/Documentos/sitios/wifianalyzer/logs.txt", "r");
            if($archivo == null){
                $json = array(
                    "status" => 404,
                    "cantidad_datos" => 0,
                    "detalle" => "archivo no encontrado"
                 );
            }
            else{
                // Creamos un array que contenga todas las lineas del archivo
                $arrayLineas = array();

                $posicion = 0;
                // Con un while recorremos todo el archivo y agregamos cada linea al array antes creado
                while (!feof($archivo)){
                    $linea = fgets($archivo);
                    array_push($arrayLineas, $linea);
                }
                // Cerramos el archivo
                fclose($archivo);
                // Mostramos el archivo

                // Array que contendra array's anidados (objetos leidos)
                $informacionLecturas = array();

                // Con el siguiente bloque se codigo se recorre el array de las lineas leidas y se
                // separan en array individuales por lectura
                for($contador = 0; $contador<count($arrayLineas); $contador++){
                    // Se crea un array temporal para agregar todas las linea que pertenecen al mismo objeto
                    $arrayTemporal = array();
                    // Usaremos un ciclo for que leerá las líneas que corresponden a cada lectura que se encuentra en el archivo
                    $contadorLinea = $contador;
                    // El final del ciclo corresponde a la posición actual más 12 líneas que corresponde a la cantidad de
                    // líneas que tiene cada lectura del archivo
                    $fin = $contador+12;
                    // Primero revisamos que no vayamos a leer fuera del indice del array que contiene todas las líneas
                    if ($fin < count($arrayLineas)){
                        // Iniciamos el ciclo for
                        for($contadorLinea; $contadorLinea < $fin; $contadorLinea++){
                            // Las veces que se repita, almacenará la línea leida en un array temporal
                            array_push($arrayTemporal, trim($arrayLineas[$contadorLinea]));
                        }
                        // a su vez al salir de leer las líneas lo agrega al array principal que contendrá las lecturas individuales
                        array_push($informacionLecturas, $arrayTemporal);
                    }
                    // Movemos el contador a la posición de donde toca extraer la información.
                    $contador = $fin -1;
                }

                // Objetos de Lecturas
                $lecturas = array();

                // Bloque de código para almacenar la información obtenida en los arrays en objetos
                for($Contador = 0; $Contador<count($informacionLecturas); $Contador++){
                    // Dividimos en tokens la informacion obtenida de la linea para luego almacenarla en el objeto
                    $arrayTokensLinea = array(1 => self::multiexplode(array(","," ","|", "\"", "="), $informacionLecturas[$Contador][0]),
                                              2 => self::multiexplode(array(","," ","|", "\"", "="), $informacionLecturas[$Contador][1]),
                                              3 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][2]),
                                              4 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][3]),
                                              5 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][4]),
                                              6 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][5]),
                                              7 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][6]),
                                              8 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][7]),
                                              9 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][8]),
                                              10 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][9]),
                                              11 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][10]));

                    // Almacenamos la información obtenida en el objeto creado
                    // Creamos el objeto
                    $NuevaLectura = array(
                                            "id" => $arrayTokensLinea[1][0],
                                            "fecha" =>  $arrayTokensLinea[2][0],
                                            "hora" =>  $arrayTokensLinea[3][0],
                                            "Tarjeta" => $arrayTokensLinea[4][0],
                                            "IEEE" => $arrayTokensLinea[4][5],
                                            "ESSID" => $arrayTokensLinea[4][9],
                                            "Mode" => $arrayTokensLinea[5][1],
                                            "Frequency" => $arrayTokensLinea[5][4],
                                            "AccessPoint" => $arrayTokensLinea[5][10].":".
                                                            $arrayTokensLinea[5][11].":".
                                                            $arrayTokensLinea[5][14].":".
                                                            $arrayTokensLinea[5][13].":".
                                                            $arrayTokensLinea[5][14].":".
                                                            $arrayTokensLinea[5][15],
                                            "BitRate" => $arrayTokensLinea[6][2],
                                            "Velocidad" => $arrayTokensLinea[6][3],
                                            "TxPower" => $arrayTokensLinea[6][7],
                                            "RetryShortLimit" => $arrayTokensLinea[7][3],
                                            "RTSThr" => $arrayTokensLinea[7][8],
                                            "FragmentThr" => $arrayTokensLinea[7][13],
                                            "PowerManagement" => $arrayTokensLinea[8][2],
                                            "LinkQuality" => $arrayTokensLinea[9][2],
                                            "SignalLevel" => $arrayTokensLinea[9][6],
                                            "RxInvalidNwid" => $arrayTokensLinea[10][3],
                                            "RxInvalidCrypt" => $arrayTokensLinea[10][8],
                                            "RxInvalidFrag" => $arrayTokensLinea[10][13],
                                            "TxExcessiveRetries" => $arrayTokensLinea[11][3],
                                            "InvalidMisc" => $arrayTokensLinea[11][7],
                                            "MissedBeacon" => $arrayTokensLinea[11][12]);

                    // Agregamos el objeto al array principal
                    array_push($lecturas, $NuevaLectura);
                }

            }

            // Retornamos el array que contiene todas las lecturas con la información de forma individual
			return $lecturas;
        }

        

        // Funcion para realizar un explode con varios delimitadores
        private static function multiexplode($delimitadores, $cadenaAnalizar) {
            // Reemplaza todos los delimitadores con el primer delimitaror
            $reemplazoDelimitadores = str_replace($delimitadores, $delimitadores[0], $cadenaAnalizar);
            // Realizamos el explode con el primer delimitar
            $cadenaRecortada = explode($delimitadores[0], $reemplazoDelimitadores);
            // Devuelve la cadena
            return $cadenaRecortada;
        }
    }
