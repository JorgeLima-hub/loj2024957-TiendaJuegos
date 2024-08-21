<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "TiendaJuegos";
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuarioID = $_POST['usuarioID'];
    $nombreUsuario = $_POST['nombreUsuario'];
    $email = $_POST['email'];

    $sql = "UPDATE Usuarios SET NombreUsuario = ?, Email = ? WHERE UsuarioID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombreUsuario, $email, $usuarioID);

    if ($stmt->execute()) {
        echo "Usuario actualizado exitosamente";
    } else {
        echo "Error al actualizar usuario: " . $conn->error;
    }
}

$conn->close();
?>
