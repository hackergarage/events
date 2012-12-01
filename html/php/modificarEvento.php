<?php
	//Crear conexion con la base de datos
	require_once("bd.inc");
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $db);
	
	//Obtener variables
	$id = $_REQUEST["id"];
	$nomEvento = $_REQUEST["nom_event"];
	$descripcion = $_REQUEST["descripcion"];
	$precio = $_REQUEST["cost_event"];
	$capacidad = $_REQUEST["cap"];
	if($capacidad == "limited") {
		$num_cap = $_REQUEST["cap_event"];
	} else {
		if($capacidad == "ilimited")
			$num_cap = -1;	
	}	
	$categoria = $_REQUEST["cat"];
	$fecha = $_REQUEST["dat_event"];
	
	$tempdate = explode("/", $fecha);
	$fecha = $tempdate[2] . '-' . $tempdate[0] . '-' . $tempdate [1];
	unset($tempdate);
	
	//Realizar validaciones con todas las formas de limpiar variables
	$id = $mysqli -> real_escape_string($id);
	$nomEvento = $mysqli -> real_escape_string($nomEvento);
	$descripcion = $mysqli -> real_escape_string($descripcion);
	$precio = $mysqli -> real_escape_string($precio);
	$capacidad = $mysqli -> real_escape_string($capacidad);
	$num_cap = $mysqli -> real_escape_string($num_cap);
	$categoria = $mysqli -> real_escape_string($categoria);
	$fecha = $mysqli -> real_escape_string($fecha);
	
	$id = htmlentities($id);
	$nomEvento = htmlentities($nomEvento);
	$descripcion = htmlentities($descripcion);
	$precio = htmlentities($precio);
	$capacidad = htmlentities($capacidad);
	$num_cap = htmlentities($num_cap);
	$categoria = htmlentities($categoria);
	$fecha = htmlentities($fecha);
	
	if(preg_match('/[0-9]*/',$id) == 0) {
		die("Hay un error con el id");	
	}	
	if(preg_match('/[A-Za-z0-9 _\-\#\@\.\,\:]{8,}/', $nomEvento) == 0) {
		die("El nombre del evento cuenta con caracteres invalidos");
	}
	if(preg_match('/[A-Za-z0-9 _\-\#\@\.\,\:\&]{20,4500}/', $descripcion) == 0){
		die("La descripcion cuenta con caracteres invalidos");	
	}
	if(preg_match('/[0-9]+/', $precio) == 0) {
		die("El precio es incorrecto");	
	}
	if(preg_match('/-*[0-9]+/',$num_cap) == 0) {
		die("La capacidad es erronea");	
	}
	if(preg_match('/[0-9]/', $categoria) == 0) {
		die("La categoria es erronea");	
	}
	if(preg_match('/(20[0-9]{2})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])/', $fecha) == 0) {
		die("Fecha invalida");	
	}
	
	// -------------------------- START Script de carga de imagen -------------------------------------
	//Se define el tamaño que se permitirá (en KB por eso lo multiplicamos por 1024)
	$tamanioPermitido = 1024 * 1024;

	//Tenemos una lista con las extensiones que aceptaremos
	$extensionesPermitidas = array("jpg", "jpeg", "gif", "png");

	//Obtenemos la extensión del archivo
	$extension = end(explode(".", $_FILES["file"]["name"]));
	
	//Validamos el tipo de archivo, el tamaño en bytes y que la extensión sea válida
	if ((($_FILES["file"]["type"] == "image/gif")
      || ($_FILES["file"]["type"] == "image/jpeg")
      || ($_FILES["file"]["type"] == "image/png")
      || ($_FILES["file"]["type"] == "image/pjpeg")
      || ($_FILES["file"]["type"] == "image/jpg"))
      && ($_FILES["file"]["size"] < $tamanioPermitido)
      && in_array($extension, $extensionesPermitidas)){
              //Si no hubo un error al subir el archivo temporalmente
              if ($_FILES["file"]["error"] > 0){
                     die("Return Code: " . $_FILES["file"]["error"] . "<br />");
              }
              else{
                    //Si el archivo ya existe se muestra el mensaje de error
                    if (file_exists("upload/" . $_FILES["file"]["name"])){
                           die($_FILES["file"]["name"] . " already exists. ");
                    }
                    else{
                           //Se mueve el archivo de su ruta temporal a una ruta establecida
                           move_uploaded_file($_FILES["file"]["tmp_name"],
                                   "upload/" . $_FILES["file"]["name"]);
                           $file = "upload/" . $_FILES["file"]["name"];
                    }
              }
	}
	// -------------------------- END Script de carga de imagen ---------------------------------------
	//Ingresamos los datos del evento a la base de datos
	if(empty($file) || !isset($file)) {
		$query = "UPDATE evento SET nombre='$nomEvento',descripcion='$descripcion',precio=$precio,capacidad=$num_cap,fechaEvento='$fecha',
				categoria='$categoria' WHERE idevento=$id";
	} else {
		$query = "UPDATE evento SET nombre='$nomEvento',rutaFlyer='$file', descripcion='$descripcion',precio=$precio,capacidad=$num_cap,fechaEvento='$fecha',
				categoria='$categoria' WHERE idevento=$id";	
	}

	if(!$mysqli -> query($query)) {
		die("Error al actualizar los datos. Vuelva a intentarlo");	
	}

	header("Location: panelMisEventos.php");
?>