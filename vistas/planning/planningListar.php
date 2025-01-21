<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  " . $_SESSION['HTTP_ORIGIN']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';

//print("<pre>".print_r(($_SESSION),true)."</pre>");

$id = @$_POST["id"];
$token = $_SESSION['token'];

//1.SABER TODAS LAS SEDES ASOCIADAS AL USUARIOS LOGUEADO POR SU ID
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/sede?type=4&idUsuario=".$_SESSION['id_user'];
$rs         = API::GET($URL, $token);
$sedesPermiso  = API::JSON_TO_ARRAY($rs);
//$sedesPermisoIds = array_column($sedesPermiso, 'idSede');
$sedesPermisoIds = explode(',', @$sedesPermiso);
//print("<pre>".print_r(($sedesPermiso),true)."</pre>");

//Listado de planificaicones
if ($_SESSION['id_rol']==1){
  $UrlAcceso        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/planning?type=1";
}elseif($_SESSION['id_rol']==2){
  $UrlAcceso        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/planning?type=1&sede=".$sedesPermiso;
}else{
  $UrlAcceso        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/planning?type=1&idFacilitador=".$_SESSION['id_user'];
}
//print("<pre>".print_r(($UrlAcceso),true)."</pre>");
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
        <h1 class="m-0">Planificaciones</h1>
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


      <div class="col-lg-12 col-12">
          <div class="small-box bg-green">
            <a href="#" onclick="enviarParametrosGetsionCreate('planning/planningCreate.php','1')" class="small-box-footer">Crear Planificaciones </i></a>
          </div>
        </div>
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
                <th>Codigo</th>
                <th>Aprendiz</th>
                <th>Sede</th>
                <th>Área</th>
                <th>Observación</th>
                <th>Creado por</th>
                <th>Activo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($arrayPlanificaciones as $planificaciones) { ?>
                <tr>
                  <td><a href="#" onclick="enviarParametrosGetsionUpdate('planning/planningCreate.php',2,'<?php echo $planificaciones['idPlanificacion']; ?>')" class="nav-link "><?php echo $planificaciones['idPlanificacion']; ?></a></td>
                  <td><?php echo strtoupper($planificaciones['aprendiz']); ?></td>
                  <td><?php echo $planificaciones['nombreSede']; ?></td>
                  <td>
                    
                      <?php echo $planificaciones['nombreArea']; ?>
                    
                  </td>
                  <td><?php echo substr($planificaciones['observacion'], 0, 1000); ?></td>
                  <td><?php echo $planificaciones['creadoPor']; ?></td>
                  <td><?php echo $planificaciones['estado']; ?></td>
                  <td>

                  
                  <?php if ($planificaciones['evaluacion'] == 0) { ?>
                    <a href="#" onclick="eliminarPlanificacion('<?php echo $planificaciones['idPlanificacion']; ?>')">
                      <i class="fa fa-trash"></i>
                    </a>
                  <?php } ?>
                  </td>
                </tr>
              <?php } ?>

            </tbody>
            <tfoot>
              <tr>
                <th>Codigo</th>
                <th>Aprendiz</th>
                <th>Sede</th>
                <th>Área</th>
                <th>Observación</th>
                <th>Creado por</th>
                <th>Activo</th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>
    </div>

</section>

</div>
</div>
</section>


<script>
  async function eliminarPlanificacion(idPlanificacion) {
    if (confirm('¿Está seguro de que desea eliminar esta planificación?')) {
      try {
        const protocol = window.location.protocol;
        const url = `${protocol}//${window.location.host}/funciones/wsdl/planning`;
        const response = await fetch(url, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ idPlanificacion: idPlanificacion })
        });

        if (response.ok) {
          alert('Planificación eliminada con éxito.');
          location.reload(); // Actualiza la página
        } else {
          const errorData = await response.json();
          alert('Error al eliminar la planificación: ' + errorData.message);
        }
      } catch (error) {
        alert('Error al eliminar la planificación: ' + error.message);
      }
    }
  }
</script>
