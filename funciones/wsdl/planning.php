<?php

// ARCHIVO BASE PARA LOS SERVICIOS
require_once 'clases/respuestas.class.php';
require_once 'clases/planning.class.php';
require '../../vendor/autoload.php';

$_respuestas = new respuestas();
$_planning = new planning();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /*****!SECTION
   * type:
   * 1 listar todos los header de los Planificaciones o el detalle de uno si se envia idObjetivoHeader
   * 2 listar el numero de Planificaicones por sedes
   * 3 TRAE TODOS LOS HIJOS DE UN NODO (idArea, nivelObjetivo, nivel_nodo, valor_padre)
   * 4 indica el true si NO es el ultimo padre de la cadena

   */
  if ($_GET['type']==1){
    $datosArray = $_planning->getPlanningHeadere(@$_GET['idPlanificacion'],@$_GET['sede'],@$_GET['idFacilitador']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif ($_GET['type']==2){
    $datosArray = $_planning->getPlanningbySede(@$_GET['idPlanificacion']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif ( $_GET['type']==3
            && isset($_GET['idArea'])
            && isset($_GET['nivelObjetivo'])
            && isset($_GET['nivel_nodo'])
            && isset($_GET['valor_padre'])
            ){
    $datosArray = $_planning->getNodosHijos(@$_GET['idArea'],@$_GET['nivelObjetivo'],@$_GET['nivel_nodo'],@$_GET['valor_padre']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif ( $_GET['type']==4
            && isset($_GET['jerarquia'])
            && isset($_GET['nivelObjetivo'])
            && isset($_GET['idAreaObjetivo'])
            ){
    $datosArray = $_planning->getUltimoPadre(@$_GET['jerarquia'],$_GET['nivelObjetivo'],$_GET['idAreaObjetivo']);
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($datosArray);
    
  }elseif ( $_GET['type']==5
            && isset($_GET['idPlanificacionHeader'])
            ){
      $datosArray = $_planning->getNumPadres(@$_GET['idPlanificacionHeader']);
      header('Content-Type: application/json;charset=utf-8');
      http_response_code(200);
      echo json_encode($datosArray);
      
  }elseif ( $_GET['type']==6){
      $datosArray = $_planning->getIemsByHeader(@$_GET['idPlanificacionHeader'],@$_GET['jerarquia']);

      header('Content-Type: application/json;charset=utf-8');
      http_response_code(200);
      echo json_encode($datosArray);
      
      }
  elseif ( $_GET['type']==7){
        $datosArray = $_planning->getPlanningHeadereActivo(@$_GET['idPlanificacion'],@$_GET['sede']);
  
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

  $datosArray = $_planning->post($postBody);

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
    $datosArray = $_planning->put($postBody);

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
      $postBody = json_encode($_POST);
  } 
  $datosArray = $_planning->del($postBody);

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
