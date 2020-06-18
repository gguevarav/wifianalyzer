<?php
    class ObtenerDatosControlador {
        // Mostramos los datos
        static public function mostrar(){
            // Abrimos el archivo en modo lectura
            $archivo = fopen("/home/drkprdx/Documentos/sitios/wifianalyzer/logs.txt", "r");
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
                $arrayTokensLinea = array(1 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][0]),
                                          2 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][1]),
                                          3 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][2]),
                                          4 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][3]),
                                          5 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][4]),
                                          6 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][5]),
                                          7 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][6]),
                                          8 => self::multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][7]));
                // Almacenamos la información obtenida en el objeto creado

                // Creamos el objeto
                $NuevaLectura = array(
                                        "Tarjeta" => $arrayTokensLinea[1][0],
                                        "IEEE" => $arrayTokensLinea[1][5],
                                        "ESSID" => $arrayTokensLinea[1][9],
                                        "Mode" => $arrayTokensLinea[2][1],
                                        "Frequency" => $arrayTokensLinea[2][4],
                                        "AccessPoint" => $arrayTokensLinea[2][10].":".
                                                         $arrayTokensLinea[2][11].":".
                                                         $arrayTokensLinea[2][12].":".
                                                         $arrayTokensLinea[2][13].":".
                                                         $arrayTokensLinea[2][14].":".
                                                         $arrayTokensLinea[2][15],
                                        "BitRate" => $arrayTokensLinea[3][2],
                                        "Velocidad" => $arrayTokensLinea[3][3],
                                        "TxPower" => $arrayTokensLinea[3][7],
                                        "RetryShortLimit" => $arrayTokensLinea[4][3],
                                        "RTSThr" => $arrayTokensLinea[4][8],
                                        "FragmentThr" => $arrayTokensLinea[4][13],
                                        "PowerManagement" => $arrayTokensLinea[5][2],
                                        "LinkQuality" => $arrayTokensLinea[6][2],
                                        "SignalLevel" => $arrayTokensLinea[6][6],
                                        "RxInvalidNwid" => $arrayTokensLinea[7][3],
                                        "RxInvalidCrypt" => $arrayTokensLinea[7][8],
                                        "RxInvalidFrag" => $arrayTokensLinea[7][13],
                                        "TxExcessiveRetries" => $arrayTokensLinea[8][3],
                                        "InvalidMisc" => $arrayTokensLinea[8][7],
                                        "MissedBeacon" => $arrayTokensLinea[8][12]);

                // Agregamos el objeto al array principal
                array_push($lecturas, $NuevaLectura);
            }
            // Preparamos el Json
            $json = array(
                "status" => 200,
                "cantidad_datos" => count($lecturas),
                "detalle" => $lecturas
             );

            header('Content-Type: application/json');
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
