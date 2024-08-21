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
    $nombreJuego = $_POST['nombreJuego'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $plataforma = $_POST['plataforma'];
    $fechaLanzamiento = $_POST['fechaLanzamiento'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO Juegos (NombreJuego, Descripcion, Precio, Plataforma, FechaLanzamiento, Stock) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsdi", $nombreJuego, $descripcion, $precio, $plataforma, $fechaLanzamiento, $stock);

    if ($stmt->execute()) {
        echo "Juego creado exitosamente";
    } else {
        echo "Error al crear juego: " . $conn->error;
    }
}

$conn->close();
?>
