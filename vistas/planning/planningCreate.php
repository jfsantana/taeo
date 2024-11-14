<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  " . $_SESSION['HTTP_ORIGIN']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';

$token = $_SESSION['token'];

 //print("<pre>".print_r(($_POST) ,true)."</pre>"); //die;

/*Tipos de MOD
*!MOD =1 CREATE
*!MOR = 2 UPDATE
*/

if ($_POST['mod'] == 1) {
   //Cerear Planificacion
  $accion = "Crear";
  if(isset($_POST['id'])){
    $idObjetivoHeader = @$_POST["id"];  //signifia que la creacion esta asociada a un aprendiz
  }
  $creadoPor = $_SESSION['usuario'];
  $fechaCreacion = date('Y-m-d');
} elseif($_POST['mod'] == 2) {
  //Editar Planificacion

  $flag=true;
  $accion = "Editar";
  $idObjetivoHeader = @$_POST["id"];

  $token = $_SESSION['token'];
  $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/planning?type=1&idPlanificacion=$idObjetivoHeader";
  $rs         = API::GET($URL, $token);
  $arrayHeader  = API::JSON_TO_ARRAY($rs);

  $idPlanificacion = $arrayHeader[0]['idPlanificacion'];
  $idArea = $arrayHeader[0]['idArea'];
  $idSede = $arrayHeader[0]['idSede'];
  $idFacilitador = $arrayHeader[0]['idFacilitador'];
  $idAprendiz = $arrayHeader[0]['idAprendiz'];
  $periodoEvaluacion = $arrayHeader[0]['periodoEvaluacion'];
  $observacion = $arrayHeader[0]['observacion'];
  $fechaCreacion = $arrayHeader[0]['fechaCreacion'];
  $creadoPor = $arrayHeader[0]['creadoPor'];
  $activo = $arrayHeader[0]['activo'];
  $estado = $arrayHeader[0]['estado'];
  $nombreArea = $arrayHeader[0]['nombreArea'];
  $nombreSede = $arrayHeader[0]['nombreSede'];
  $facilitador = $arrayHeader[0]['facilitador'];
  $aprendiz = $arrayHeader[0]['aprendiz'];
  $aprendizFullName = $arrayHeader[0]['aprendiz'];

  if ($arrayHeader[0]['activo'] == 1)
    $estado = 1;
  else
    $estado = 0;
}

  $token = $_SESSION['token'];
  $URL1        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/area?type=1";
  $rs         = API::GET($URL1, $token);
  $arrayAreaObjetivo  = API::JSON_TO_ARRAY($rs);

  $token = $_SESSION['token'];
  $URL1        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/sede?type=3&idUsuario=".$_SESSION['id_user'];
  $rs         = API::GET($URL1, $token);
  $arraySede  = API::JSON_TO_ARRAY($rs);

  $token = $_SESSION['token'];
  $URL1        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/aprendiz?type=5&idUsuario=".$_SESSION['id_user'];
  $rs         = API::GET($URL1, $token);
  $arrayAprendices  = API::JSON_TO_ARRAY($rs);

  $token = $_SESSION['token'];
  //rolUsuario=3  SE REFIERE A LOS FACILITADORES
  $URL1        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/empleados?type=3&rolUsuario=3";
  $rs         = API::GET($URL1, $token);
  $arrayFacilitadores  = API::JSON_TO_ARRAY($rs);


  //echo $URL1;
  //print("<pre>".print_r(($arraySede) ,true)."</pre>");
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Planificaciones</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container -fluid -->
</div>


<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_planning.model.php" method="post" name="objetivo" id="objetivo"  enctype="multipart/form-data">
  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idObjetivoHeader" value="<?php echo @$idObjetivoHeader; ?>">
  
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $accion; ?> Planificacion</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->

            <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  <label for="area">Área</label>
                  <select class="form-control" name="idArea" id="idArea" <?php if($_POST['mod']==2){echo 'disabled';}?>>
                    <option>Seleccione:</option>
                    <?php foreach($arrayAreaObjetivo as $areaObjetivo ){?>
                      <option <?php if ($areaObjetivo['idArea'] == @$idArea) {echo 'selected';} ?> value=<?php echo $areaObjetivo['idArea']; ?>><?php echo strtoupper($areaObjetivo['nombreArea']); ?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="sede">Sede:</label>
                  <select class="form-control" name="idSede" id="idSede"  onchange="fetchNiveles(this.value)">
                    <option>Seleccione</option>
                    <?php foreach($arraySede as $sede ){?>
                      <option <?php if ($sede['idSede'] == @$idSede) {echo 'selected';} ?> value=<?php echo $sede['idSede']; ?>><?php echo $sede['nombreSede']; ?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="aprendiz">Mediador(a):</label>
                  <select class="form-control" name="idFacilitador" id="idFacilitador" <?php if ($_POST['mod']==1){echo 'disabled';}?>>
                    <option>Seleccione</option>
                    <?php foreach($arrayFacilitadores as $facilitador ){?>
                      <option <?php if ($facilitador['idUsuario'] == @$idFacilitador) {echo 'selected';} ?> value=<?php echo $facilitador['idUsuario']; ?>><?php echo $facilitador['apellidoUsuario'].', '.$facilitador['nombreUsuario']; ?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-sm-8">
                  <label for="aprendiz">Aprendiz:</label>
                  <select class="form-control select2"  style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="idAprendiz" id="idAprendiz" <?php if($_POST['mod']==2){echo 'disabled';}?>>
                    <option>Seleccione</option>
                    <?php foreach($arrayAprendices as $aprendiz ){?>
                      <option <?php if ($aprendiz['idAprendiz'] == @$idAprendiz) {echo 'selected';} ?> value=<?php echo $aprendiz['idAprendiz']; ?>><?php echo $aprendiz['nombreAprendiz']; ?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-sm-2">
                  <label>Periodo Evaluación:</label>
                  <select class="form-control" name="periodoEvaluacion" id="periodoEvaluacion">
                    <?php
                    if  ((is_null($periodoEvaluacion)) ||(empty($periodoEvaluacion))){$periodoEvaluacion=4;}
                    for ($i = 1; $i <= 5; $i++) { ?>
                      <option <?php if (@$periodoEvaluacion == $i) {echo 'selected';} ?> value=<?php echo $i; ?>><?php echo $i; ?> Eva.</option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-sm-2">
                  <label>Activo:</label>
                  <?php
                    if  ((is_null(@$activo)) ||(empty(@$activo))){@$activo=1;}
                    ?>
                  <select class="form-control" name="activo" id="activo">
                    <option <?php if (@$activo == 1) {
                              echo 'selected';
                            } ?> value=1>Activo</option>
                    <option <?php if (@$activo == 0) {
                              echo 'selected';
                            } ?> value=0>Desactivado</option>
                  </select>
                </div>
                <div class="col-sm-12">
                    <label for="nombreCliente">Descripción:</label>
                    <textarea  id="summernote" name="observacion"><?php echo @$observacion; ?></textarea>
                </div>
                <div class="col-sm-3">
                  <label for="cedulaRepresentante">Fecha Creación</label>
                  <input type="text" class="form-control" readonly name="fechaCreacion" id="fechaCreacion" placeholder="fechaCreacion" value="<?php echo @$fechaCreacion; ?>">
                </div>
                <div class="col-sm-3">
                  <label for="telefonoRepresentante">Creado Por</label>
                  <input type="text" class="form-control" name="creadoPor" id="creadoPor" placeholder="creadoPor" readonly value="<?php echo @$creadoPor; ?>">
                </div>
                <?php if($_POST['mod']==2){?>
                  <div class="col-sm-12">
                    </br>
                    <button type="submit" class="btn btn-success" ><?php echo $accion; ?> Encabezado del Plan </button>
                  </div>
                <?php }?>


                <div class="col-sm-12">
                  <div class="card card-primary">
                    </br>
                    <?php
                      if(($_POST['mod']<>1)&&($flag)){ ?>
                        <div class="card-header align-items-center">
                          <h3 class="card-title col-sm-2" >Contenido del Plan</h3>
                        </div>
                    <?php  }?>
                </div>
                <?php
                     if($_POST['mod']==2){include_once("planningView.php");}?>
              </div>
            </div>
            <div class="card-footer">
                  <?php if($_POST['mod']!=2){?>
                  <div class="col-sm-12">
                    </br>
                    <button type="submit" class="btn btn-success" ><?php echo $accion; ?> Encabezado del Plan </button>
                  </div>
                <?php }?>
</form>
                    <button type="button" class="btn btn-primary" onclick="enviarParametros('planning/planningListar.php')">Volver al Listado de Planes</button>
                    <?php
                      if(($_POST['mod']<>1)&&($flag)){ ?>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">Agregar Actividad(es)</button>
                      <!-- MODAL -->
                      <?php include ('planningModal.php'); ?>
                    <?php  }?>

                  
            </div>

        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
   </div>
  <!--  </section> -->



<!-- ******************** -->
<?php include("script.php");?>
