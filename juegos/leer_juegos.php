<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "TiendaJuegos";
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM Juegos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['JuegoID'] . " - Nombre: " . $row['NombreJuego'] . " - Precio: " . $row['Precio'] . " - Stock: " . $row['Stock'] . "<br>";
    }
} else {
    echo "No se encontraron juegos.";
}

$conn->close();
?>
