<?php
if (!isset($_SESSION)) {
  session_start();
}
require_once '../wsdl/clases/consumoApi.class.php';

if ((@$_POST['user'] == '') && ($_POST['password'] == '')) {
  header('Location:../../index.php');
  exit;
}


$token = '';
//Update Token
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/auth?updateToken";
$rs         = API::GET($URL, $token);
$arrayCconsultora  = API::JSON_TO_ARRAY($rs);



$URL = 'http://' . $_SERVER['HTTP_HOST'] . '/funciones/wsdl/auth';
$parametros = [
  'usuario' => $_POST['user'],
  'password' => $_POST['password'],
  'locacion' => $_POST['locacion'],
];

$rs = API::POST($URL, $token, $parametros);
$rs = API::JSON_TO_ARRAY($rs);

//   echo $URL;
//   print("<pre>".print_r(json_encode($parametros),true)."</pre>");die;
  //print("<pre>".print_r(json_encode($rs),true)."</pre>");die;

if (@$rs['result']['token']) {

  $token = $rs['result']['token'];
  $URL = 'http://' . $_SERVER['HTTP_HOST'] . '/funciones/wsdl/empleados?token=' . $rs['result']['token'];
  $rs = API::GET($URL, $token);
  $array = API::JSON_TO_ARRAY($rs);
  $datosEmpleado = $array;
  echo $URL; die;
  if (!@$datosEmpleado) {
    header("Location:../../index.php?mensaje= Login No Autorizado");
    exit;
  }

  $_SESSION['usuario'] = $datosEmpleado[0]['loginUsuario'];
  $_SESSION['sede'] = $datosEmpleado[0]['idSede'];
  $_SESSION['id_user'] = @$datosEmpleado[0]['idUsuario'];
  $_SESSION['id_rol'] = @$datosEmpleado[0]['rolUsuario'];
  $_SESSION['perfil'] = @$datosEmpleado[0]['descripcionRol'];
  $_SESSION['token'] = $token;
  $_SESSION['nombre'] = @$datosEmpleado[0]['nombreUsuario'] . ', ' . @$datosEmpleado[0]['apellidoUsuario'];
  $_SESSION['cargo'] = @$datosEmpleado[0]['cargoUsuario'];
  $_SESSION['activo'] = @$datosEmpleado[0]['activoUsuario'];
  $_SESSION['HOY'] = @date('Y-m-d');

  $_SESSION['des_rol'] = @$datosEmpleado[0]['descripcionRol'];
  $_SESSION['last_activity'] = time();

  //echo $URL; die;

  foreach ($datosEmpleado as $dato) {
    //    print("<pre>".print_r(($dato),true)."</pre>");die;
    $_SESSION['idEmpresaConsultora'] = @$dato['idEmpresaConsultora'] . " " . @$_SESSION['idEmpresaConsultora'];
    $_SESSION['nombreEmpresaConsultora'] = @$dato['nombreEmpresaConsultora'] . " " . @$_SESSION['nombreEmpresaConsultora'];
  }

  $_SESSION['idEmpresaConsultora'] = trim($_SESSION['idEmpresaConsultora']);
  $_SESSION['nombreEmpresaConsultora'] = trim($_SESSION['nombreEmpresaConsultora']);

  // Actualizar la marca de tiempo de la última activid ad estoe s una prueba
  $_SESSION['last_activity'] = time();

  //print_r($_SESSION); die;

  $dia_actual = date('j'); // Obtener el día actual
  $dia_semana_actual = date('N'); // Obtener el día de la semana actual (1 para lunes, 7 para domingo)
  $_SESSION['corte'] = @date('mY');


  print_r(json_encode($_SESSION)); die;
  header('Location:../../vistas/home.php');
  exit;
} else {
  header("Location:../../index.php?mensaje= Login No Autorizado");
  exit;
}
