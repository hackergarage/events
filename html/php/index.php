<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<meta name="keywords" lang="es" content="HackerGarage, Eventos, Programación Web" />
		<meta name="author" content="Manuel Alejandro Meza Olmedo" />
		<meta name="description" content="Registro de eventos de programación en linea" />
		<title>Eventos</title>
		<link rel="stylesheet" type="text/css" href="../css/vistablog.css" />
	</head>

	<body>
	
	<?
		include 'header.php';
		include 'nav.php';
		
		include 'consultaEventos.php';
	?>
		<article class="all_event">
	<?
	foreach($datos as $key => $value)
	{
		echo '<section class="event">
				<h3><a href="vistaDetalle.php?evento=', $value["idevento"], '">', $value["fechaEvento"], ': ', 
				$value["nombre"], '</a></h3>';
				
		echo '<img src="', $value["rutaFlyer"], '" alt="Evento Hackers and Founders" width="500" height="800" />
				<p>', 
				htmlentities($value["descripcion"]), 
				'</p>
				<div id="info-event-1" class="info">
					<p> Cuando: <span class="place" id="cuando-1">', $value["fechaEvento"], '</span></p> ',
					'<p class="place" >Donde: <span class="place" id="donde-1">HackerGarage, Vidrio #2188, entre Simón Bolivar y Gral. San Martín, Guadalajara.</span></p>
					<p class="place" >Precio: $<span class="place" id="precio-1">', $value["precio"], '</span>
					';
			if($value["capacidad"] == -1)
				echo 'Capacidad: <span class="place" id="capacidad-1"> Ilimitada </span>';
			else
				echo 	'Capacidad: <span class="place" id="capacidad-1">', $value["capacidad"], '</span> '; 
		echo			'Categoría: <span class="place" id="categoria-1"> <a href="#">', $value["categoria"], '</a> Publicado el ', $value["fechaCreacion"], '</span> por 
					<span class="place" id="quien-1"><a href="" >', $value["creadoPor"], '</a></span> </p>
				</div>
			</section>';        
	}
	?>
			<div class="pre-nex">
				<button type="button" id="previous" class="boton">&laquo; Anterior</button>
				<button type="button" id="next" class="boton">Siguiente &raquo;</button>
			</div>
		</article>
	
	<!-- 
	Se necesitará un php que dibuje <section> y todo lo que ésta contiene. 
	0. poner un for que dibuje 5 sections (por decir algo, 5 por página)
	1. corregir los enlaces por php/blablabla.php 
	2. la fecha y el "alt" se debe sacar de la columna NOMBRE de la tabla EVENTO
	3. las rutas de las imágenes de los flyers DEBEN ESTAR EN LA BASE DE DATOS, por ejemplo en la columna FLYER de la tabla EVENTO
	4. descripción del evento: TEXT_LIBRE
	5. Seguir llenando los datos usando la base de datos.
	  
	-->

			
			
	<?	include 'footer.php'; ?>
		
	</body>
</html>