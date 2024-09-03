<?php
// Incluir el archivo de conexión a la base de datos
require_once './bd/conexion.php';

try {
    // Obtener los valores del formulario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Establecer la conexión
    $conexion = Conexion::Conectar();

    // Consulta SQL con placeholders para evitar inyecciones SQL
    $query = "SELECT * FROM users WHERE users_email = :usuario AND password_hash = :password";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    
    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si se encontró un resultado
    if ($stmt->rowCount() > 0) {
        // Usuario y contraseña válidos, redirigir a index.php
        header("Location: index.php");
        exit(); // Importante para detener la ejecución del script
    } else {
        // Usuario y/o contraseña incorrectos, mostrar alerta en JS
        echo "<script>alert('Usuario y/o contraseña incorrectos'); window.location.href = 'login.php';</script>";
    }

} catch (Exception $e) {
    // Capturar cualquier error y mostrar un mensaje apropiado
    error_log("Error en el inicio de sesión: " . $e->getMessage());
    echo "<script>alert('Ocurrió un problema durante el inicio de sesión. Por favor, inténtelo de nuevo más tarde.'); window.location.href = 'login.php';</script>";
}
?>