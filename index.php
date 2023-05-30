<?php
/*
|| autor: Mario Andres Medrano Ricardo
|| Programa: Analisis y Desarrollo de software.
|| Ficha: 2521984
|| SENA
*/

// Se define la conexion a la base de datos.
$servername = "localhost";
$username = "root";
$password = "";
$db = "prueba";

// Se crea la conexión a la base de datos.
$conn = new mysqli($servername, $username, $password, $db);

// Verificamos la conexión a la base de datos.
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Creamos el registro de un usuario.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Agreamos al nuevo usuario en la base de datos.
    $sql = "INSERT INTO user (userName, userPassword) VALUES ('$username', '$password')";
    if ($conn->query($sql) === true) {
        echo "Registro exitoso";
    } else {
        echo "Error en el registro: " . $conn->error;
    }
}

// Creamos el inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verificamos si existe el usuario y contraseña en la base de datos.
    $sql = "SELECT * FROM user WHERE userName='$username' AND userPassword='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        echo "Autenticación satisfactoria";
    } else {
        echo "Error en la autenticación";
    }
}

// Finalizamos la conexión a la base de datos.
$conn->close();
?>
