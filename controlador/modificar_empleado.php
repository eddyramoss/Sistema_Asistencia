<?php
    if (!empty($_POST["btnmodificar"])) {
        if (!empty($_POST["txtid"]) and !empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtci"]) and !empty($_POST["txtcargo"])) {
            $id=$_POST["txtid"];
            $nombre=$_POST["txtnombre"];
            $apellido=$_POST["txtapellido"];
            $carnet=$_POST["txtci"];
            $cargo = $_POST["txtcargo"];

            $sql = $conexion->query("UPDATE empleado SET nombre ='$nombre', apellido='$apellido', ci='$carnet', cargo=$cargo where id_empleado=$id");
            if ($sql == true) { ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "CORRECTO",
			type: "success",
			text: "El empleado <?=$nombre?> se ha modificado correctamente",
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
			text: "Error al modificar empleado",
			styling: "bootstrap3"
		})
	})
</script>
<?php }
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