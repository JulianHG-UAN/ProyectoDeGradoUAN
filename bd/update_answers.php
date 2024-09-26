<?php
include_once('../bd/conexion.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS
$answers = isset($_POST['answers']) ? $_POST['answers'] : [];

if (empty($answers)) {
    echo json_encode(["error" => "No se recibieron respuestas"]);
    exit();
}

try {
    // Iniciar transacción
    $conexion->beginTransaction();

    foreach ($answers as $answer) {
        $employee_id = $answer['employee_id'];
        $question_id = $answer['question_id'];
        $answer_value = $answer['answer_value'];

        // Preparar consulta de actualización
        $consulta = "UPDATE answers 
                     SET answer_value = :answer_value
                     WHERE employee_id = :employee_id AND question_id = :question_id";		

        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $resultado->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $resultado->bindParam(':answer_value', $answer_value, PDO::PARAM_INT);

        // Ejecutar actualización
        $resultado->execute();
    }

    // Confirmar la transacción
    $conexion->commit();
    echo json_encode(["message" => "Respuestas actualizadas correctamente"]);

} catch (PDOException $e) {
    // Registrar el error y revertir la transacción
    $conexion->rollBack();
    error_log("Error en la consulta SQL: " . $e->getMessage());
    echo json_encode(["error" => "Error en la base de datos"]);
} finally {
    $conexion = null; // Cerrar la conexión
}
?>