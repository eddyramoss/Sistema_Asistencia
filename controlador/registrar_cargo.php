<?php

//para validar si hizo clic en el boton registrar
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"])) {
        $nombre = $_POST["txtnombre"];
        //para que no se registre doble cargo asta
        $verificarNombre =$conexion->query("SELECT count(*) as 'total' from cargo WHERE nombre='$nombre'");
        //usamos el strcasecmp para validar mayusuclas y minusculas
        //y dentro de ese comparamos el nombre del cargo y el nuevo cargo
        //a introducir el cual seria hasta el total
        if ($verificarNombre->fetch_object()->total > 0) { ?> 
<script>
	$(function notificacion() {
		new PNotify({
			title: "ERROR",
			type: "error",
			text: "El cargo <?= $nombre?> ya existe",
			styling: "bootstrap3"
		})
	})
</script>
<?php } else {
    $sql = $conexion->query("INSERT INTO cargo(nombre) VALUES ('$nombre') ");
    if ($sql == true) { ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "CORRECTO",
			type: "success",
			text: "El cargo <?= $nombre?> se ha registrado correctamente",
			styling: "bootstrap3"
		})
	})
</script>
<?php  } else { ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "ICORRECTO",
			type: "error",
			text: "Error al registrar cargo",
			styling: "bootstrap3"
		})
	})
</script>
<?php }
}
    } else { ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "INCORRECTO",
			type: "error",
			text: "Los campos estan vacios",
			styling: "bootstrap3"
		})
	})
</script>
<?php } ?>

<script>
	setTimeout(() => {
		window.history.replaceState(null, null, window.location.pathname)
	}, 0);
</script>
<?php
}
?>