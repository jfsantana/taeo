<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';

//Listado de planificaicones
$id = @$_POST["id"];
$token = $_SESSION['token'];
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/planning?type=1";
$rs         = API::GET($URL, $token);
$arrayPlanificaciones  = API::JSON_TO_ARRAY($rs);

//Listado de planificaicones por sede
$id = @$_POST["id"];
$token = $_SESSION['token'];
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/planning?type=2";
$rs         = API::GET($URL, $token);
$arrayPlanificacionesbySede  = API::JSON_TO_ARRAY($rs);

?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Planificaciones</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">

      <?php foreach ($arrayPlanificacionesbySede as $planificacionesbySede) { ?>
        <div class="col-lg-3 col-12">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $planificacionesbySede['total']; ?></h3>
              <p><?php echo $planificacionesbySede['nombreSede']; ?></p>
            </div>
            <div class="icon">
              <i class="ion "><ion-icon name="happy-outline"></ion-icon></i>
            </div>
            <a href="#" onclick="enviarParametrosGetsionCreate('objetivo/objetivoCreate.php','1')" class="small-box-footer">Crear Planificaciones </i></a>
          </div>
        </div>
      <?php }?>
    </div>

    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listado de Planificaciones</h3>
          </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Aprendiz</th>
                <th>Sede</th>
                <th>Area</th>
                <th>Observación</th>
                <th>Creado por</th>
                <th>Activo</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($arrayPlanificaciones as $planificaciones) { ?>
                <tr>
                  <td><?php echo strtoupper($planificaciones['aprendiz']); ?></td>
                  <td><?php echo $planificaciones['nombreSede']; ?></td>
                  <td><a href="#" onclick="enviarParametrosGetsionUpdate('planning/planningCreate.php',2,'<?php echo $planificaciones['idPlanificacion']; ?>')" class="nav-link "><?php echo $planificaciones['nombreArea']; ?></a></td>
                  <td><?php echo substr($planificaciones['observacion'], 0, 1000); ?></td>
                  <td><?php echo $planificaciones['creadoPor']; ?></td>
                  <td><?php echo $planificaciones['estado']; ?></td>
                </tr>
              <?php } ?>

            </tbody>
            <tfoot>
              <tr>
               <th>Aprendiz</th>
                <th>Sede</th>
                <th>Area</th>
                <th>Observación</th>
                <th>Creado por</th>
                <th>Activo</th>
              </tr>
            </tfoot>
          </table>
        </div>
    </div>

</section>

</div>
</div>
</section>
