<?php

// ARCHIVO BASE PARA LOS SERVICIOS
require_once 'clases/respuestas.class.php';
require_once 'clases/evaluacion.class.php';
require '../../vendor/autoload.php';

$_respuestas = new respuestas();
$_evaluacion = new evaluacion();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /*****!SECTION
   * type:

   * 1 listar todos los header POR $idPlanificacion, $idsede, $idFacilitador
   * 2 TRAE LOS DETALLES de la JERARQUA DE UNA ACTIVIDAD POR SU ID
   * 3 trae todos los los valores posibles de la evaluacion
   * 4 saber si tiene evaluacion inicial
   * 5 Lista las evaluaciones de una actividad
   * 6 DETALLED E UNA EVALUACION POR SU ID
   */
  if ($_GET['type']==1){
    $datosArray = $_evaluacion->getPlanningHeadere(@$_GET['idPlanificacion'], @$_GET['idsede'], @$_GET['facilitador']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }elseif($_GET['type']==2){
    $datosEmpleado = $_evaluacion->getActividadById(@$_GET['idItems']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }elseif($_GET['type']==3){
    $datosEmpleado = $_evaluacion->getValueEval();
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }elseif($_GET['type']==4){
    $datosEmpleado = $_evaluacion->getEvaInicialByItems(@$_GET['idItem']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }elseif($_GET['type']==5){
    $datosEmpleado = $_evaluacion->getEvalByItems(@$_GET['idItem']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }elseif($_GET['type']==6){
    $datosEmpleado = $_evaluacion->getEvalById(@$_GET['idEvaluacion']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }elseif($_GET['type']==7){
    $datosEmpleado = $_evaluacion->getPlanningHeadereActivo(@$_GET['idPlanificacion'], @$_GET['idsede'], @$_GET['facilitador']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }

  else {
    header('Content-Type: application/json;charset=utf-8');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
  }

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST CREATE

  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_POST);
  }

  $datosArray = $_evaluacion->post($postBody);

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
    $datosArray = $_evaluacion->put($postBody);

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

  //$datosArray = $_evaluacion->del($postBody);

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
