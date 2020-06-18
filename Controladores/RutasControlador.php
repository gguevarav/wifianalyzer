<?php

class ControladorRutas{
	public function index(){
		// Incluimos el archivo de las rutas
		include "Rutas/Rutas.php";

		$Rutas = new Rutas();

		$Rutas->BuscarRuta();
	}
}