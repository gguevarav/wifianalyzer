<?php

// Requerimos los controladores que utilizaremos.
require_once "Controladores/RutasControlador.php";
require_once "Controladores/ObtenerDatosControlador.php";

$Rutas = new ControladorRutas();

$Rutas->index();