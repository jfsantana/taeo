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
  echo json_encode(['error' => 'idArea not EXISTE']);
  exit();
}
if (!isset($_POST['nivelObjetivo'])) {
  echo json_encode(['error' => 'nivelObjetivo not EXISTE']);
  exit();
}
if (!isset($_POST['nivelNodo'])) {
  echo json_encode(['error' => 'nivelNodo not EXISTE']);
  exit();
}
if (!isset($_POST['valorPadre'])) {
  echo json_encode(['error' => 'valorPadre not EXISTE']);
  exit();
}

/*!SECTION
valorPadre
01 nivel padre

nivel hijo 1 01.02
*/


$idArea = $_POST['idArea'];
$nivelObjetivo = $_POST['nivelObjetivo'];
$nivelNodo = $_POST['nivelNodo'];
$valorPadre = $_POST['valorPadre'];


$token = $_SESSION['token'];

// Realiza la solicitud a la API para obtener los VALORES DEL PROXIMO SELECT
$URL = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/planning?type=3&idArea=$idArea&nivelObjetivo=$nivelObjetivo&nivel_nodo=$nivelNodo&valor_padre=$valorPadre";
$rs = API::GET($URL, $token);
$arrayNivelAreaObjetivo = API::JSON_TO_ARRAY($rs);

// Indica si un Nodo es abuelo
$URL = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/planning?type=4&jerarquia=$valorPadre&nivelObjetivo=$nivelObjetivo&idAreaObjetivo=$idArea";
$rs = API::GET($URL, $token);
$arrayAbuelo = API::JSON_TO_ARRAY($rs);





$response = [
  'abuelo' => $arrayAbuelo[0]['result'],
  'valores' => $arrayNivelAreaObjetivo
];

// Devuelve los niveles en formato JSON
//echo json_encode($arrayNivelAreaObjetivo);
echo json_encode($response);
?>
