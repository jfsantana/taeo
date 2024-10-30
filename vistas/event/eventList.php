<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';

//Planificados, Cerrados Todos
if (@$_POST['mod']==null){
  $status='Planificados';
}else{
  $status=@$_POST['mod'];
}
$token = $_SESSION['token'];


if (($_SESSION['id_rol']==1)){

  $UrlAcceso        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/event?type=1&status=$status";
  
}elseif(($_SESSION['id_rol']==2)){

  //1.SABER TODAS LAS SEDES ASOCIADAS AL USUARIOS LOGUEADO POR SU ID
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/sede?type=4&idUsuario=".$_SESSION['id_user'];
  $rs         = API::GET($URL, $token);
  $sedesPermiso  = API::JSON_TO_ARRAY($rs);

  $UrlAcceso        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/event?type=1&status=$status&idsede=".$sedesPermiso;

}
//echo $UrlAcceso ; 


//Listado Eventos para Pagina segun filtro
$URL        = $UrlAcceso ; 
$rs         = API::GET($URL, $token);
$array  = API::JSON_TO_ARRAY($rs);





//total  Planificados
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/event?type=1&status=Planificados";
$rs         = API::GET($URL, $token);
$arrayPlanificados  = API::JSON_TO_ARRAY($rs);

//Total  Cerrados
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/event?type=1&status=Cerrados";
$rs         = API::GET($URL, $token);
$arrayCerrados  = API::JSON_TO_ARRAY($rs);

//Todos Eventos 
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/event?type=1&status=Todos";
$rs         = API::GET($URL, $token);
$arrayTodos  = API::JSON_TO_ARRAY($rs);

//total  ejecutados
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/event?type=1&status=Ejecutados";
$rs         = API::GET($URL, $token);
$arrayEjecutados  = API::JSON_TO_ARRAY($rs);
//print("<pre>".print_r(($array) ,true)."</pre>"); die;
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

    <div class="col-lg-3 col-3">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?php echo count($arrayPlanificados); ?></h3>
            <p>Eventos Planificados</p>
          </div>
          <div class="icon">
          <i class="ion " ><ion-icon name="settings-outline"></ion-icon></i>
          </div>
          <a href="#" onclick="enviarParametrosGetsionCreate('event/eventList.php','Planificados')" class="small-box-footer">Ver Evento Activos <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-3">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo count($arrayEjecutados); ?></h3>
            <p>Eventos Ejecutados</p>
          </div>
          <div class="icon">
          <i class="ion " ><ion-icon name="settings-outline"></ion-icon></i>
          </div>
          <a href="#" onclick="enviarParametrosGetsionCreate('event/eventList.php','Ejecutados')" class="small-box-footer">Ver Ejecutados <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-3">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?php echo count($arrayCerrados); ?></h3>
            <p>Eventos Cerrados</p>
          </div>
          <div class="icon">
          <i class="ion " ><ion-icon name="settings-outline"></ion-icon></i>
          </div>
          <a href="#" onclick="enviarParametrosGetsionCreate('event/eventList.php','Cerrados')" class="small-box-footer">Ver Cancelados <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <div class="col-lg-3 col-3">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?php echo count($arrayTodos); ?></h3>
            <p>Total Eventos</p>
          </div>
          <div class="icon">
          <i class="ion " ><ion-icon name="settings-outline"></ion-icon></i>
          </div>
          <a href="#" onclick="enviarParametrosGetsionCreate('event/eventList.php','Todos')" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <div class="col-lg-12 col-12">
        <!-- small box -->
        <div class="small-box bg-warning">
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
