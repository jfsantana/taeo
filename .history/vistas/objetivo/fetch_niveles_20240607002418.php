<?php
// Inicia sesión si no está iniciada
if (!isset($_SESSION)) {
  session_start();
}

// Verifica si el usuario está autenticado
if (!isset($_SESSION['id_user'])) {
  echo json_encode(['error' => 'User not authenticated']);
  exit();
}

// Incluye la clase para el consumo de la API
require_once '../../funciones/wsdl/clases/consumoApi.class.php';


// Verifica si se ha enviado el ID del área
if (!isset($_POST['idArea'])) {
  echo json_encode(['error' => 'idArea not set']);
  exit();
}

$idAreaObjetivo = $_POST['idArea'];
$token = $_SESSION['token'];

// Realiza la solicitud a la API para obtener los niveles del área
$URL = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/nivelArea?type=2&idAreaObjetivo=" . $idAreaObjetivo;
$rs = API::GET($URL, $token);
$arrayNivelAreaObjetivo = API::JSON_TO_ARRAY($rs);

// Devuelve los niveles en formato JSON
echo json_encode($arrayNivelAreaObjetivo);
?>
