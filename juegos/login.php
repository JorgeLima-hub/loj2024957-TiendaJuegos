<?php
session_start();
$host = "localhost"; // Nombre del host
$user = "root";      // Usuario de la base de datos
$pass = "";          // Contraseña del usuario
$dbname = "TiendaJuegos"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se enviaron los datos del formulario
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para buscar al usuario en la base de datos
    $sql = "SELECT * FROM Usuarios WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($password, $user['Contrasena'])) {
            // Iniciar sesión y redirigir al usuario
            $_SESSION['UsuarioID'] = $user['UsuarioID'];
            $_SESSION['NombreUsuario'] = $user['NombreUsuario'];
            header("Location: inicio.html"); // Redirige al usuario a su dashboard
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró una cuenta con ese correo electrónico.";
    }
} else {
    echo "Por favor, complete todos los campos.";
}

$conn->close();
?>
