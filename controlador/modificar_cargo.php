<?php
//validamos el boton modificar cargo
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"])) {
        $nombre = $_POST["txtnombre"];
        $id =$_POST["txtid"];
        //evitar que se guarden datos ducplicados
        $verificarNombre=$conexion->query("SELECT count(*) as 'total' FROM cargo WHERE nombre='$nombre' and id_cargo!=$id");

        if ($verificarNombre->fetch_object()->total > 0) { ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "INCORRECTO",
			type: "error",
			text: "El cargo <?=$nombre?> ya existe",
			styling: "bootstrap3"
		})
	})
</script>
<?php } else {
    //si el nombre no existe entonces lo registramos
    $sql=$conexion->query(" UPDATE cargo set nombre='$nombre' WHERE id_cargo=$id ");
    if ($sql==true) { ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "CORRECTO",
			type: "success",
			text: "Cargo modificado correctamente",
			styling: "bootstrap3"
		})
	})
</script>
<?php } else { ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "INCORRECTO",
			type: "error",
			text: "Error al modificar",
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
<?php }
?>