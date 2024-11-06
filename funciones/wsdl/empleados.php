<?php

// ARCHIVO BASE PARA LOS SERVICIOS
require_once 'clases/respuestas.class.php';
require_once 'clases/empleados.class.php';

$_respuestas = new respuestas();
$_empleados = new empleados();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /*****!SECTION
   * type:
   * 1 listar todos los empleados, recibe el idUsuario (opcional) para busacr un usuario
   * 2 Lista los cargos disponibles
   * 3 Facilitadores por cargo
   * 4 Facilitadores por sede
   * 
   * 6 lista de sedes de un empleado
   */
  if (isset($_GET['token'])) { //TAEO LISTO
    $token = $_GET['token'];
    $datosEmpleado = $_empleados->obtenerEmpleadoToken($token);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }elseif($_GET['type']==1){
    $datosEmpleado = $_empleados->getEmpleado(@$_GET['idUsuario']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }elseif($_GET['type']==2){
    $datosEmpleado = $_empleados->getCargos(@$_GET['idUsuario']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }elseif($_GET['type']==3){
    $datosEmpleado = $_empleados->getFacilitadorByCargos(@$_GET['rolUsuario']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }elseif($_GET['type']==4){
    $datosEmpleado = $_empleados->getFacilitadorBySede(@$_GET['idSede']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }elseif($_GET['type']==5){
    $datosEmpleado = $_empleados->getEvaluadorBySede(@$_GET['idSede']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }elseif($_GET['type']==6){
    $datosEmpleado = $_empleados->getSedeByEvaluador(@$_GET['idUsuario']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }else {
    http_response_code(404);
  }


  

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST CREATE

  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_POST);
  }

  $datosArray = $_empleados->post($postBody);

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

  $datosArray = $_empleados->put($postBody);

    header('Content-Type: application/json;charset=utf-8');
  if (isset($datosArray['result']['error_id'])) {
    $responseCode = $datosArray['result']['error_id'];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }
  //echo json_encode($datosArray);

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') { // DELETE
  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_DELETE);
  }

  $datosArray = $_empleados->del($postBody);

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
