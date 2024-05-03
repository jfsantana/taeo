<?php
if (!isset($_SESSION)) {
  session_start();
}
session_unset();
session_destroy();
?><!DOCTYPE html>
<html lang="en">

<head>

  <?php include_once('add/head_Aux_.php');
  require_once '../funciones/wsdl/clases/consumoApi.class.php';
   ?>
  <style>
    .login-page {
      background: url('./dist/img/foot_Image.jpg') repeat-x;
      background-size: auto;
      background-position: left bottom;
    }
  </style>
</head>

<body class=" login-page">

  <div class="login-box">
    <!-- /.login-logo   -->
    <div class="card card-outline card-primary">
      <div class="text-center">
        <img src='./dist/img/logo_taeho.png' width="50%" alt='El Mejor Instituto'>
      </div>

      <div class="card-body">
        <div class="card-header text-center">
          <a href="../index.html" class="h1"><?php echo $nombreSoftware; ?></a></br>

        </div>
        <div class="card-body">
          <!-- <p class="login-box-msg">Inicie sesión</p> -->

        <?php
          $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/sede?type=1";
          $rs         = API::GET($URL, $token);
          $arraySede  = API::JSON_TO_ARRAY($rs);
          ?>

          <form name="login" id="login" action="funciones/funcionesGenerales/XM_validarusu.php" method="POST">
            <div class="col-sm-12">
              <label>Sede</label>
              <select class="form-control select " name="locacion" required id="idEmpresaConsultora">
                <option value="">Seleccione</option>
                <?php foreach ($arraySede as $sede) {?>
                <option value="1">Ve - Prebo 1</option>

                <option value='<?php echo $sede['idSede']; ?>' ><?php echo $sede['nombreSede']; ?></option>

                <?php } ?>

                <!-- < ?php foreach ($arrayCconsultora as $consultora) { ?>
                  <option < ?php if (@$idEmpresaConsultora == $consultora['idEmpresaConsultora']) {
                            echo 'selected';
                          } ?> value=< ?php echo $consultora['idEmpresaConsultora']; ?>>< ?php echo $consultora['nombreEmpresaConsultora']; ?></option>
                < ?php } ?> -->
              </select>
                        </br>
            </div>

            <div class="input-group mb-3">
              <input name="user" type="text" class="form-control" required placeholder="user">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input name="password" type="password" class="form-control" required placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">

              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <!-- /.social-auth-links -->


          <p class="mb-0">

          <div class="form-group text-center" style="font-size:100%; margin-bottom: 5px; height: 10px;">
            <b> <?php echo @$_GET['mensaje']; ?></b>
            <br>

            <!-- <a href="register.html" class="text-center">Register a new membership</a> -->
          </div>
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->


    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>
