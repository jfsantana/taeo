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

 //print("<pre>".print_r(($_POST) ,true)."</pre>"); //die;


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
  $URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/sede?type=1";
  $rs         = API::GET($URL1, $token);
  $arraySede  = API::JSON_TO_ARRAY($rs);

  $token = $_SESSION['token'];
  $URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/aprendiz?type=1";
  $rs         = API::GET($URL1, $token);
  $arrayAprendices  = API::JSON_TO_ARRAY($rs);

  $token = $_SESSION['token'];
  //rolUsuario=3  SE REFIERE A LOS FACILITADORES
  $URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/empleados?type=3&rolUsuario=3";
  $rs         = API::GET($URL1, $token);
  $arrayFacilitadores  = API::JSON_TO_ARRAY($rs);


  //echo $URL1;
  //print("<pre>".print_r(($arraySede) ,true)."</pre>");
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Planificaciones</h1>
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
            <h3 class="card-title"><?php echo $accion; ?> Planificacion</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form>
            <div class="card-body">
              <div class="row">

                <div class="col-sm-4">
                  <label for="nivelObjetivo">Área</label>
                  <select class="form-control" name="idArea" id="idArea">
                    <option>Seleccione</option>
                    <?php foreach($arrayAreaObjetivo as $areaObjetivo ){?>
                      <option <?php if ($areaObjetivo['idArea'] == @$idArea) {echo 'selected';} ?> value=<?php echo $areaObjetivo['idArea']; ?>><?php echo strtoupper($areaObjetivo['nombreArea']); ?></option>
                    <?php }?>
                  </select>
                </div>

                <div class="col-sm-4">
                  <label for="sede">Sede </label>
                  <select class="form-control" name="idSede" id="idSede"  onchange="fetchNiveles(this.value)">
                    <option>Seleccione</option>
                    <?php foreach($arraySede as $sede ){?>
                      <option <?php if ($sede['idSede'] == @$idSede) {echo 'selected';} ?> value=<?php echo $sede['idSede']; ?>><?php echo $sede['nombreSede']; ?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="aprendiz">Mediador(a)</label>
                  <select class="form-control" name="idFacilitador" id="idFacilitador" disabled>
                    <option>Seleccione</option>
                    <?php foreach($arrayFacilitadores as $facilitador ){?>
                      <option <?php if ($facilitador['idUsuario'] == @$idFacilitador) {echo 'selected';} ?> value=<?php echo $facilitador['idUsuario']; ?>><?php echo $facilitador['apellidoUsuario'].', '.$facilitador['nombreUsuario']; ?></option>
                    <?php }?>
                  </select>
                </div>

                <div class="col-sm-8">
                  <label for="aprendiz">Aprendiz </label>
                  <select class="form-control select2"  style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="idAprendiz" id="idAprendiz">
                    <option>Seleccione</option>
                    <?php foreach($arrayAprendices as $aprendiz ){?>
                      <option <?php if ($aprendiz['idAprendiz'] == @$idAprendiz) {echo 'selected';} ?> value=<?php echo $aprendiz['idAprendiz']; ?>><?php echo $aprendiz['nombreAprendiz']; ?></option>
                    <?php }?>
                  </select>
                </div>

                <div class="col-sm-2">
                  <label>Periodo Evaluacion</label>
                  <select class="form-control" name="periodoEvaluacion" id="periodoEvaluacion">

                    <?php
                    if  ((is_null($periodoEvaluacion)) ||(empty($periodoEvaluacion))){$periodoEvaluacion=4;}
                    for ($i = 1; $i <= 5; $i++) { ?>
                      <option <?php if (@$periodoEvaluacion == $i) {echo 'selected';} ?> value=<?php echo $i; ?>><?php echo $i; ?> Eva.</option>
                    <?php }?>

                  </select>
                </div>




                <div class="col-sm-2">
                  <label>Activo</label>
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
                    <label for="nombreCliente">Descripción</label>
                    <textarea  id="summernote" name="observacionObjetivo"><?php echo @$observacionObjetivo; ?></textarea>
                </div>

                <div class="col-sm-3">
                  <label for="cedulaRepresentante">Fecha Creación</label>
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
                      <h3 class="card-title col-sm-2" >Contenido del Plan</h3>

                      <div class="card-tools  align-items-center" >
                          <ul class="nav nav-pills ml-auto  align-items-center" >
                              <li class="nav-item">
                                  <a href="objetivo/plantilla/FormatoCargaObjetivos.xlsx" title='Descargue el Formato para la carga por Lote' download>
                                      <ion-icon name="download-outline"></ion-icon>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>


                  <?php

                  //aqui va el contenido para llamar a la emergente con ajax que hace la locura

                  //  if ($_POST['mod'] == 2){
                  //      include_once("objetivoView.php");
                  //  } else
                  //  {
                  //    include_once("objetivoCargaXls.php");

                  //  } ?>
                </div>
              </div>

            </div>

            <div class="card-footer">
                    <?php
                      if(($_POST['mod']<>1)&&($flag)){ ?>
                      <button type="button" class="btn btn-warning" onclick="enviarParametrosGetsionUpdate('planning/objetivoCreate.php',3,'<?php echo $idObjetivoHeader ; ?>')">Volver a cargar contenido de la ULTIMA versi&oacute;n</button>
                      <button type="button" class="btn btn-danger"  onclick="enviarParametrosGetsionUpdate('planning/objetivoCreate.php',4,'<?php echo $idObjetivoHeader ; ?>')">Crear NUEVA VERSIÓN al objetivo</button>

                    <?php  }?>

              <button type="submit" class="btn btn-success" ><?php echo $accion; ?> Encabezado del Plan </button>

              <button type="button" class="btn btn-primary" onclick="enviarParametros('planning/planningListar.php')">Volver al Listado de Planes</button>
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



<!-- ******************** -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
function fetchNiveles(idSede) {
  var nivelSelect = $('#idFacilitador');

  if (idSede) {
    console.log('VER PARA EL AREA:', idSede); // Agrega esta línea para depuración
    $.ajax({
      type: "POST",
      url: "planning/fetch_facilitadores.php",
      data: { idSede: idSede },
      success: function(response) {
        console.log('Response:', response); // Agrega esta línea para depuración
        var niveles = JSON.parse(response);

        // Limpia las opciones actuales
        nivelSelect.empty();
        nivelSelect.append('<option value="">Seleccione</option>');

        // Agrega las nuevas opciones
        niveles.forEach(function(nivel) {
          nivelSelect.append('<option value="' + nivel.idUsuario + '">' + nivel.facilitador + '</option>');
        });

        // Habilita el campo
        nivelSelect.prop('disabled', false);
      },
      error: function(xhr, status, error) {
        console.error('Error al obtener niveles:', error);
      }
    });
  } else {
    // Si no hay idSede, deshabilita el campo y restaura la opción predeterminada
    nivelSelect.prop('disabled', true);
    nivelSelect.empty();
    nivelSelect.append('<option value="">Seleccione</option>');
  }
}
</script>

