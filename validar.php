<?php

$usuario = $_POST['usuario'];
$password = $_POST['password'];

session_start();
$_SESSION['usuario'] = $usuario; //almacena el usuario en la variable de sesion

include('db.php'); //incluye el archivo de conexion a la base de datos

$consulta = "SELECT * FROM users WHERE users_email = '$usuario' and password_hash = '$password'";
$resultado = mysqli_query($conexion, $consulta); //ejecuta la consulta  

$filas = mysqli_num_rows($resultado); //devuelve el numero de filas afectadas

if ($filas) {
    header("location:index.php"); //si el usuario y la contraseña son correctos redirecciona a index.php
} else {
    ?>
    <?php
    include("login.php");
    ?>
    <h1 class="bad">ERROR en la autenticacion</h1>
    <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);