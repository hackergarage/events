<?php
function misEventos () {
	//Conexion a la base de datos
	include("bd.inc");
	
	$con = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	//Validar que no genere error la conexión
	if($con -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");
	
	//Extraer qué usuario está pidiendo la consulta:
	$usuario = $_SESSION["twitter"];

	//Creo la consulta
	$mi_query = "select idevento, nombre, descripcion, precio, capacidad, fechaEvento, categoria, status, motivo
				 from evento where creadoPor=$usuario";
	
	//Ejecutar mi consulta
	$result = $con -> query($mi_query);

	//echo '<pre>';
	//var_dump($result);
	//echo '</pre>';
	
	//Cierro la conexión
	$con -> close();

	//Convierto el resultado de mi consulta a una matriz
	$datos = NULL;
	//var_dump($result);
	if ( $result != false) // cuando la consulta sí dio algo
	{
		$cuantosRenglones = $result -> num_rows;
		if($cuantosRenglones >= 1)
		{
			//Por cada fila obtengo un arreglo
			while($fila = $result -> fetch_assoc())
				$datos[] = $fila;
		}	
	}
	
	return $datos;
}

function eliminarEvento($id) {
	include("bd.inc");
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	if($mysqli -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");
			
	//Consulta
	$consult = "delete from evento where idevento=$id";
	//Ejecutar consulta
	$mysqli -> query($consult);
	//Cerrar consulta
	$mysqli -> close();	
}

function consultaCategorias() {
	include("bd.inc");
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	if($mysqli -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");
		
	//Creo la consulta
	$mi_query = "select * from categoria";
	
	//Ejecutar mi consulta
	$result = $mysqli -> query($mi_query);
	
	//Cierro la conexión
	$mysqli -> close();

	//Convierto el resultado de mi consulta a una matriz
	$cuantosRenglones = $result -> num_rows;
	if($cuantosRenglones >= 1){
		//Por cada fila obtengo un arreglo
		while($fila = $result -> fetch_assoc())
			$datos[] = $fila;
	}	
	
	return $datos;
}

function modificarEvento($id) {
	include("bd.inc");
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	if($mysqli -> connect_error)
		die("Por el momento no se puede acceder al gestor de la base de datos");
		
	//Creo la consulta
	$mi_query = "select nombre,rutaFlyer,descripcion,precio,capacidad,fechaEvento,categoria from evento where idevento=$id";
	
	//Ejecutar mi consulta
	$result = $mysqli -> query($mi_query);
	
	//Cierro la conexión
	$mysqli -> close();
	
	//Convierto el resultado de mi consulta a una matriz
	$cuantosRenglones = $result -> num_rows;
	if($cuantosRenglones == 1) {
		$fila = $result -> fetch_assoc();
	}	
	
	return $fila;	
}
	
?>