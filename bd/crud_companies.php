<?php
include_once('../bd/conexion.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$company_id = (isset($_POST['company_id'])) ? $_POST['company_id'] : '';
$company_name = (isset($_POST['company_name'])) ? $_POST['company_name'] : '';
$company_address = (isset($_POST['company_address'])) ? $_POST['company_address'] : '';
$is_active = (isset($_POST['is_active'])) ? $_POST['is_active'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO companies (company_name, company_address, is_active) VALUES('$company_name', '$company_address', '$is_active')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM companies ORDER BY company_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE companies SET company_name='$company_name', company_address='$company_address', is_active='$is_active' WHERE company_id='$company_id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM companies WHERE company_id='$company_id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        error_log("Companie ID a eliminar: $company_id");
        $consulta = "DELETE FROM companies WHERE company_id='$company_id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = ["message" => "Compañia eliminada con éxito"];
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion=null;

?>