<?php

// ARCHIVO BASE PARA LOS SERVICIOS
require_once 'clases/respuestas.class.php';
require_once 'clases/aprendiz.class.php';

$_respuestas = new respuestas();
$_aprendiz = new aprendiz();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /*****!SECTION
   * type:
   * 1 listar todos los aprendices, recibe el idAprendiz (opcional) para busacr un aprendiz
   * 2 listar los representante de un aprendiz activos
   * 3 listar los representante de un aprendiz activos
   * 4 listado de aprendices activos
   * 5 Listao de aprendices por pais
   */
  if ($_GET['type']==1){
    $datosArray = $_aprendiz->getAprendiz(@$_GET['idAprendiz']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif(($_GET['type']==2)||(isset($_GET['idAprendiz']))){
    $datosArray = $_aprendiz->getRepresentanteByAprendizActivos(@$_GET['idAprendiz']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif(($_GET['type']==3)||(isset($_GET['idAprendiz']))){
    $datosArray = $_aprendiz->getRepresentanteByAprendiz(@$_GET['idAprendiz']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif(($_GET['type']==4)){
    $datosArray = $_aprendiz->getAprendizActivos(@$_GET['idAprendiz']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif(($_GET['type']==5)){
    $datosArray = $_aprendiz->getAprendizByCountryByUser(@$_GET['idUsuario']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST CREATE

  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_POST);
  }

  $datosArray = $_aprendiz->post($postBody);

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

  //$datosArray = $_aprendiz->put($postBody);

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

  $datosArray = $_aprendiz->del($postBody);

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
