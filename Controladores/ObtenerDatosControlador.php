<?php
    class ObtenerDatosControlador {

        static public function mostrar(){
            $lecturas = self::obtenerDatos();
            // Preparamos el Json
            $json = array(
                "status" => 200,
                "cantidad_datos" => count($lecturas),
                "detalle" => $lecturas
            );
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: http://localhost/');
            header('Access-Control-Allow-Methods: GET, POST');
            header("Access-Control-Allow-Headers: X-Requested-With");
            echo json_encode($json);
        }
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
                    // Validamos si la linea que estamos leyendo es un digito, porque de ser asi significa que
                    // es el inicio de un objeto
                    if(ctype_digit(trim($arrayLineas[$contador]))){
                        // Contador temporal que accedera a la siguiente linea, la actual es la del digito
                        $contadorTemporal = $contador+1;
                        // Mientras la linea no sea un digito, significa que pertenece al objeto, por lo tanto
                        // se agrega al array temporal
                        while(ctype_digit(trim($arrayLineas[$contadorTemporal])) == false && $contadorTemporal <= count($arrayLineas)){
                            array_push($arrayTemporal, trim($arrayLineas[$contadorTemporal]));
                            $contadorTemporal++;
                        }
                        // Actualizamos el contador por que ya analizamos las lineas
                        $contador = $contadorTemporal-1;
                    }
                    // Agregamos el array del objeto al array que contendra todos los objetos
                    array_push($informacionLecturas, $arrayTemporal);
                }

                // Objetos de Lecturas
                $lecturas = array();

                // Bloque de código para almacenar la información obtenida en los arrays en objetos
                for($Contador = 0; $Contador<count($informacionLecturas)-1; $Contador++){
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
                                            10 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][9]));
                    // Almacenamos la información obtenida en el objeto creado
                    // Creamos el objeto
                    $NuevaLectura = array(
                                            "id" => $Contador,
                                            "fecha" =>  $arrayTokensLinea[1][0],
                                            "hora" =>  $arrayTokensLinea[2][0],
                                            "Tarjeta" => $arrayTokensLinea[3][0],
                                            "IEEE" => $arrayTokensLinea[3][5],
                                            "ESSID" => $arrayTokensLinea[3][9],
                                            "Mode" => $arrayTokensLinea[4][1],
                                            "Frequency" => $arrayTokensLinea[4][4],
                                            "AccessPoint" => $arrayTokensLinea[4][10].":".
                                                            $arrayTokensLinea[4][11].":".
                                                            $arrayTokensLinea[4][14].":".
                                                            $arrayTokensLinea[4][13].":".
                                                            $arrayTokensLinea[4][14].":".
                                                            $arrayTokensLinea[4][15],
                                            "BitRate" => $arrayTokensLinea[5][2],
                                            "Velocidad" => $arrayTokensLinea[5][3],
                                            "TxPower" => $arrayTokensLinea[5][7],
                                            "RetryShortLimit" => $arrayTokensLinea[6][3],
                                            "RTSThr" => $arrayTokensLinea[6][8],
                                            "FragmentThr" => $arrayTokensLinea[6][13],
                                            "PowerManagement" => $arrayTokensLinea[7][2],
                                            "LinkQuality" => $arrayTokensLinea[8][2],
                                            "SignalLevel" => $arrayTokensLinea[8][6],
                                            "RxInvalidNwid" => $arrayTokensLinea[9][3],
                                            "RxInvalidCrypt" => $arrayTokensLinea[9][8],
                                            "RxInvalidFrag" => $arrayTokensLinea[9][13],
                                            "TxExcessiveRetries" => $arrayTokensLinea[10][3],
                                            "InvalidMisc" => $arrayTokensLinea[10][7],
                                            "MissedBeacon" => $arrayTokensLinea[10][12]);

                    // Agregamos el objeto al array principal
                    array_push($lecturas, $NuevaLectura);
                }

            }
            return $lecturas;
        }

        // Mostramos los datos del primer chart
        static public function datosChart(){
            // Obtenemos la data
            $lecturas = self::obtenerDatos();
            // Creamos el array
            $arrayTiemposdBm = array();
            // Agregaremos todas las tomas de los dBm a un array con su respectiva hora de toma
            for($contador = count($lecturas)-20; $contador < count($lecturas); $contador++){
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
            header('Access-Control-Allow-Origin: http://localhost/');
            header('Access-Control-Allow-Methods: GET, POST');
            header("Access-Control-Allow-Headers: X-Requested-With");
            echo json_encode($json);
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
