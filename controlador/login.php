<?php

session_start();
//una forma de validar los datos ingresados en el form y usamos
//fetch_object para devolver los valores asignados
if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["usuario"]) and !empty($_POST["password"])) {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        $sql = $conexion->query("SELECT*FROM usuario WHERE usuario='$usuario' and password='$password'");
        if ($datos = $sql->fetch_object()) {
            $_SESSION["nombre"] = $datos->nombre;
            $_SESSION["apellido"] = $datos->apellido;
            $_SESSION["id"] = $datos->id_usuario;
            header("location:../inicio.php");
        } else {
            echo "<div class='alert alert-danger'>Usuario o Contraseña incorrecta</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Los campos estan vacios</div>";
    }
}
