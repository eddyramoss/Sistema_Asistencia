<?php

    if (!empty($_POST["btnregistrar"])) {
        if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtcarnet"]) and !empty($_POST["txtcargo"])) {
            $nombre=$_POST["txtnombre"];
            $apellido=$_POST["txtapellido"];
            $carnet=$_POST["txtcarnet"];
            $cargo=$_POST["txtcargo"];

            $sql = $conexion->query("SELECT count(*) as 'total' FROM empleado WHERE ci='$carnet'");
            if ($sql->fetch_object()->total>0) {?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "ERROR",
			type: "error",
			text: "El carnet <?= $carnet?> ya existe",
			styling: "bootstrap3"
		})
	})
</script>
<?php } else {
    $registro = $conexion->query("INSERT INTO empleado (nombre, apellido, ci,cargo)values ('$nombre','$apellido',$carnet,$cargo)");
    if ($registro ==true) {?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "CORRECTO",
			type: "success",
			text: "El empleado <?=$nombre?> se ha registrado correctamente",
			styling: "bootstrap3"
		})
	})
</script>
<?php } else {?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "INCORRECTO",
			type: "error",
			text: "El empleado no se ha registrado correctamente",
			styling: "bootstrap3"
		})
	})
</script>
<?php }
}
        } else {?>
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

<?php }?>

<script>
	setTimeout(() => {
		window.history.replaceState(null, null, window.location.pathname)
	}, 0);
</script>

<?php
    }
    ?>