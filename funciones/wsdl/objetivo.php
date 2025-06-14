<?php

// ARCHIVO BASE PARA LOS SERVICIOS
require_once 'clases/respuestas.class.php';
require_once 'clases/objetivo.class.php';
require '../../vendor/autoload.php';

$_respuestas = new respuestas();
$_objetivo = new objetivo();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /*****!SECTION
   * type:
   * 1 listar todos los header de los objetivos o el detalle de uno si se envia idObjetivoHeader
   * 2 listar nodos padres de un header
   * 3 Lista de los Items de un padre
   * 4 Lista las versiones de los Hijos de un Objetivo recibe idHeader= (id del objetivo)

   */
  if ($_GET['type']==1){
    $datosArray = $_objetivo->getObjetivosHeadere(@$_GET['idObjetivoHeader']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif(($_GET['type']==2)&&(isset($_GET['idHeader']))){
    $datosArray = $_objetivo->getidPadreByHeader(@$_GET['idHeader'],@$_GET['maxVersion']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif(($_GET['type']==3)&&(isset($_GET['id_padre']))){
    $datosArray = $_objetivo->getIemsByHeader(@$_GET['id_padre']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif(($_GET['type']==4)&&(isset($_GET['idHeader']))){
    $datosArray = $_objetivo->getVersionByHeader(@$_GET['idHeader']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif(($_GET['type']==5)&&(isset($_GET['idHeader']))){
    $datosArray = $_objetivo->getLastVersionByHeader(@$_GET['idHeader']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif(($_GET['type']==6)&&(isset($_GET['idArea']))&&(isset($_GET['idNivel']))){
    $datosArray = $_objetivo->getIdObjetivo(@$_GET['idArea'],@$_GET['idNivel'] );
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif(($_GET['type']==7)){
    $_objetivo->updateId_padre(@$_GET['idHeader'],@$_GET['versionObjetivo'] );
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode("success update padres");
    
  }elseif(($_GET['type']==8)){
     $datosArray = $_objetivo->getObjetivosHeaderePreView(@$_GET['idObjetivoHeader']);
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

  $datosArray = $_objetivo->post($postBody);

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
  print_r($_PUT); die;
    $datosArray = $_objetivo->put($postBody);

    header('Content-Type: application/json;charset=utf-8');
  if (isset($datosArray['result']['error_id'])) {
    $responseCode = $datosArray['result']['error_id'];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }
  echo json_encode($datosArray);

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') { // DELETE
  if (isset($_SERVER['HTTP_USER_AGENT']) || strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_POST);
      //$postBody = file_get_contents('php://input');
  }
  $datosArray = $_objetivo->del($postBody);

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
