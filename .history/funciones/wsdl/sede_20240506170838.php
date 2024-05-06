<?php

// ARCHIVO BASE PARA LOS SERVICIOS
require_once 'clases/respuestas.class.php';
require_once 'clases/sede.class.php';

$_respuestas = new respuestas();
$_sede = new sede();
if ($_SERVER['REQUEST_METHOD'] == 'GET') { // Get READ

  /*****!SECTION
   * type:
   * 1 lista sedes puede recibir el parametro de idSede
   * 2 Lista los empleados por Sede puede recibir idSede
   * 3 Lista las Sedes de un Empleado. recibe el idUsuario
   */

  if ($_GET['type']==1) {
    $getSede = $_sede->getSede(@$_GET['idSede']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($getSede);
    http_response_code(200);

  } elseif ($_GET['type']==2) {

    $getEmpleados = $_sede->getEmpleadoPorSede(@$_GET['idSede']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($getEmpleados);
    http_response_code(200);
  }
  elseif ($_GET['type']==3) {

    $getEmpleados = $_sede->getSedeByEmpleado(@$_GET['idEmpleado']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($getEmpleados);
    http_response_code(200);
  }



  else {
    http_response_code(200);
  }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST CREATE
  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_POST);
  }

  $datosArray = $_sede->post($postBody);

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
  $datosArray = $_sede->put($postBody);

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
  $datosArray = $_sede->del($postBody);

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
