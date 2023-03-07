<?php

    if (!empty($_POST["btnmodificar"])) {
        if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"])) {
            $nombre=$_POST["txtnombre"];
            $apellido=$_POST["txtapellido"];
            $usuario=$_POST["txtusuario"];
            //se agrego para cambiar la contraeña
            $password = $_POST["txtpassword"];
            $id = $_POST["txtid"];
            $sql = $conexion->query("select count(*) as 'total' from usuario where usuario='$usuario' and id_usuario!='$id'");
            if ($sql->fetch_object()->total> 0) { ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "ERROR",
			type: "error",
			text: "El usuario <?= $usuario?> ya existe",
			styling: "bootstrap3"
		})
	})
</script>
<?php } else {
    //se agrego password='$password' para cambiar la contraseña
    $modificar=$conexion->query("UPDATE usuario SET nombre ='$nombre', apellido='$apellido', usuario='$usuario', password='$password' where id_usuario=$id");
    if ($modificar == true) { ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "CORRECTO",
			type: "success",
			text: "El usuario se ha modificado correctamente",
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
			text: "Error al modificar usuario ",
			styling: "bootstrap3"
		})
	})
</script>
<?php  }
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
<?php  } ?>
<script>
	setTimeout(() => {
		window.history.replaceState(null, null, window.location.pathname)
	}, 0);
</script>
<?php }
    ?>