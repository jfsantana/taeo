<?php

// ARCHIVO BASE PARA LOS SERVICIOS
require_once 'clases/respuestas.class.php';
require_once 'clases/event.class.php';

$_respuestas = new respuestas();
$_event = new event();
if ($_SERVER['REQUEST_METHOD'] == 'GET') { // Get READ

  /*****!SECTION
   * type:
   * 1 lista de eventos desc por fecha
   * 2 consulta de 1 evento por id
   */

  if ($_GET['type']==1) {
    $getSede = $_event->getAllEvent();
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($getSede);
    http_response_code(200);

  } elseif ($_GET['type']==2) {

    $getEmpleados = $_event->getEvent(@$_GET['idEvento']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($getEmpleados);
    http_response_code(200);
  }



  else {
    http_response_code(500);
  }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST CREATE
   if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
   } else {
      $postBody = json_encode($_POST);
   }

  $datosArray = $_event->post($postBody);

  header('Content-Type: application/json;charset=utf-8');
  if (isset($datosArray['result']['error_id'])) {
    $responseCode = $datosArray['result']['error_id'];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }
  echo json_encode($datosArray);
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') { // PUT  UPDATER
  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_PUT);
  }
  $datosArray = $_event->put($postBody);

  header('Content-Type: application/json;charset=utf-8');
  if (isset($datosArray['result']['error_id'])) {
    $responseCode = $datosArray['result']['error_id'];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }
  echo json_encode($datosArray);
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') { // DELETE

} else {
  header('Content-Type: application/json;charset=utf-8');
  $datosArray = $_respuestas->error_405();
  echo json_encode($datosArray);
}
