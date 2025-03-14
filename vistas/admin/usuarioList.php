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
$id_usu = @$_POST["id_usu"];
$token = $_SESSION['token'];
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/empleados?type=1";
$rs         = API::GET($URL, $token);
$arrayUsuarios  = API::JSON_TO_ARRAY($rs);
//  echo $URL ;
//  print("<pre>".print_r(($rs) ,true)."</pre>"); //die;

 //print("<pre>".print_r(($arrayUsuarios) ,true)."</pre>"); //die;

?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Usuarios</h1>
        <h5 class="m-0">(Mediador (a)/Coordinador/Administrador)</h5>
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

      <?php
      // indicador de usuarios por rol
      $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/rol?type=1";
      $rs         = API::GET($URL, $token);
      $arrayRoles  = API::JSON_TO_ARRAY($rs);

      foreach ($arrayRoles as $rol) {

        $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/rol?type=2&idRol=".$rol['idRol'];
        $rs         = API::GET($URL, $token);
        $arrayUsuarioRol  = API::JSON_TO_ARRAY($rs);
        ?>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?php echo count($arrayUsuarioRol); ?></h3>

            <p><?php echo 'Rol: '.$rol['descripcionRol']; ?></p>
          </div>
          <div class="icon">
          <i class="ion " ><ion-icon name="people-outline"></ion-icon></ion-icon></i>
          </div>
          <a href="#" onclick="enviarParametrosGetsionCreate('admin/usuarioCreate.php','1')" class="small-box-footer">Crear <?php echo 'Rol: '.$rol['descripcionRol']; ?> <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <?php } ?>

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
            <h3 class="card-title">Listado de Usuarios</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre Y apellido</th>
                  <th>Rol</th>
                  <th>User</th>
                  <th>Activo</th>
                  <th>Teléfono</th>
                  <th>Teléfono Emergencia</th>
                  <th>Cédula/Rut</th>
                  <th>Email</th>
                  <th>Fecha Nacimiento</th>
                  <th>Cargo</th>
                </tr>
              </thead>
              <tbody>
              <?php if (!is_null($arrayUsuarios)) { ?>
                <?php foreach (@$arrayUsuarios as $usuario) {?>
                  <tr>
                    <td><a href="#" onclick="enviarParametrosGetsionUpdate('admin/usuarioCreate.php',2,'<?php echo $usuario['idUsuario']; ?>')" class="nav-link "><?php echo $usuario['apellidoUsuario'].', '.$usuario['nombreUsuario'];?></a></td>
                    <td><?php echo $usuario['descripcionRol'];?></td>
                    <td><?php echo $usuario['loginUsuario'];?></td>
                    <td><?php echo $usuario['estado'];?></td>
                    <td><?php echo $usuario['telefonoUsuario'];?></td>
                    <td><?php echo $usuario['TelefonoEmergencia'];?></td>
                    <td><?php echo $usuario['cedulaUsuario'];?></td>
                    <td><?php echo $usuario['emailUsuario'];?></td>
                    <td><?php echo $usuario['fechaNacimiento'];?></td>
                    <td><?php echo $usuario['descripcionCargo'];?></td>
                  </tr>
                <?php } ?>
                <?php } ?>

              </tbody>
              <tfoot>
                <tr>
                <th>Nombre Y apellido</th>
                  <th>Rol</th>
                  <th>User</th>
                  <th>Activo</th>
                  <th>Teléfono</th>
                  <th>Teléfono Emergencia</th>
                  <th>Cédula/Rut</th>
                  <th>Email</th>
                  <th>Fecha Nacimiento</th>
                  <th>Cargo</th>
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
