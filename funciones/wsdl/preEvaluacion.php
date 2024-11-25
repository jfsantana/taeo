<?php

// ARCHIVO BASE PARA LOS SERVICIOS
require_once 'clases/respuestas.class.php';
require_once 'clases/preEvaluacion.class.php';
require '../../vendor/autoload.php';

$_respuestas = new respuestas();
$_preEvaluacion = new preEvaluacion();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /*****!SECTION
   * type:
   * 1 listar todos los header de los _preEvaluacion o el detalle de uno si se envia idHeaderEvaluacion
   * 1.1 para listar los representantes de un aprendeiz http://taeo/funciones/wsdl/aprendiz?type=2&idAprendiz=1
   * 2 listar todos los Items de una preEvaluacion recibe idHeader= (id del preEvaluacion)
   * 3 Listas todos los detalles de cada Items de una preEvaluacion recibe id_padre= (id de lItems)
   * 4 todas las evaluaciones de un aprediz recibe idAprendiz= (id del aprendiz)
   *  5 lista todas las areas para una evaluacion
   * 6 lista todos los niveles
   * 7 resumen de evaluacion por header
   * 8 nombre de los evaluadores de una PreEvaluacion (idHeaderEvaluacion)
   * 
   

   */
  if ($_GET['type']==1){
    $datosArray = $_preEvaluacion->getHeader(@$_GET['idHeaderEvaluacion']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }elseif(($_GET['type']==2)){
    $datosArray = $_preEvaluacion->getItemsByHeader(@$_GET['idHeaderEvaluacion']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }elseif(($_GET['type']==3)){
    $datosArray = $_preEvaluacion->getDetalleByIems(@$_GET['idItemEvaluacion']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }elseif(($_GET['type']==4)){
    $datosArray = $_preEvaluacion->getPreEvaluacioensByAprendiz(@$_GET['idAprendiz']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }elseif(($_GET['type']==5)){
    $datosArray = $_preEvaluacion->getItemsAll();
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }elseif(($_GET['type']==6)){
    $datosArray = $_preEvaluacion->getNivelesAll();
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }elseif(($_GET['type']==7)){
    $datosArray = $_preEvaluacion->getResumenEva(@$_GET['idHeaderEvaluacion']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }elseif(($_GET['type']==8)){
    $datosArray = $_preEvaluacion->getEvaluadoresData(@$_GET['idHeaderEvaluacion']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
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

  $datosArray = $_preEvaluacion->post($postBody);

    header('Content-Type: application/json;charset=utf-8');
  if (isset($datosArray['result']['error_id'])) {
    $responseCode = $datosArray['result']['error_id'];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }
  echo json_encode($datosArray);
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') { // PUT  UPDATER

  $postBody = file_get_contents('php://input');

    $datosArray = $_preEvaluacion->put($postBody);

    header('Content-Type: application/json;charset=utf-8');
    if (isset($datosArray['result']['error_id'])) {
        $responseCode = $datosArray['result']['error_id'];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($datosArray);

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') { // DELETE
  $postBody = file_get_contents('php://input');

  $datosArray = $_preEvaluacion->delete($postBody);

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
