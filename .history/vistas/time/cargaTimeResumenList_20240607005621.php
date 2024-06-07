<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}

//var_dump($_POST);

require_once '../funciones/wsdl/clases/consumoApi.class.php';
$token = $_SESSION['token'];
// print("<pre>".print_r(($arrayClientes) ,true)."</pre>"); //die;



if ($_SESSION['id_rol'] < 30) {
  $idAux = '';
  if (!isset($_POST['idProyecto'])) {
    $idProyectoAux = '';
  } else {
    $idProyectoAux = @$_POST['idProyecto'];
  }
  //'id' => string '122'
} else {
  $idProyectoAux = '';
}


if ($_SESSION['id_rol'] < 30) {
  $idAux = '';
  if (!isset($_POST['id'])) {
    $idAux = '';
  } else {
    $idAux = @$_POST['id'];
  }
  //'id' => string '122'
} else {
  $idAux = $_SESSION['id_user'];
}

if ($_SESSION['id_rol'] < 30) {
  $corteAux = '';
  if (!isset($_POST['mod'])) {
    $corteAux = '';
    $corteAux = $_SESSION['corte'];
  } else {
    $corteAux = @$_POST['mod'];
  }
  //'id' => string '122'
} else {
  $corteAux = $_SESSION['corte'];
}

if(@$_POST['corteActual']){

}else{
  $_POST['corteActual']=$corteAux;
}

if(@$_POST['corteSelect']){

}else{
  $_POST['corteSelect']=$corteAux;
}
// var_dump($_SESSION['id_rol'] );
// var_dump($corteAux);

//Lista de Sedes de taeo
$token = $_SESSION['token'];
$URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/sede?type=3&idUsuario=".$_SESSION['id_user'];
$rs         = API::GET($URL1, $token);
$arraySede  = API::JSON_TO_ARRAY($rs);
//echo $URL1 ;

if ($_SESSION['id_rol'] == 20) {
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/time?id=" . $idAux . "&corte=" . $_POST['corteSelect'] . "&idProyecto=" . $idProyectoAux . "&idAprobador=" . $_SESSION['id_user'];
} else {
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/time?id=" . $idAux . "&corte=" . $_POST['corteSelect'] . "&idProyecto=" . $idProyectoAux . "&idProyecto=";
}
//var_dump($URL);
$rs         = API::GET($URL, $token);
$arrayTiempo  = API::JSON_TO_ARRAY($rs);
//var_dump($URL);

$meses = array(
  1 => '01',
  2 => '02',
  3 => '03',
  4 => '04',
  5 => '05',
  6 => '06',
  7 => '07',
  8 => '08',
  9 => '09',
  10 => '10',
  11 => '11',
  12 => '12'
);
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">

        <h1 class="m-0">Planificaci&oacute;n por Sede:

          <select class="form-control" name="sede" id="miSelect" onchange="enviarRegistoTiempo('time/cargaTimeResumenList.php','<?php echo $corteAux; ?>',this.value)" required>
          <option> Seleccione</option>
            <?php  foreach ($arraySede  as $sede) {   //checked?>

              <option value='<?php echo $sede['idSede']; ?>' <?php if (@$rolUsuario == $sede['idSede']) {
                                                                      echo 'selected';
                                                                    } ?>>
                        <?php echo $sede['nombreSede']; ?>
                      </option>
            <?php } ?>

          </select></h1>
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
      <div class="col-lg-6 col-12">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>Evaluar Planificaci&oacute;n</h3>

            <p>Muestra el listado de Planificaicones para ser evaluadas<br></p>
          </div>
          <div class="icon">
            <i class="ion ion-archive"></i>
          </div>
          <!-- onclick="enviarParametrosGetsionUpdate('time/facturaCreate.php','<?php echo $idAux; ?>','<?php echo $_SESSION['corte']; ?>')" -->
          <a href="#"  class="small-box-footer">Ver Planificaicones <i class="fas fa-arrow-circle-right"></i>
        </a>
        </div>
      </div>
      <div class="col-lg-6 col-12">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>Consultar Planificaci&oacute;n</h3>

            <p>Seccion para visualizar las evaluaciones de una Planificaci&oacute;n</p>
          </div>
          <div class="icon">
            <i class="ion ion-edit "></i>
          </div>
          <!-- onclick="enviarParametrosGetsionCreate('time/cargaTimeCreate.php','1')" -->
          <a href="#"  class="small-box-footer">Registro de Tiempos <i class="fas fa-arrow-circle-right"></i></a>
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
            <h3 class="card-title">Listado las ultimas Evaluaciones</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="registro" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 2%;"></th>
                  <th>Facilitador</th>
                  <th>Sede</th>
                  <th>Aprendiz</th>
                  <th>Plan</th>
                  <th>Actividad</th>


                </tr>
              </thead>
              <tbody>
                <?php
                $total = 0;
                // foreach ($arrayTiempo as $TiempoCarga) {   ?>

                <?php //} ?>
              </tbody>
              <tfoot>
                <tr>
                  <th style="width: 2%;"></th>
                  <th>Facilitador</th>
                  <th>Sede</th>
                  <th>Aprendiz</th>
                  <th>Plan</th>
                  <th>Actividad</th>
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
