<?php
// fetch_niveles.php
echo 'entro';
// Incluye aquí la lógica para conectar a la base de datos
include 'db_connection.php'; // Asegúrate de ajustar esto a tu configuración

if (isset($_POST['idArea'])) {
    $idArea = $_POST['idArea'];

    // Realiza la consulta para obtener los niveles
    $query = "SELECT idNivelAreaObjetivo, nombreNivelAreaObjetivo FROM niveles WHERE idArea = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idArea);
    $stmt->execute();
    $result = $stmt->get_result();

    $niveles = array();
    while ($row = $result->fetch_assoc()) {
        $niveles[] = $row;
    }

    echo json_encode($niveles);
}
?>
