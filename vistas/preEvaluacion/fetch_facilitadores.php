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
if (!isset($_POST['idSede'])) {
  echo json_encode(['error' => 'idSede not set']);
  exit();
}

$idSedeObjetivo = $_POST['idSede'];
$token = $_SESSION['token'];

// Realiza la solicitud a la API para obtener los FACILITADORES DE CADA SEDE

$URL = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/empleados?type=5&idSede=" . $idSedeObjetivo;
$rs = API::GET($URL, $token);
$arrayNivelAreaObjetivo = API::JSON_TO_ARRAY($rs);

// Devuelve los niveles en formato JSON
echo json_encode($arrayNivelAreaObjetivo);
?>
