<?php
require_once '../../config/dbcn.php';

$conn = db_connect();

if ($conn) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error al conectar con la base de datos.";
}

$conn->close();
?>