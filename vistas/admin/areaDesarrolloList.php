<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  " . $_SESSION['HTTP_ORIGIN']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';

//Listado Areas
$id = @$_POST["id"];
$token = $_SESSION['token'];
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/area?type=1";
$rs         = API::GET($URL, $token);
$arrayAreas  = API::JSON_TO_ARRAY($rs);

?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3 class="m-0">Areas de Desarrollo</h3>
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
        <div class="small-box bg-danger">
          <div class="inner">

            <h3><?php echo count($arrayAreas); ?></h3>
            <p>Num de Areas de Desarrollo</p>
          </div>
          <div class="icon">
            <i class="ion "><ion-icon name="happy-outline"></ion-icon></i>
          </div>


          <a href="#" onclick="enviarParametrosGetsionCreate('admin/areaDesarrolloCreate.php','1')" class="small-box-footer">Crear &Aacute;rea de Desarrollo <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <!-- ./col -->
    </div>
    <!-- /.row -->



    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs) -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listado de Áreas</h3>
          </div>
          <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>

                <th>Nombre</th>
                <th>Descripción</th>
                <th>Activo</th>

              </tr>
            </thead>
            <tbody>
              <?php foreach ($arrayAreas as $areas) { ?>
                <tr>
                  <td><a href="#" onclick="enviarParametrosGetsionUpdate('admin/areaDesarrolloCreate.php',2,'<?php echo $areas['idArea']; ?>')" class="nav-link "><?php echo $areas['nombreArea']; ?></a></td>
                  <td><?php echo substr($areas['descripcionArea'], 0, 1000); ?></td>
                  <td><?php echo $areas['estado']; ?></td>
                </tr>
              <?php } ?>

            </tbody>
            <tfoot>
              <tr>
              <th>Nombre</th>
                <th>Descripción</th>
                <th>Activo</th>
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
