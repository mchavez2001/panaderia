<?php
// Cargar variables del entorno
require_once __DIR__ . '/config.php';

// Obtener valores del .env
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$name = getenv('DB_NAME');

// Validar que las variables existen
if (!$host || !$user || !$name) {
    die("Error: faltan variables de entorno para la conexión a la base de datos. 
         Verifica tu archivo .env");
}

// Definir constantes (manteniendo compatibilidad con código existente)
if (!defined('DB_HOST')) define('DB_HOST', $host);
if (!defined('DB_USER')) define('DB_USER', $user);
if (!defined('DB_PASS')) define('DB_PASS', $pass);
if (!defined('DB_NAME')) define('DB_NAME', $name);

/**
 * Conexión global a base de datos (usada por todos los DAO)
 */
function db_connect()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Fallo en la conexión: " . $conn->connect_error);
    }

    return $conn;
}
?>
