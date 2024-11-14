<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  " . $_SESSION['HTTP_ORIGIN']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';
//print("<pre>".print_r(($_POST),true)."</pre>");

$id = @$_POST["id"];
$token = $_SESSION['token'];



$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/sede?type=4&idUsuario=".$_SESSION['id_user'];
$rs         = API::GET($URL, $token);
$sedesPermiso  = API::JSON_TO_ARRAY($rs);
$sedesPermisoIds = explode(',', @$sedesPermiso);


if (($_SESSION['id_rol']==1)){
  $UrlAcceso        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/evaluacion?type=7";
}elseif(($_SESSION['id_rol']==2)){
  //1.SABER TODAS LAS SEDES ASOCIADAS AL USUARIOS LOGUEADO POR SU ID

  $UrlAcceso        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/evaluacion?type=7&idsede=".$sedesPermiso;
}
else{
  $UrlAcceso        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/evaluacion?type=7&facilitador=".$_SESSION['id_user'];
}


//Listado de Registros de Avances por sede del usuario logueado
$URL        = $UrlAcceso;
$rs         = API::GET($URL, $token);
$arrayPlanificaciones  = API::JSON_TO_ARRAY($rs);

//Listado de planificaicones por sede
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/planning?type=2";
$rs         = API::GET($URL, $token);
$arrayPlanificacionesbySede  = API::JSON_TO_ARRAY($rs);

?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Registrode Avances</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">


      <?php foreach ($arrayPlanificacionesbySede as $planificacionesbySede) { 
        if (in_array($planificacionesbySede['idSede'], $sedesPermisoIds)) {?>
            <div class="col-lg-3 col-12">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $planificacionesbySede['total']; ?></h3>
                  <p><?php echo $planificacionesbySede['nombreSede']; ?></p>
                </div>
                <div class="icon">
                  <i class="ion "><ion-icon name="happy-outline"></ion-icon></i>
                </div>
              </div>
            </div>
          <?php
        } 
      } ?>
      
    </div>

    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listado de Planificaicones Asigandas</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Aprendiz</th>
                  <th>Sede</th>
                  <th>Área</th>
                  <th>Observación</th>
                  <th>Creado por</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if(@$arrayPlanificaciones){
                  foreach (@$arrayPlanificaciones as $planificaciones) { ?>
                  <tr>
                    <td><?php echo strtoupper($planificaciones['idPlanificacion']); ?></td>  
                    <td><?php echo $planificaciones['aprendiz']; ?></td>
                    <td><?php echo $planificaciones['nombreSede']; ?></td>
                    <td><a href="#" onclick="enviarParametrosGetsionUpdate('evaluacion/evaluacionCreate.php',2,'<?php echo $planificaciones['idPlanificacion']; ?>')" class="nav-link "><?php echo $planificaciones['nombreArea']; ?></a></td>
                    <td><?php echo substr($planificaciones['observacion'], 0, 1000); ?></td>
                    <td><?php echo $planificaciones['creadoPor']; ?></td>
                    <td><?php echo $planificaciones['estado']; ?></td>
                  </tr>
                <?php } 
                }?>

              </tbody>
              <tfoot>
                <tr>
                  <th>Codigo</th>   
                  <th>Aprendiz</th>
                  <th>Sede</th>
                  <th>Área</th>
                  <th>Observación</th>
                  <th>Creado por</th>
                  <th>Status</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </section>
    </div>
</div>
</section>
