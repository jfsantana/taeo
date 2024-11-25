<?php
// busqueda de los distintos aprendices activos creados
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/aprendiz?type=1";
$rs         = API::GET($URL, $token);
$arrayAprendices  = API::JSON_TO_ARRAY($rs);

//Sedes
$URL1        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/sede?type=1";
$rs         = API::GET($URL1, $token);
$arraySede  = API::JSON_TO_ARRAY($rs);

//facilitadores
$URL1        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/empleados?type=3&rolUsuario=3";
$rs         = API::GET($URL1, $token);
$arrayFacilitadores  = API::JSON_TO_ARRAY($rs);




$flag=true;
$accion = "Actualizar";
$disabled = 'disabled';

//datos Representante
$idHeaderEvaluacion = @$_POST["id"];

//consulta de los header
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=1&idHeaderEvaluacion=$idHeaderEvaluacion";
$rs         = API::GET($URL, $token);
$arrayHeader  = API::JSON_TO_ARRAY($rs);



//VARIABLES PARA EDICION
$idHeaderEvaluacion = @$arrayHeader[0]['idHeaderEvaluacion'];
$fechaUltimaEvaluacion = @$arrayHeader[0]['fechaUltimaEvaluacion'];
$fechaEvaluacion = @$arrayHeader[0]['fechaEvaluacion'];
$conclucionesRecomendaciones = @$arrayHeader[0]['conclucionesRecomendaciones'];
$idAprendiz = @$arrayHeader[0]['idAprendiz'];
$idEvaluadoPor = @$arrayHeader[0]['idEvaluadoPor'];
$idSede = @$arrayHeader[0]['idSede'];
$activo = @$arrayHeader[0]['activo'];
$observacion = @$arrayHeader[0]['observacion'];
$creadoPor = @$arrayHeader[0]['creadoPor'];
$fechaNacimientoAprendiz = @$arrayHeader[0]['fechaNacimientoAprendiz'];
$nombreAprendiz= @$arrayHeader[0]['apellidoAprendiz'].', '.@$arrayHeader[0]['nombreAprendiz'];
$nombreAprendizAux= '('.$nombreAprendiz.')';
$anioAprendiz=edadAprendiz($fechaNacimientoAprendiz);

$cedulaAprendiz = @$arrayHeader[0]['cedulaAprendiz'];
$direccionAprendiz = @$arrayHeader[0]['direccionAprendiz'];


$idNivelEvaluacion= @$_POST["idNivelEvaluacion"];
$edadCronologica= @$_POST["edadCronologica"];
$idAreaEvaluacion= @$_POST["idAreaEvaluacion"];

//echo $fechaUltimaEvaluacion;

//consulta de los Padres del aprediz
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/aprendiz?type=2&idAprendiz=".$idAprendiz;
$rs         = API::GET($URL, $token);
$arrayPadres  = API::JSON_TO_ARRAY($rs);

 //consulta de los Evaluadores  de la Evaluacion
 $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=8&idHeaderEvaluacion=".$idHeaderEvaluacion;
 $rs         = API::GET($URL, $token);
 $arrayEvaluadores  = API::JSON_TO_ARRAY($rs);


//consulta de los NIVELES PARA LA CREACION
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=6";
$rs         = API::GET($URL, $token);
$arrayNiveles  = API::JSON_TO_ARRAY($rs);

//consulta de los ITEMS PARA LA CREACION
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=5";
$rs         = API::GET($URL, $token);
$arrayItemCreate  = API::JSON_TO_ARRAY($rs);

//consulta las calificaciones de una evaluaicon
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/evaluacion?type=3";
$rs         = API::GET($URL, $token);
$arrayEvaluacion  = API::JSON_TO_ARRAY($rs);

//consulta de los ITEMS PARA LA CREACION
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=7&idHeaderEvaluacion=$idHeaderEvaluacion";
$rs         = API::GET($URL, $token);
$arrayResumen  = API::JSON_TO_ARRAY($rs);

//consulta de los items
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=2";
$rs         = API::GET($URL, $token);
$arrayItemByHeader  = API::JSON_TO_ARRAY($rs);

?>