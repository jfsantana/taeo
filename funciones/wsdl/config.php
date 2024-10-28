<?php

// ARCHIVO BASE PARA LOS SERVICIOS
require_once 'clases/respuestas.class.php';
require_once 'clases/config.class.php';

$_respuestas = new respuestas();
$_config = new config();
if ($_SERVER['REQUEST_METHOD'] == 'GET') { // Get READ

  /*****!SECTION
   * type:
   * 1 lista de Todas las configuraciones
   * 2 lista las configuraciones de un tipo 
   */

  if ($_GET['type']==1) {
    $getSede = $_config->getFieldConfig(@$_GET['idConfiguracion']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($getSede);
    http_response_code(200);
  } elseif ($_GET['type']==2) {
    $getSede = $_config->getFieldConfigType(@$_GET['tipo']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($getSede);
    http_response_code(200);
  } else {
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode(['error' => 'Parámetro type inválido']);
    http_response_code(400);
  }


} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST CREATE
  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_POST);
  }

  $datosArray = $_config->post($postBody);

  header('Content-Type: application/json;charset=utf-8');
  if (isset($datosArray['result']['error_id'])) {
    $responseCode = $datosArray['result']['error_id'];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }
  echo json_encode($datosArray);
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') { // PUT  UPDATER
  //$postBody = file_get_contents('php://input');
  //$postBody = json_encode($_POST);
  //13336768 ajuste para no cambiar las pruebas desde
  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_PUT);
  }
  //$datosArray = $_config->put($postBody);

  header('Content-Type: application/json;charset=utf-8');
  if (isset($datosArray['result']['error_id'])) {
    $responseCode = $datosArray['result']['error_id'];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }
  echo json_encode($datosArray);
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') { // DELETE
    //$postBody = file_get_contents('php://input');
  //$postBody = json_encode($_POST);
  //13336768 ajuste para no cambiar las pruebas desde
  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_DELETE);
  }
  //$datosArray = $_config->del($postBody);

  header('Content-Type: application/json;charset=utf-8');
  if (isset($datosArray['result']['error_id'])) {
    $responseCode = $datosArray['result']['error_id'];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }
  echo json_encode($datosArray);
} else {
  header('Content-Type: application/json;charset=utf-8');
  $datosArray = $_respuestas->error_405();
  echo json_encode($datosArray);
}
