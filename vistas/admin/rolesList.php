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
$idEmpresaConsultora = @$_POST["id"];
$token = $_SESSION['token'];
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/rol?type=1";
$rs         = API::GET($URL, $token);
$array  = API::JSON_TO_ARRAY($rs);

//print("<pre>".print_r(($arrayClientes) ,true)."</pre>"); / /die;
?>

<!-- Content Header (Page header)  -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Roles</h1>
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
            <h3><?php echo count($array); ?></h3>
            <p>Roles</p>
          </div>
          <div class="icon">
          <i class="ion " ><ion-icon name="settings-outline"></ion-icon></i>
          </div>
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
            <h3 class="card-title">Listado de Roles para el Sistema de TAEO</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>

                  <th>Nombre Rol</th>
                  <th>Order</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($array as $rol) { ?>
                 <tr>
                            <td>
                              <!-- <a href="#" onclick="enviarparametrosgetsionupdate('admin/rolescreate.php',2,'<?php echo $rol['idrol']; ?>')">  -->
                                <?php echo $rol['descripcionRol']; ?>
                              <!-- </a> -->
                            </td>
                            <td><?php echo $rol['orderRol']; ?></td>
                          </tr>
                <?php } ?>

              </tbody>
              <tfoot>
                <tr>

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
