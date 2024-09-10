<?php
// Incluir el archivo de conexión a la base de datos
require_once './bd/conexion.php';

try {
    // Obtener los valores del formulario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    session_start();
    $_SESSION['usuario'] = $usuario;

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
        // Obtener los datos del usuario
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Guardar el rol en la sesión
        $_SESSION['role_id'] = $usuarioData['role_id']; // Se asume que la tabla users tiene una columna 'role_id'

        // Redirigir según el rol del usuario
        if ($usuarioData['role_id'] === 1) {
            header("Location: admin_dashboard.php");
        } elseif ($usuarioData['role_id'] === 2) {
            header("Location: operador_dashboard.php");
        } else {
            // Si el rol no es válido, puedes redirigir a un error o a una página predeterminada
            echo "<script>alert('Rol de usuario no válido.'); window.location.href = 'login.php';</script>";
        }
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
