<?php
// Configuración de la base de datos
$servername = "127.0.0.1";
$username = "root"; // Cambia esto si tienes un usuario diferente
$password = ""; // Cambia esto si tienes una contraseña
$dbname = "nombre_de_tu_base_de_datos"; // Cambia esto al nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Encriptar la contraseña
$estadoCivil = $_POST['estadoCivil'];
$edad = $_POST['edad'];
$ciudad = $_POST['ciudad'];
$profesion = $_POST['profesion'];
$datosAdicionales = $_POST['datosAdicionales'];

// Preparar y vincular
$stmt = $conn->prepare("INSERT INTO usuario (nombre, correo, contrasena, estadoCivil, edad, ciudad, profesion, datosAdicionales) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssisss", $nombre, $correo, $contrasena, $estadoCivil, $edad, $ciudad, $profesion, $datosAdicionales);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>