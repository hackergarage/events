<?php
	require_once("funcionesEventos.php");
	
	//Limpiar entrada
	$id = $_REQUEST["id"];
	$id = htmlentities($id);
	//if(!preg_match("/[0-9]*/"))
		//header("Location: ".$_SERVER["REQUEST_URI"]);
	
	eliminarEvento($id);
	
	header("Location: panelMisEventos.php");
?>