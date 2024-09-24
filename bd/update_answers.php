<?php
include_once('../bd/conexion.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS
$employee_id = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';
$question_id = isset($_POST['question_id']) ? $_POST['question_id'] : '';
$answer_value = isset($_POST['answer_value']) ? $_POST['answer_value'] : '';

// Verificar que todos los datos requeridos estén presentes
if (empty($answer_value) || empty($employee_id) || empty($question_id)) {
    echo json_encode(["error" => "Datos incompletos"]);
    exit();
}

// Validar que los datos sean números enteros (dependiendo de tus requisitos)
if (!is_numeric($answer_value) || !is_numeric($employee_id) || !is_numeric($question_id)) {
    echo json_encode(["error" => "Los datos deben ser numéricos"]);
    exit();
}

try {
    // Iniciar transacción
    $conexion->beginTransaction();

    // Preparar consulta de actualización
    $consulta = "UPDATE answers 
                 SET answer_value = :answer_value
                 WHERE employee_id = :employee_id AND question_id = :question_id";		

    $resultado = $conexion->prepare($consulta);
    $resultado->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $resultado->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $resultado->bindParam(':answer_value', $answer_value, PDO::PARAM_INT);

    // Ejecutar actualización y verificar si alguna fila fue afectada
    $resultado->execute();
    if ($resultado->rowCount() > 0) {
        // Si se actualizó, realizar consulta del registro actualizado
        $consulta = "SELECT * FROM answers WHERE employee_id = :employee_id AND question_id = :question_id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $resultado->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

        // Confirmar la transacción
        $conexion->commit();

        // Devolver el resultado en formato JSON
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        // Si no se actualizó ninguna fila, devolver mensaje
        echo json_encode(["message" => "No se actualizó ningún registro"]);
    }

} catch (PDOException $e) {
    // Registrar el error, revertir la transacción, y devolver un mensaje de error genérico
    $conexion->rollBack();
    error_log("Error en la consulta SQL: " . $e->getMessage());
    echo json_encode(["error" => "Error en la base de datos"]);
} finally {
    $conexion = null; // Cerrar la conexión
}
?>
