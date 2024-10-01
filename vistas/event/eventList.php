<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';

//Listado Clientes
$idEmpresaConsultora = @$_POST["id"];
$token = $_SESSION['token'];
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/event?type=1";
$rs         = API::GET($URL, $token);
$array  = API::JSON_TO_ARRAY($rs);

//print("<pre>".print_r(($arrayClientes) ,true)."</pre>"); / /die;
?>

<!-- Content Header (Page header)  -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Eventos</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?php echo count($array); ?></h3>
            <p>Eventos</p>
          </div>
          <div class="icon">
          <i class="ion " ><ion-icon name="settings-outline"></ion-icon></i>
          </div>
          <a href="#" onclick="enviarParametrosGetsionCreate('event/crearEvent.php','1')" class="small-box-footer">Crear Evento <i class="fas fa-arrow-circle-right"></i></a>
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
            <h3 class="card-title">Listado de Eventos para el Sistema de TAEO</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="event" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre del Evento</th>
                  <th>Organizador</th>
                  <th>Ponentes</th>
                  <th>Fecha / Hora</th>
                  <th>Sede Responsable</th>
                  <th>Logar</th>
                  <th>Descripcion</th>
                  <th>Envio por Correo</th>
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
