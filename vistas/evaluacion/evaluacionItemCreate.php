<?php

if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';

//print("<pre>".print_r(($_POST) ,true)."</pre>"); //die;

 $datos= explode("-", $_POST['id']);

 $idItems =$datos[0];
 $idPlanificacionHeader = $datos[1];
 $fechaEvaluacion=  date('d-m-Y');
 $objetivo =$datos[1];
 
 $token='';

 if (@$_POST['mod'] == 1) {
  $accion = "Crear";
  } elseif(@$_POST['mod'] == 2) {
    $accion = "Editar";

  
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/evaluacion?type=6&idEvaluacion=".$_POST['idItem'];
  $rs         = API::GET($URL, $token);
  $arrayEvaluacion  = API::JSON_TO_ARRAY($rs);

  $idEvaluacion = $arrayEvaluacion[0]['idEvaluacion'];

  $idItems = $arrayEvaluacion[0]['idItems'];
  $tipo = $arrayEvaluacion[0]['tipo'];
  $idValorEvaluacion = $arrayEvaluacion[0]['idValorEvaluacion'];
  $observacionEvaluacion = $arrayEvaluacion[0]['observacionEvaluacion'];
  $evaluadoPor = $arrayEvaluacion[0]['evaluadoPor'];
  $fechaEvaluacion = $arrayEvaluacion[0]['fechaEvaluacion'];
  echo $idEvaluacion;
}else{
  $accion = "Crear";
  @$_POST['mod'] = 1;
}

$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/evaluacion?type=2&idItems=$idItems";
echo $URL;
$rs         = API::GET($URL, $token);
$arrayActividad  = API::JSON_TO_ARRAY($rs);


$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/evaluacion?type=3";
$rs         = API::GET($URL, $token);
$arrayValoresEvaluaciones  = API::JSON_TO_ARRAY($rs);

/**********VALIDACIONES*************** */
// QUE TENGA AL MENOS UNA EVALUACION INICIAL ANTES DE PODER HACER LAS PLANIFICADAS, esto se busca en la tabla planificacion_evaluacion en el campo tipo de evaluacion
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/evaluacion?type=4&idItem=$idItems";
$rs         = API::GET($URL, $token);
$arrayEvaInicial  = API::JSON_TO_ARRAY($rs);

if (!is_array($arrayEvaInicial) || count($arrayEvaInicial) == 0) {
    $falgEvaInicial = false;
} else {
    $falgEvaInicial = true;
}


//EL NUMERO DE registros de avances PLANIFICADAS LAS ESPECIFICA LA CABECEA DE LA PLANIFICACION $idPlanificacionHeader 
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/planning?type=1&idPlanificacion=$idPlanificacionHeader";
$rs         = API::GET($URL, $token);
$arrayHeaderPlanificacion  = API::JSON_TO_ARRAY($rs);

$numEvaluacionesPermitidas=$arrayHeaderPlanificacion[0]['periodoEvaluacion'] ;


$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/evaluacion?type=5&idItem=$idItems";
$rs         = API::GET($URL, $token);
$arrayEvaluaciones  = API::JSON_TO_ARRAY($rs);
$numEvaluacionesPlanificadas=0;
$numEvaluacionesIniciales=0;
$numEvaluacionestotales=count($arrayEvaluaciones);

// necesito recorrer arrayEvaluaciones para saber cuantas evaluaciones planificadas tiene la actividad preguntando en el capo tipo
foreach ($arrayEvaluaciones as $evaluaciones) {
  if ($evaluaciones['tipo'] == 'Planificada') {
    $numEvaluacionesPlanificadas++;
  }else{
    $numEvaluacionesIniciales++;
  }
}
if ($numEvaluacionesPlanificadas<$numEvaluacionesPermitidas) {
  $falgPermitirEvaluacion = true;
  $disabled='';
}else{
  $falgPermitirEvaluacion = false;
  $disabled='disabled';
}

?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Creacion de una Evaluacion  </h1>
      </div>
    </div>
  </div>
</div>

<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_evaluacionItem.model.php" method="post" name="consultora" id="consultora">
  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idItems" value="<?php echo @$idItems ?>">
  <input type="hidden" name="idPlanificacionHeader" value="<?php echo @$idPlanificacionHeader?>">
  <input type="hidden" name="fechaEvaluacion" value="<?php echo @$fechaEvaluacion?>">
  <input type="hidden" name="idEvaluacion" value="<?php echo @$idEvaluacion?>">

  




  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-12">
        <div class="card card-primary">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title"><?php echo $accion; ?> evaluacion para una actividad</h3>
            <span class="ml-auto"><?php echo 'Fecha de la Evaluacion: <h3><b>' . date('d-m-Y').'</b><h4>'; ?></span>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-sm-12">

                <?php
                  $nombreItems = '';
                  $maxLength = 0;                  
                  foreach ($arrayActividad as $actividad) {
                    $jerarquiaLength = strlen($actividad['jerarquia']);
                    if ($jerarquiaLength > $maxLength) {
                      $maxLength = $jerarquiaLength;
                      $nombreItems = $actividad['descripcion'];
                   }

                    //debo validar que la jerarquia tenga solo dos caracteres
                    if (strlen($actividad['jerarquia'])==2) {
                      echo '<h6>' . $actividad['descripcion'] . '</h6>';
                    } elseif ((strlen($actividad['jerarquia'])==5)) {
                      echo '<h5>' . $actividad['descripcion'] . '</h5>';
                    } elseif ((strlen($actividad['jerarquia'])==8)) {
                      echo '<h4>' . $actividad['descripcion'] . '</h4>';
                    } elseif ((strlen($actividad['jerarquia'])==11)) {
                      echo '<h3>' . $actividad['descripcion'] . '</h3>';
                    } elseif ((strlen($actividad['jerarquia'])==14)) {
                      echo '<h2>' . $actividad['descripcion'] . '</h2>';
                    } elseif ((strlen($actividad['jerarquia'])==17)) {
                      echo '<h1>' . $actividad['descripcion'] . '</h1>';
                    }
                  }
                ?>

                </div>
                <div class="col-sm-6">
                  <label>Tipo de Evaluacion</label>
                  <select class="form-control" name="tipo" id="tipo" required>
                    <option >Seleccione</option>

                    <?php if (!@$falgEvaInicial || (@$_POST['mod'] == 2)){?>`
                      <option <?php if (@$tipo  == 'Inicial') {
                              echo 'selected';
                            } ?> value="Inicial">Inicial</option>
                    <?php } ?>
                   
                   
                   
                   
                    <?php if (@$falgEvaInicial || (@$_POST['mod'] == 2)){?>
                      <option <?php if (@$tipo == 'Planificada') {
                              echo 'selected';
                            } ?> value="Planificada">Planificada</option>
                    <?php } ?>


                  </select>
                  
                </div>

                <div class="col-sm-6">
                  <label>Evaluacion</label>
                  <select class="form-control" name="idValorEvaluacion" id="idValorEvaluacion" required>
                    <option >Seleccione</option>
                    <?php //necesito llenar este select con los valores de $arrayValoresEvaluaciones haceidno un foreach
                    $selected='';
                    foreach ($arrayValoresEvaluaciones as $valoresEvaluaciones) {
                      
                      if (@$idValorEvaluacion  == $valoresEvaluaciones['descripcionCorta']) {
                        $selected= 'selected';} else {$selected= '';}
                      echo '<option value="' . $valoresEvaluaciones['descripcionCorta'] . '"'.$selected.' >' . $valoresEvaluaciones['descripcionLarga'] . '</option>';
                    }
                    ?>
                  </select>
                  
                </div>

                <div class="col-sm-12">
                    <label for="observacionEvaluacion">Observacion de la Evaluacion</label>
                    <textarea  id="summernote" name="observacionEvaluacion"><?php echo @$observacionEvaluacion; ?></textarea>
                </div>
              </div>
          </div>
        </div>


        <div class="card-footer">
          <button type="submit" class="btn btn-primary" <?php echo $disabled; ?>><?php echo $accion; ?></button>
          <button type="button" class="btn btn-primary" onclick="enviarParametrosGetsionUpdate('evaluacion/evaluacionCreate.php',2,'<?php echo  $idPlanificacionHeader; ?>')">Volver</button>
          
        </div>  
      </div>
      <?php if($numEvaluacionestotales>0){?>
        
        <div class="col-lg-12 col-12">
          <div class="card  bg-gray">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Historia ->  <?php echo strtoupper($nombreItems);?> </h3>
              </div>
          </div>
        </div>
       
          <section class="col-lg-12 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de Planificaciones</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Tipo</th>
                      <th>Resultado</th>
                      <th>Observación</th>
                      <th>fechaEvaluacion</th>
                      <th>Creado por</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(@$arrayEvaluaciones){
                      foreach (@$arrayEvaluaciones as $EvaluacionesRegistradas) { ?>
                      <tr>
                      <td><a href="#" onclick="enviar3Parametror('evaluacion/evaluacionItemCreate.php',2,'<?php echo  $_POST['id']; ?>','<?php echo  $EvaluacionesRegistradas['idEvaluacion']; ?>')" class="nav-link "><?php echo strtoupper($EvaluacionesRegistradas['tipo']); ?></a></td>
                        <td><?php echo $EvaluacionesRegistradas['idValorEvaluacion']; ?></td>  
                        <td><?php echo substr($EvaluacionesRegistradas['observacionEvaluacion'], 0, 1000); ?></td>
                        <td><?php echo $EvaluacionesRegistradas['fechaEvaluacion']; ?></td>
                        <td><?php echo $EvaluacionesRegistradas['evaluadoPor']; ?></td>
                      </tr>
                    <?php } 
                    }?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Tipo</th>
                      <th>Resultado</th>
                      <th>Observación</th>
                      <th>fechaEvaluacion</th>
                      <th>Creado por</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </section>
    

      <?php } ?>
        
  </div>
<!-- ./col -->

<!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
  </section>
</form>
