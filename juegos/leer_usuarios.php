<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "TiendaJuegos";
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM Usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['UsuarioID'] . " - Nombre: " . $row['NombreUsuario'] . " - Email: " . $row['Email'] . "<br>";
    }
} else {
    echo "No se encontraron usuarios.";
}

$conn->close();
?>
