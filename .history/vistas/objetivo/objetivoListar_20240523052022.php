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
$id = @$_POST["id"];
$token = $_SESSION['token'];
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/objetivo?type=1";

$rs         = API::GET($URL, $token);
$arrayObjetivo  = API::JSON_TO_ARRAY($rs);

//print("<pre>".print_r(($arrayClientes) ,true)."</pre>"); //die;

?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Objetivos</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-12">
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo count($arrayObjetivo); ?></h3>
            <p>Num Objetivos</p>
          </div>
          <div class="icon">
            <i class="ion "><ion-icon name="happy-outline"></ion-icon></i>
          </div>

          <a href="#" onclick="enviarParametrosGetsionCreate('objetivo/objetivoCreate.php','1')" class="small-box-footer">Importar Objetivos desde un Excel - <i class="fa fa-file-excel"></i></a>
        </div>
      </div>


    </div>

    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listado de Representantes</h3>
          </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nombre Objetivo</th>
                <th>Observacion</th>
                <th>Creado por</th>
                <th>Activo</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($arrayObjetivo as $objetivo) { ?>
                <tr>
                  <td><a href="#" onclick="enviarParametrosGetsionUpdate('objetivo/objetivoCreate.php',2,'<?php echo $objetivo['idObjetivoHeader']; ?>')" class="nav-link "><?php echo $objetivo['nombreObjetivo']; ?></a></td>
                  <td><?php echo substr($objetivo['observacionObjetivo'], 0, 500); ?></td>
                  <td><?php echo $objetivo['creadoPor']; ?></td>
                  <td><?php echo $objetivo['estado']; ?></td>
                </tr>
              <?php } ?>

            </tbody>
            <tfoot>
              <tr>
              <th>Nombre Objetivo</th>
                <th>Observacion</th>
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
