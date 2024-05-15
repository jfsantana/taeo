<?php

// ARCHIVO BASE PARA LOS SERVICIOS
require_once 'clases/respuestas.class.php';
require_once 'clases/representante.class.php';

$_respuestas = new respuestas();
$_representante = new representante();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /*****!SECTION
   * type:
   * 1 listar todos los header de los objetivos
   * 2 Detalles de un objetivoHeader
   * 3 Lista de los Items de un padre
   * 4 Lista los items de un objetivo
   * 5 Destalle de un itemHeader
   */
  if ($_GET['type']==1){
    $datosArray = $_representante->getHeaderebyObjetivos(@$_GET['idObjetivoHeader']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }elseif(($_GET['type']==2)||(isset($_GET['idObjetivoHeader']))){
    $datosArray = $_representante->getIemsByHeader(@$_GET['idObjetivoHeader']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }elseif(($_GET['type']==3)||(isset($_GET['id_padre']))){
    $datosArray = $_representante->getIemsByPadre(@$_GET['id_padre']);
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

  $datosArray = $_representante->post($postBody);

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

  //$datosArray = $_representante->put($postBody);

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

  $datosArray = $_representante->del($postBody);

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
