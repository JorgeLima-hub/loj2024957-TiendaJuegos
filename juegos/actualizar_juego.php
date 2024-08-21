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
    $juegoID = $_POST['juegoID'];
    $nombreJuego = $_POST['nombreJuego'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $plataforma = $_POST['plataforma'];
    $fechaLanzamiento = $_POST['fechaLanzamiento'];
    $stock = $_POST['stock'];

    $sql = "UPDATE Juegos SET NombreJuego = ?, Descripcion = ?, Precio = ?, Plataforma = ?, FechaLanzamiento = ?, Stock = ? WHERE JuegoID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsdii", $nombreJuego, $descripcion, $precio, $plataforma, $fechaLanzamiento, $stock, $juegoID);

    if ($stmt->execute()) {
        echo "Juego actualizado exitosamente";
    } else {
        echo "Error al actualizar juego: " . $conn->error;
    }
}

$conn->close();
?>
