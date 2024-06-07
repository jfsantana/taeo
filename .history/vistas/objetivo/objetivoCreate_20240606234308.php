<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';

$token = $_SESSION['token'];

 print("<pre>".print_r(($_POST) ,true)."</pre>"); //die;
 function  nivel($nodoPadre,$level,$token,$idObjetivoHeader){

  $arrayhijosNexLevel  = hijos($nodoPadre['id'], $token);
  if(count($arrayhijosNexLevel)>0)
  {?>
      <tr class="expandable-body">
      <td>
          <div class="p-0">
                  <table class="table table-hover">
                  <tbody>
                      <?php
                      //************************ INICIO DEL RECORRIDO NIVEL 2 ********************/
                      foreach($arrayhijosNexLevel as $datosArrayhijosNexLevel)
                      {?>
                      <tr data-widget="expandable-table" aria-expanded="false">
                          <td>
                          <div class="p-0">
                              <table class="table table-hover">
                              <tbody>
                                  <?php
                                  $arrayhijosN1  = hijos($datosArrayhijosNexLevel['id'], $token);
                                  $variable=$datosArrayhijosNexLevel['id'].'-'. @$idObjetivoHeader;

                                  if(count($arrayhijosN1)<1)
                                  {
                                  //No tiene Hijos?>
                                  <tr data-widget="expandable-table" aria-expanded="false">
                                      <td>
                                      <?php echo ' '.$datosArrayhijosNexLevel['jerarquia'].' - '.$datosArrayhijosNexLevel['descripcion'].'
                                          (
                                            <a href="#"
                                            onclick="enviarParametrosGetsionUpdate(\'objetivo/itemCreate.php\',2,\''.$variable.'\')"
                                            ><i class="fas fa-edit"  style="color: #228A13;"></i></a>
                                          )
                                          ';?>
                                      </td>
                                  </tr>
                                  <?php
                                  }else
                                  {
                                  // si tiene Hijo
                                  ?>
                                  <tr data-widget="expandable-table" aria-expanded="false">
                                      <td>
                                          <button type="button" class="btn btn-primary p-0">
                                          <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                          </button>
                                          <?php echo ' '.$datosArrayhijosNexLevel['jerarquia'].' - '.$datosArrayhijosNexLevel['descripcion'].'
                                          (
                                            <a href="#"
                                            onclick="enviarParametrosGetsionUpdate(\'objetivo/itemCreate.php\',2,\''.$variable.'\')"
                                            ><i class="fas fa-edit"  style="color: #228A13;"></i></a>
                                          )
                                          ';?>
                                      </td>
                                  </tr>
                                  <!-- /*Inicio va el codigo para el siguiente nivel*/ -->
                                  <?php


                                  ?>
                                  <!-- /*fin  va el codigo para el siguiente nivel*/ -->
                                  <?php
                                  }?>
                              </tbody>
                              </table>
                          </div>
                          </td>
                      </tr>
                      <?php
                      }?>
                  </tbody>
                  </table>
          </div>
          </td>
      </tr>

      <?php
  }
}

function  hijos ($padre, $token){
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/objetivo?type=3&id_padre=".$padre;
                        $rs         = API::GET($URL, $token);
                        $arrayhijos  = API::JSON_TO_ARRAY($rs);
                        $banderaNodoPadre=false;
                        return $arrayhijos;
}


/*Tipos de MOD
*!MOD =1 CREATE
*!MOR = 2 UPDATE
*!MOD = 3 DELETE ITEMS Y CARGA*/

if ($_POST['mod'] == 1) {
  $accion = "Crear";
  if(isset($_POST['id'])){
    $idObjetivoHeader = @$_POST["id"];  //signifia que la creacion esta asociada a un aprendiz
  }
  $creadoPor = $_SESSION['usuario'];
  $fechaCreacion = date('Y-m-d');
} elseif($_POST['mod'] == 2) {
  $flag=true;
  $accion = "Editar";

  //datos Representante
  $idObjetivoHeader = @$_POST["id"];

  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/objetivo?type=1&idObjetivoHeader=$idObjetivoHeader";
  $rs         = API::GET($URL, $token);
  $arrayHeader  = API::JSON_TO_ARRAY($rs);

  $nombreObjetivo = $arrayHeader[0]['nombreObjetivo'];
  $observacionObjetivo = $arrayHeader[0]['observacionObjetivo'];
  $fechaCreacion = $arrayHeader[0]['fechaCreacion'];
  $creadoPor = $arrayHeader[0]['creadoPor'];
  $activo = $arrayHeader[0]['activo'];
  $nivelObjetivo = $arrayHeader[0]['nivelObjetivo'];
  $nivelObjetivo = $arrayHeader[0]['nivelObjetivo'];
  $idAreaObjetivo = $arrayHeader[0]['idAreaObjetivo'];


  if ($arrayHeader[0]['activo'] == 1)
    $estado = 1;
  else
    $estado = 0;

    $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/objetivo?type=2&idObjetivoHeader=$idObjetivoHeader";
    $rs         = API::GET($URL, $token);
    $arrayItemByHeader  = API::JSON_TO_ARRAY($rs);

}elseif(($_POST['mod'] == 3)||($_POST['mod'] == 4)){
  $flag=false;
  $token = $_SESSION['token'];
  $accion = "Carga de Contenido";

  $idObjetivoHeader = @$_POST["id"];

  //consulta el header del objetivo
  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/objetivo?type=1&idObjetivoHeader=$idObjetivoHeader";
  $rs         = API::GET($URL, $token);
  $arrayHeader  = API::JSON_TO_ARRAY($rs);
  $nombreObjetivo = $arrayHeader[0]['nombreObjetivo'];
  $observacionObjetivo = $arrayHeader[0]['observacionObjetivo'];
  $fechaCreacion = $arrayHeader[0]['fechaCreacion'];
  $creadoPor = $arrayHeader[0]['creadoPor'];
  $activo = $arrayHeader[0]['activo'];
  $nivelObjetivo = $arrayHeader[0]['nivelObjetivo'];
  $nivelObjetivo = $arrayHeader[0]['nivelObjetivo'];
  $idAreaObjetivo = $arrayHeader[0]['idAreaObjetivo'];

}

if ($_POST['mod'] != 1) {// busca las versiones disponibles del objetivo
  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/objetivo?type=4&idHeader=$idObjetivoHeader";
  $rs         = API::GET($URL, $token);
  $arrayVersiones  = API::JSON_TO_ARRAY($rs);

  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/objetivo?type=5&idHeader=$idObjetivoHeader";
  $rs         = API::GET($URL, $token);
  $arrayMaxVersion  = API::JSON_TO_ARRAY($rs);
  // hacer la validacion si el valor del select no viene
  if(isset($_POST['select'])){
   // echo 'entr';
    $maxVersion=$_POST['select'];
  }else{
    $maxVersion=$arrayMaxVersion[0]['maximo'];
  }


}
  if($_POST['mod'] ==4){
    $maxVersion=$maxVersion+1;
  }


  $token = $_SESSION['token'];
  $URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/area?type=1";
  $rs         = API::GET($URL1, $token);
  $arrayAreaObjetivo  = API::JSON_TO_ARRAY($rs);

  $token = $_SESSION['token'];
  $URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/nivelArea?type=1";
  $rs         = API::GET($URL1, $token);
  $arrayNivelAreaObjetivo  = API::JSON_TO_ARRAY($rs);

  //print("<pre>".print_r(($arrayNivelAreaObjetivo) ,true)."</pre>");
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Objetivos</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container -fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_objetivo.model.php" method="post" name="objetivo" id="objetivo"  enctype="multipart/form-data">

  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idObjetivoHeader" value="<?php echo @$idObjetivoHeader; ?>">
  <input type="hidden" name="versionActual" value="<?php echo @$maxVersion; ?>">



  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $accion; ?> Objetivos</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form>
            <div class="card-body">
              <div class="row">
              <div class="col-sm-6">
                  <label for="nivelObjetivo">Area</label>
                  <select class="form-control" name="idAreaObjetivo" id="idAreaObjetivo">
                    <option>Seleccine</option>
                    <?php foreach($arrayAreaObjetivo as $areaObjetivo ){?>
                      <option <?php if ($NivelAreaObjetivo['idArea'] == @$idAreaObjetivo) {echo 'selected';} ?> value=<?php echo $NivelAreaObjetivo['idArea']; ?>><?php echo $NivelAreaObjetivo['nombreArea']; ?></option>
                    <?php }?>
                  </select>
                </div>

                <div class="col-sm-6">
                  <label for="nivelObjetivo">Nivel </label>
                  <select class="form-control" name="nivelObjetivo" id="nivelObjetivo">
                    <option>Seleccine</option>
                    <?php foreach($arrayNivelAreaObjetivo as $NivelAreaObjetivo ){?>
                      <option <?php if ($NivelAreaObjetivo['idNivelAreaObjetivo'] == @$nivelObjetivo) {echo 'selected';} ?> value=<?php echo $NivelAreaObjetivo['idNivelAreaObjetivo']; ?>><?php echo $NivelAreaObjetivo['nombreNivelAreaObjetivo']; ?></option>
                    <?php }?>
                  </select>
                </div>


                <div class="col-sm-9">
                  <label for="nombreRepresentante">Nombre del Objetivo</label>
                  <input type="text" class="form-control" name="nombreObjetivo" id="nombreObjetivo" placeholder="Nombre del Objetivo" required  value="<?php echo @$nombreObjetivo; ?>">
                </div>


                <div class="col-sm-3">
                  <label>Activo</label>
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
                    <label for="nombreCliente">Descripción</label>
                    <textarea  id="summernote" name="observacionObjetivo"><?php echo @$observacionObjetivo; ?></textarea>
                </div>

                <div class="col-sm-3">
                  <label for="cedulaRepresentante">Fecha Creacion</label>
                  <input type="text" class="form-control" readonly name="fechaCreacion" id="fechaCreacion" placeholder="fechaCreacion" value="<?php echo @$fechaCreacion; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="telefonoRepresentante">Creado Por</label>
                  <input type="text" class="form-control" name="creadoPor" id="creadoPor" placeholder="creadoPor" readonly value="<?php echo @$creadoPor; ?>">
                </div>


                <div class="col-sm-12">

                  <div class="card card-primary">
                    </br>
                    <div class="card-header align-items-center">
                      <h3 class="card-title col-sm-2" >Contenido del Objetivo</h3>
                      <?php if($_POST['mod']==2){?>
                          <select class="form-control ml-1 col-sm-2" name="versionActual"
                                onchange="enviar4ParametrosGet('objetivo/objetivoCreate.php',2,'<?php echo $idObjetivoHeader; ?>',this.value)">
                          <?php
                            foreach($arrayVersiones as $datosVersion){?>
                              <option value="<?php echo $datosVersion['versionObjetivo']; ?>"
                                <?php if($maxVersion==$datosVersion['versionObjetivo']){echo 'selected';}?>
                                  > Version-

                                  <?php echo $datosVersion['versionObjetivo']; ?></option>
                          <?php  } ?>

                        </select>
                      <?php }elseif($_POST['mod']==4){?>

                        <h3 class="card-title col-sm-2" >   Nueva Version-<?php echo $maxVersion; ?></h3>


                      <?php }?>
                      <div class="card-tools  align-items-center" >
                          <ul class="nav nav-pills ml-auto  align-items-center" >
                              <li class="nav-item">
                                  <a href="./plantilla/FormatoCargaObjetivos.xlsx" title='Descargue el Formato para la carga por Lote' download>
                                      <ion-icon name="download-outline"></ion-icon>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>


                  <?php
                  if ($_POST['mod'] == 2){
                      include_once("objetivoView.php");
                  } else
                  {
                    include_once("objetivoCargaXls.php");

                  } ?>
                </div>
              </div>

            </div>

            <div class="card-footer">
                    <?php
                      if(($_POST['mod']<>1)&&($flag)){ ?>
                      <button type="button" class="btn btn-warning" onclick="enviarParametrosGetsionUpdate('objetivo/objetivoCreate.php',3,'<?php echo $idObjetivoHeader ; ?>')">Volver a cargar contenido de la ULTIMA version</button>
                      <button type="button" class="btn btn-danger"  onclick="enviarParametrosGetsionUpdate('objetivo/objetivoCreate.php',4,'<?php echo $idObjetivoHeader ; ?>')">Crear NUEVA VERSION al objetivo</button>

                    <?php  }?>

              <button type="submit" class="btn btn-success" ><?php echo $accion; ?> Encabezado del Objetivo </button>

              <button type="button" class="btn btn-primary" onclick="enviarParametros('objetivo/objetivoListar.php')">Volver al Listado de Objetivos</button>
            </div>



          </form>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->

   </div>
  <!--  </section> -->
</form>


