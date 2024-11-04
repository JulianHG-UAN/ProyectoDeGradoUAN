<?php
include_once('../bd/conexion.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$users_id = (isset($_POST['users_id'])) ? $_POST['users_id'] : '';
$users_name = (isset($_POST['users_name'])) ? $_POST['users_name'] : '';
$users_lastname = (isset($_POST['users_lastname'])) ? $_POST['users_lastname'] : '';
$users_email = (isset($_POST['users_email'])) ? $_POST['users_email'] : '';
$password_hash = (isset($_POST['password_hash'])) ? $_POST['password_hash'] : '';
$role_id = (isset($_POST['role_id'])) ? $_POST['role_id'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO users (users_name, users_lastname, users_email, password_hash, role_id) VALUES('$users_name', '$users_lastname', '$users_email', '$password_hash', '$role_id')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM users ORDER BY users_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE users SET users_name='$users_name', users_lastname='$users_lastname', users_email='$users_email', password_hash='$password_hash', role_id='$role_id' WHERE users_id='$users_id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM users WHERE users_id='$users_id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        error_log("Usuario ID a eliminar: $users_id");
        $consulta = "DELETE FROM users WHERE users_id='$users_id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = ["message" => "Usuario eliminado con éxito"];
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion=null;

?>