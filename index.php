<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="public/styles/styles.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;1,400&display=swap" rel="stylesheet">

	<link href="public/pnotify/css/pnotify.css" rel="stylesheet" />
	<link href="public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
	<link href="public/pnotify/css/custom.min.css" rel="stylesheet" />
	<script src="public/pnotify/js/jquery.min.js">
	</script>
	<script src="public/pnotify/js/pnotify.js">
	</script>
	<script src="public/pnotify/js/pnotify.buttons.js">
	</script>
	<title>Pagina de bienvenida</title>
</head>

<body>
	<?php
     date_default_timezone_set('America/La_Paz');
?>
	<h1>REGISTRA TU ASISTENCIA</h1>
	<h2 id="fecha"><?=date("d/m/Y, h:i:s")?></h2>
	<?php
include"modelo/conexion.php";
include"controlador/registrar_asistencia.php";

?>
	<div class="container">
		<a class="acceso" href="vista/login/login.php">Ingresar al sistema</a>
		<p class="ci">Ingrese su numero de carnet</p>
		<form action="" method="POST">
			<input type="number" placeholder="Ingrese su CARNET AQUI" name="txtci" id="txtci">
			<div class="botones">

				<button id="entrada" class="entrada" type="submit" name="btnentrada" value="ok">ENTRADA</button>
				<button id="salida" class="salida" type="submit" name="btnsalida" value="ok">SALIDA</button>

			</div>
		</form>
	</div>

	<!--para mostrar la fecha en tiempo real-->
	<script>
		setInterval(() => {
			let fecha = new Date();
			let fechaHora = fecha.toLocaleString();
			document.getElementById("fecha").textContent = fechaHora;
		}, 1000);
	</script>
	<!--al introducir el ci ponemos un limite de numeros para que no ecriban mas numeros de lo solicitado -->
	<script>
		let ci = document.getElementById("txtci");
		ci.addEventListener("input", function() {
			if (this.value.length > 9) {
				this.value = this.value.slice(0, 9);

			}
		})

		//eventos para la entrada  y salida
		document.addEventListener("keydown", function(event) {
			if (event.code == "ArrowLeft") {
				document.getElementById("entrada").click()
			} else {
				if (event.code == "ArroWRight") {
					document.getElementById("salida").click()
				}
			}
		})
	</script>
</body>

</html>