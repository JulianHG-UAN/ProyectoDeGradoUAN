<?php
include_once('conexion.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$employee_Id = (isset($_POST['employee_Id'])) ? $_POST['employee_Id'] : '';
$company_id = (isset($_POST['company_id'])) ? $_POST['company_id'] : '';
$employee_Name = (isset($_POST['employee_Name'])) ? $_POST['employee_Name'] : '';
$employee_Secondname = (isset($_POST['employee_Secondname'])) ? $_POST['employee_Secondname'] : '';
$employee_Lastname = (isset($_POST['employee_Lastname'])) ? $_POST['employee_Lastname'] : '';
$employee_Secondlastname = (isset($_POST['employee_Secondlastname'])) ? $_POST['employee_Secondlastname'] : '';
$employee_Genero = (isset($_POST['employee_Genero'])) ? $_POST['employee_Genero'] : '';
$employee_Birthdate = (isset($_POST['employee_Birthdate'])) ? $_POST['employee_Birthdate'] : '';
$employee_EstadoCivil = (isset($_POST['employee_EstadoCivil'])) ? $_POST['employee_EstadoCivil'] : '';
$employee_UltimoNivelEstudio = (isset($_POST['employee_UltimoNivelEstudio'])) ? $_POST['employee_UltimoNivelEstudio'] : '';
$employee_Ocupacion = (isset($_POST['employee_Ocupacion'])) ? $_POST['employee_Ocupacion'] : '';
$employee_ResidenciaDepartamento = (isset($_POST['employee_ResidenciaDepartamento'])) ? $_POST['employee_ResidenciaDepartamento'] : '';
$employee_ResidenciaCuidad = (isset($_POST['employee_ResidenciaCuidad'])) ? $_POST['employee_ResidenciaCuidad'] : '';
$employee_EstratoSocial = (isset($_POST['employee_EstratoSocial'])) ? $_POST['employee_EstratoSocial'] : '';
$employee_TipoVivienda = (isset($_POST['employee_TipoVivienda'])) ? $_POST['employee_TipoVivienda'] : '';
$employee_PersonasACargo = (isset($_POST['employee_PersonasACargo'])) ? $_POST['employee_PersonasACargo'] : '';
$employee_TrabajoDepartamento = (isset($_POST['employee_TrabajoDepartamento'])) ? $_POST['employee_TrabajoDepartamento'] : '';
$employee_TrabajoCuidad = (isset($_POST['employee_TrabajoCuidad'])) ? $_POST['employee_TrabajoCuidad'] : '';
$employee_TiempoEnEmpresa = (isset($_POST['employee_TiempoEnEmpresa'])) ? $_POST['employee_TiempoEnEmpresa'] : '';
$employee_NombreCargo = (isset($_POST['employee_NombreCargo'])) ? $_POST['employee_NombreCargo'] : '';
$employee_TipoCargo = (isset($_POST['employee_TipoCargo'])) ? $_POST['employee_TipoCargo'] : '';
$employee_TiempoEnCargo = (isset($_POST['employee_TiempoEnCargo'])) ? $_POST['employee_TiempoEnCargo'] : '';
$employee_NombreArea = (isset($_POST['employee_NombreArea'])) ? $_POST['employee_NombreArea'] : '';
$employee_TipoContrato = (isset($_POST['employee_TipoContrato'])) ? $_POST['employee_TipoContrato'] : '';
$employee_HorasLaborales = (isset($_POST['employee_HorasLaborales'])) ? $_POST['employee_HorasLaborales'] : '';
$employee_TipoSalario = (isset($_POST['employee_TipoSalario'])) ? $_POST['employee_TipoSalario'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO employees (company_id, employee_Name, employee_Lastname, employee_Genero, employee_Birthdate, employee_EstadoCivil, employee_UltimoNivelEstudio, employee_Ocupacion, employee_ResidenciaDepartamento, employee_ResidenciaCuidad, employee_EstratoSocial, employee_TipoVivienda, employee_PersonasACargo, employee_TrabajoDepartamento, employee_TrabajoCuidad, employee_TiempoEnEmpresa, employee_NombreCargo, employee_TipoCargo, employee_TiempoEnCargo, employee_NombreArea, employee_TipoContrato, employee_HorasLaborales, employee_TipoSalario) 
        VALUES('$company_id', '$employee_Name', '$employee_Lastname', '$employee_Genero', '$employee_Birthdate', '$employee_EstadoCivil', '$employee_UltimoNivelEstudio', '$employee_Ocupacion', '$employee_ResidenciaDepartamento', '$employee_ResidenciaCuidad', '$employee_EstratoSocial', '$employee_TipoVivienda', '$employee_PersonasACargo', '$employee_TrabajoDepartamento', '$employee_TrabajoCuidad', '$employee_TiempoEnEmpresa', '$employee_NombreCargo', '$employee_TipoCargo', '$employee_TiempoEnCargo', '$employee_NombreArea', '$employee_TipoContrato', '$employee_HorasLaborales', '$employee_TipoSalario')";

        $resultado = $conexion->prepare($consulta);
        $ejecutado = $resultado->execute(); 

        if ($ejecutado) {
            // Solo realiza el SELECT si la inserción fue exitosa
            console.log('Entra al If');
            $consulta = "SELECT employee_Id, company_id, employee_Name, employee_Lastname, employee_Genero, employee_Birthdate, employee_EstadoCivil, employee_UltimoNivelEstudio, employee_Ocupacion, employee_ResidenciaDepartamento, employee_ResidenciaCuidad, employee_EstratoSocial, employee_TipoVivienda, employee_PersonasACargo, employee_TrabajoDepartamento, employee_TrabajoCuidad, employee_TiempoEnEmpresa, employee_NombreCargo, employee_TipoCargo, employee_TiempoEnCargo, employee_NombreArea, employee_TipoContrato, employee_HorasLaborales, employee_TipoSalario 
            FROM employees ORDER BY employee_Id DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        } else {
            console.log('Error al insertar');
            $data = null; // O podrías devolver un mensaje de error
        }
        break;

    case 2: //modificación
        $consulta = "UPDATE employees SET company_id = '$company_id', employee_Name = '$employee_Name', employee_Lastname = '$employee_Lastname', employee_Genero = '$employee_Genero', employee_Birthdate = '$employee_Birthdate', employee_EstadoCivil = '$employee_EstadoCivil', employee_UltimoNivelEstudio = '$employee_UltimoNivelEstudio', employee_Ocupacion = '$employee_Ocupacion', employee_ResidenciaDepartamento = '$employee_ResidenciaDepartamento', employee_ResidenciaCuidad = '$employee_ResidenciaCuidad', employee_EstratoSocial = '$employee_EstratoSocial', employee_TipoVivienda = '$employee_TipoVivienda', employee_PersonasACargo = '$employee_PersonasACargo', employee_TrabajoDepartamento = '$employee_TrabajoDepartamento', employee_TrabajoCuidad = '$employee_TrabajoCuidad', employee_TiempoEnEmpresa = '$employee_TiempoEnEmpresa', employee_NombreCargo = '$employee_NombreCargo', employee_TipoCargo = '$employee_TipoCargo', employee_TiempoEnCargo = '$employee_TiempoEnCargo', employee_NombreArea = '$employee_NombreArea', employee_TipoContrato = '$employee_TipoContrato', employee_HorasLaborales = '$employee_HorasLaborales', employee_TipoSalario = '$employee_TipoSalario' WHERE employee_Id = '$employee_Id'";		
        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT employee_Id, company_id, employee_Name, employee_Lastname, employee_Genero, employee_Birthdate, employee_EstadoCivil, employee_UltimoNivelEstudio, employee_Ocupacion, employee_ResidenciaDepartamento, employee_ResidenciaCuidad, employee_EstratoSocial, employee_TipoVivienda, employee_PersonasACargo, employee_TrabajoDepartamento, employee_TrabajoCuidad, employee_TiempoEnEmpresa, employee_NombreCargo, employee_TipoCargo, employee_TiempoEnCargo, employee_NombreArea, employee_TipoContrato, employee_HorasLaborales, employee_TipoSalario FROM employees WHERE employee_Id='$employee_Id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;   

    case 3://baja
        $consulta = "DELETE FROM employees WHERE employee_Id='$employee_Id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
