<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  " . $_SESSION['HTTP_ORIGIN']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';

//Listado Clientes
// demo
$id = @$_POST["id"];
$token = $_SESSION['token'];
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/representante?type=1";

$rs         = API::GET($URL, $token);
$arrayRepresentante  = API::JSON_TO_ARRAY($rs);

//print("<pre>".print_r(($URL) ,true)."</pre>"); //die;

?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Representante</h1>
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
            <h3><?php echo count($arrayRepresentante); ?></h3>
            <p>Num Representantes</p>
          </div>
          <div class="icon">
            <i class="ion "><ion-icon name="happy-outline"></ion-icon></i>
          </div>


          <!-- <a href="#" onclick="enviarParametrosGetsionCreate('admin/representanteCreate.php','1')" class="small-box-footer">Crear Representante <i class="fas fa-arrow-circle-right"></i></a> -->
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
            <h3 class="card-title">Listado de Representantes</h3>
          </div>
          <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nombre Represenatnte</th>
                <th>Cédula</th>
                <th>Profesión</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Retira Colegio</th>
                <th>Activo</th>

              </tr>
            </thead>
            <tbody>
              <?php foreach ($arrayRepresentante as $representante) { ?>
                <tr>
                  <td><a href="#" onclick="enviarParametrosGetsionUpdate('admin/representanteCreate.php',2,'<?php echo $representante['idRepresentante']; ?>')" class="nav-link "><?php echo $representante['apellidoRepresentante'].', '.$representante['nombreRepresentante']; ?></a></td>
                  <td><?php echo $representante['cedulaRepresentante']; ?></td>
                  <td><?php echo $representante['profesionRepresentante']; ?></td>
                  <td><?php echo $representante['telefonoRepresentante']; ?></td>
                  <td><?php echo $representante['correoRepresentante']; ?></td>
                  <td><?php if($representante['retirarAprendiz']==1){echo 'Si';}else{echo 'No';} ?></td>
                  <td><?php echo $representante['estado']; ?></td>
                </tr>
              <?php } ?>

            </tbody>
            <tfoot>
              <tr>
                <th>Nombre Represenatnte</th>
                <th>Cédula</th>
                <th>Profesión</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Retira Colegio</th>
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
