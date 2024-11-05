<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}

//var_dump($_POST);
$status='Planificados';
require_once '../funciones/wsdl/clases/consumoApi.class.php';
$token = $_SESSION['token'];
// print("<pre>".print_r(($arrayClientes) ,true)."</pre>"); //die;

if (($_SESSION['id_rol']==1)){

  $UrlAcceso         = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/event?type=1&status=$status";
  $UrlAccesoResumen  = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/event?type=1&status=";
  
}else{

  //1.SABER TODAS LAS SEDES ASOCIADAS AL USUARIOS LOGUEADO POR SU ID
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/sede?type=4&idUsuario=".$_SESSION['id_user'];
  $rs         = API::GET($URL, $token);
  $sedesPermiso  = API::JSON_TO_ARRAY($rs);

  $UrlAcceso        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/event?type=1&status=$status&idsede=".$sedesPermiso;
  $UrlAccesoResumen  = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/event?type=1&status=$status&idsede=".$sedesPermiso."&status=";
}
//echo $UrlAcceso ; 

//Listado Eventos para Pagina segun filtro
$URL        = $UrlAcceso ; 
$rs         = API::GET($URL, $token);
$array  = API::JSON_TO_ARRAY($rs);

?>

<!-- <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">

        <h1 class="m-0">Planificaci&oacute;n por Sede:

          <select class="form-control" name="sede" id="miSelect" onchange="enviarRegistoTiempo('time/cargaTimeResumenList.php','<?php echo $corteAux; ?>',this.value)" required>
          <option> Seleccione</option>
            < ?php  foreach ($arraySede  as $sede) {   //checked?>

              <option value='< ?php echo $sede['idSede']; ?>' < ?php if (@$rolUsuario == $sede['idSede']) {
                                                                      echo 'selected';
                                                                    } ?>>
                        < ?php echo $sede['nombreSede']; ?>
                      </option>
            < ?php } ?>

          </select></h1>
      </div>
    </div>
  </div>
</div> -->


<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">

    <div class="col-lg-4 col-12">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Registro de Avance </h3>
            <p>Muestra de Avances para los Aprendices<br></p>
          </div>
          <div class="icon">
            <i class="ion ion-archive"></i>
          </div>
          <a href="#" onclick="enviarParametros('evaluacion/evaluacionListar.php')"  class="small-box-footer">Ver Avances <i class="fas fa-arrow-circle-right"></i>
        </a>
        </div>
      </div>

      <div class="col-lg-4 col-12">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>Consultar Planificaci&oacute;n</h3>
            <p>Muestra el listado de Planificaciones para ser Editadas<br></p>
          </div>
          <div class="icon">
            <i class="ion ion-archive"></i>
          </div>
          <a href="#" onclick="enviarParametros('planning/planningListar.php')"  class="small-box-footer">Ver Planificaciones <i class="fas fa-arrow-circle-right"></i>
        </a>
        </div>
      </div>

      <div class="col-lg-4 col-12">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>Consultar Objetivos</h3>

            <p>Muestra el listado de Objetivos para ser Editados<br></p>
          </div>
          <div class="icon">
            <i class="ion ion-edit "></i>
          </div>
          <a href="#"  onclick="enviarParametros('objetivo/objetivoListar.php')" class="small-box-footer">Ver Objetivos <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <!-- ./col -->
    </div>
    <!-- /.row -->



    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Proximos Eventos </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="registro" class="table table-bordered table-striped">
            <thead>
                <tr>
                  <th>Nombre del Evento</th>
                  <th>Organizador</th>
                  <th>Ponentes</th>
                  <th>Fecha / Hora</th>
                  <th>Sede Responsable</th>
                  <th>Direccion</th>
                  <th>Descripcion</th>
                  <th>Envio por Correo</th>
                  <th>Tipo Evento</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($array as $event) { ?>
                 <tr>
                            <td><a href="#" onclick="enviarParametrosGetsionUpdate('event/crearEvent.php',2,'<?php echo  $event['idEvento']; ?>')"> <?php echo $event['nombreEvento']; ?></a></td>
                            <td><?php echo $event['organizadoPor']; ?></td>
                            <td><?php echo $event['ponentes']; ?></td>
                            <td><?php echo $event['fechaEvento']; ?></td>
                            <td><?php echo $event['nombreSede']; ?></td>
                            <td><?php echo $event['lugarEvento']; ?></td>
                            <td><?php echo $event['descripcionEvento']; ?></td>
                            <td><?php echo $event['envioCorreo']; ?></td>
                            <td><?php echo $event['tipoEvento']; ?></td>
                          </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->


        <!-- /.card -->
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->

      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
