<?php
    if (!empty($_POST["btnentrada"])) {
        if (!empty($_POST["txtci"])) {
            $ci = ($_POST["txtci"]);
            $consulta = $conexion->query("SELECT count(*) as 'total' FROM empleado WHERE ci='$ci'");
            $id = $conexion->query("SELECT id_empleado FROM empleado WHERE ci='$ci'");
            if ($consulta->fetch_object()->total >0) {
                date_default_timezone_set('America/La_Paz');
                $fecha=date("Y-m-d h:i:s");
                $id_empleado=$id->fetch_object()->id_empleado;

                //evitamos la duplicidad de entrada
                $consultaFecha=$conexion->query(" SELECT entrada FROM asistencia WHERE id_empleado=$id_empleado order by id_asistencia desc limit 1");
                $fechaBD=$consultaFecha->fetch_object()->entrada;

                if (substr($fecha, 0, 10)==substr($fechaBD, 0, 10)) {
                    ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "INCORRECTO",
			type: "error",
			text: "Ya registraste tu ENTRADA",
			styling: "bootstrap3"
		})
	})
</script>
<?php
                } else {
                    $sql = $conexion->query("INSERT INTO asistencia(id_empleado, entrada) VALUES ($id_empleado, '$fecha')");
                    if ($sql == true) { ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "CORRECTO",
			type: "success",
			text: "Bienvenido",
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
			text: "Error al registrar su ENTRADA",
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
			text: "El carnet ingresado no existe",
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
			text: "Ingrese su N° de carnet",
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


<!--REGISTRO DE SALIDA -->


<?php
    if (!empty($_POST["btnsalida"])) {
        if (!empty($_POST["txtci"])) {
            $ci = ($_POST["txtci"]);
            $consulta = $conexion->query("SELECT count(*) as 'total' FROM empleado WHERE ci='$ci'");
            $id = $conexion->query("SELECT id_empleado FROM empleado WHERE ci='$ci'");
            if ($consulta->fetch_object()->total >0) {
                date_default_timezone_set('America/La_Paz');
                $fecha=date("Y-m-d h:i:s");
                $id_empleado=$id->fetch_object()->id_empleado;
                //linea 102 para buscar la ultima entrada registrada de un empleado
                $busqueda=$conexion->query("SELECT id_asistencia,entrada FROM asistencia WHERE id_empleado=$id_empleado order by id_asistencia desc limit 1");

                while ($datos=$busqueda->fetch_object()) {
                    $id_asistencia=$datos->id_asistencia;
                    $entradaBD=$datos->entrada;
                }
                if (substr($fecha, 0, 10)!=substr($entradaBD, 0, 10)) {
                    ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "INCORRECTO",
			type: "error",
			text: "Primero debes registrar tu entrada",
			styling: "bootstrap3"
		})
	})
</script>
<?php
                } else {
                    //evitamos la duplicidad de salida
                    $consultaFecha=$conexion->query(" SELECT salida FROM asistencia WHERE id_empleado=$id_empleado order by id_asistencia desc limit 1");
                    $fechaBD=$consultaFecha->fetch_object()->salida;

                    if (substr($fecha, 0, 10)==substr($fechaBD, 0, 10)) {
                        ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "INCORRECTO",
			type: "error",
			text: "Ya registraste tu salida",
			styling: "bootstrap3"
		})
	})
</script>
<?php
                    } else {
                        $sql = $conexion->query("UPDATE asistencia set salida='$fecha' WHERE id_asistencia=$id_asistencia");
                        if ($sql == true) { ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "CORRECTO",
			type: "success",
			text: "HASTA MAÑANA",
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
			text: "Error al registrar su SALIDA",
			styling: "bootstrap3"
		})
	})
</script>
<?php }
}
                }
            } else { ?>
<script>
	$(function notificacion() {
		new PNotify({
			title: "INCORRECTO",
			type: "error",
			text: "El carnet ingresado no existe",
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
			text: "Ingrese su N° de carnet",
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