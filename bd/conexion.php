<?php 
class Conexion {
    private static $conexion = null;

    public static function Conectar() {
        if (self::$conexion === null) {
            define('SERVIDOR', getenv('DB_HOST') ?: 'localhost');
            define('NOMBRE_BD', getenv('DB_NAME') ?: 'psymetrics');
            define('USUARIO', getenv('DB_USER') ?: 'phpmyadmin');
            define('PASSWORD', getenv('DB_PASSWORD') ?: '7592db');
            
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            
            try {
                self::$conexion = new PDO("mysql:host=" . SERVIDOR . ";dbname=" . NOMBRE_BD, USUARIO, PASSWORD, $opciones);
            } catch (Exception $e) {
                // En lugar de die(), podrías usar error_log() para registrar el error.
                error_log("El error de Conexión es: " . $e->getMessage());
                throw new Exception("No se pudo conectar a la base de datos.");
            }
        }

        return self::$conexion;
    }
}