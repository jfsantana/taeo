<?php

// ARCHIVO BASE PARA LOS SERVICIOS
require_once 'clases/respuestas.class.php';
require_once 'clases/nivelArea.class.php';

$_respuestas = new respuestas();
$_nivelArea = new nivelArea();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /*****!SECTION
   * type:
   * 1 listar todos los nivelAreas, recibe el idRepresentate (opcional) para busacr un usuario
   * 2 listar os niveles de un Nivel y si no teine los retorna todos
   */
  if ($_GET['type']==1){
    $datosArray = $_nivelArea->getNivelArea(@$_GET['idNivelAreaObjetivo']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }elseif($_GET['type']==2){
    $datosArray = $_nivelArea->getNivelByArea(@$_GET['idAreaObjetivo']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST CREATE

  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_POST);
  }

  $datosArray = $_nivelArea->post($postBody);

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

  //$datosArray = $_nivelArea->put($postBody);

    header('Content-Type: application/json;charset=utf-8');
  if (isset($datosArray['result']['error_id'])) {
    $responseCode = $datosArray['result']['error_id'];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }
  echo json_encode($datosArray);

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') { // DELETE
  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_DELETE);
  }

  $datosArray = $_nivelArea->del($postBody);

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

