<?php

    require_once("LecturaWifi.php");

    // Abrimos el archivo en modo lectura
    $archivo = fopen("logs.txt", "r");
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
    
    // Funcion para realizar un explode con varios delimitadores
    function multiexplode ($delimitadores, $cadenaAnalizar) {
        // Reemplaza todos los delimitadores con el primer delimitaror
        $reemplazoDelimitadores = str_replace($delimitadores, $delimitadores[0], $cadenaAnalizar);
        // Realizamos el explode con el primer delimitar
        $cadenaRecortada = explode($delimitadores[0], $reemplazoDelimitadores);
        // Devuelve la cadena
        return  $cadenaRecortada;
    }

    // Objetos de Lecturas
    $lecturas = array();

    // Bloque de código para almacenar la información obtenida en los arrays en objetos
    for($Contador = 0; $Contador<count($informacionLecturas)-1; $Contador++){
        // Creamos el objeto
        $NuevaLectura = new LecturaWifi;
        // Dividimos en tokens la informacion obtenida de la linea para luego almacenarla en el objeto
        $arrayTokensLinea = multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][0]);
        // Almacenamos la información obtenida en el objeto creado
        // Primer linea
        $NuevaLectura->setTarjeta($arrayTokensLinea[0]);
        $NuevaLectura->setIEEE($arrayTokensLinea[5]);
        $NuevaLectura->setESSID($arrayTokensLinea[9]);
        // Segunda linea
        $arrayTokensLinea = multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][1]);
        $NuevaLectura->setMode($arrayTokensLinea[1]);
        $NuevaLectura->setFrequency($arrayTokensLinea[4]);
        $NuevaLectura->setAccessPoint($arrayTokensLinea[10].":".
                                      $arrayTokensLinea[11].":".
                                      $arrayTokensLinea[12].":".
                                      $arrayTokensLinea[13].":".
                                      $arrayTokensLinea[14].":".
                                      $arrayTokensLinea[15]);
        // Tercer Linea
        $arrayTokensLinea = multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][2]);
        $NuevaLectura->setBitRate($arrayTokensLinea[2]);
        $NuevaLectura->setVelocidad($arrayTokensLinea[3]);
        $NuevaLectura->setTxPower($arrayTokensLinea[7]);
        // Cuarta Linea
        $arrayTokensLinea = multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][3]);
        $NuevaLectura->setRetryShortLimit($arrayTokensLinea[3]);
        $NuevaLectura->setRTSThr($arrayTokensLinea[8]);
        $NuevaLectura->setFragmentThr($arrayTokensLinea[13]);
        // Quinta Linea
        $arrayTokensLinea = multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][4]);
        $NuevaLectura->setPowerManagement($arrayTokensLinea[2]);
        // Sexta Linea
        $arrayTokensLinea = multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][5]);
        $NuevaLectura->setLinkQuality($arrayTokensLinea[2]);
        $NuevaLectura->setSignalLevel($arrayTokensLinea[6]);
        // Septima Linea
        $arrayTokensLinea = multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][6]);
        $NuevaLectura->setRxInvalidNwid($arrayTokensLinea[3]);
        $NuevaLectura->setRxInvalidCrypt($arrayTokensLinea[8]);
        $NuevaLectura->setRxInvalidFrag($arrayTokensLinea[13]);
        // Octava Linea
        $arrayTokensLinea = multiexplode(array(","," ","|",":", "\"", "="), $informacionLecturas[$Contador][7]);
        $NuevaLectura->setTxExcessiveRetries($arrayTokensLinea[3]);
        $NuevaLectura->setInvalidMisc($arrayTokensLinea[7]);
        $NuevaLectura->setMissedBeacon($arrayTokensLinea[12]);

        // Agregamos el objeto al array principal
        array_push($lecturas, $NuevaLectura);
    }

    print_r($lecturas);
    //var_dump($lecturas);