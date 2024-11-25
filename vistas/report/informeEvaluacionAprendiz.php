<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Evaluación Aprendiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       @media print {
        @page {
            size: letter landscape;
            margin: 10mm;
        }
        body {
            width: 100%;
            height: auto;
            overflow: visible;
        }
        .col-sm-12, .col-lg-12, .col-12, .card, .table-responsive, .table {
            width: 100%;
        }
        .content-header, .content-footer {
            position: fixed;
            width: 100%;
            background: white;
            z-index: 1000;
        }
        .content-header {
            top: 0;
        }
        .content-footer {
            bottom: 0;
        }
        #printButton, #printButtonNoScript {
            display: none;
        }
        .no-break {
            page-break-inside: avoid;
        }
        .table {
            font-size: 70%; /* Reduce el tamaño de la fuente en un 20% */
        }
    }
    body {
        width: 100%;
        height: auto;
        overflow: visible;
    }
    .logo {
        width: 50%;
    }
    .separator {
        border: 1px solid grey;
        width: 100%;
    }
    </style>
</head>
<body>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <?php include("evaHeaderReport.php"); ?>
    </div>

    <!-- Rest of your content -->
    <div class="container">

      <div id="printableArea">

        <?php
          if (!isset($_SESSION)) {
            session_start();
          }
          if (!isset($_SESSION['id_user'])) {
            header("Location:  " . $_SESSION['HTTP_ORIGIN']);
            exit();
          }
          include("scriptReport.php");

          require_once '../../funciones/wsdl/clases/consumoApi.class.php';
          $token = $_SESSION['token'];

          $_POST=$_GET;

          function edadAprendiz($fechaNacimiento){
            $fecha_nacimiento = @$fechaNacimiento;
            $fecha_actual = date("Y-m-d H:i:s");
            if (!$fecha_nacimiento) {
              return 0;
            }
            $timestamp_nacimiento = strtotime(@$fecha_nacimiento);
            $timestamp_actual = strtotime(@$fecha_actual);
            $diferencia = abs($timestamp_actual - $timestamp_nacimiento);
            $anios = floor($diferencia / (365 * 60 * 60 * 24));
            $meses = floor(($diferencia - $anios * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            return  $anios;
          }

          include("evaConsultasReport.php");

          require_once("style.php");
        ?>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="./style.css" >
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- /.content-header -->

        <!-- Main content -->
        <form action="../funciones/funcionesGenerales/XM_preEvaluacion.model.php" method="post" name="objetivo" id="objetivo"  enctype="multipart/form-data">

          <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
          <input type="hidden" name="idHeaderEvaluacion" value="<?php echo @$idHeaderEvaluacion; ?>">
          <div class="container-fluid">
            <div class="row">
              <!-- HEADER-->
              <div class="col-sm-12">
                <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-2" style="font-size: 1rem; background-color: #235382;">DATOS DE IDENTIFICACION</label>
              </div>
              <div class="col-lg-9 col-9">
                <!-- general form elements -->
                <div class="card card-primary">
                  
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                      <!-- INFORMACION DE LOS aprendiz -->
                      <?php include("evaAprendizReport.php"); ?>

                      <!-- INFORMACION DE LOS PADRES -->
                      <?php include("evaRepresentantesReport.php"); ?>
                     
                      <!-- INFORMACION DE LOS EVALUADORES -->
                      <?php include("evaEvaluadoresReport.php"); ?>

                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-3">
                <!-- INFORMACION DE LOS FECHAS -->
                <?php include("evaFechasReport.php"); ?>
              </div>
              <!-- INFORMACION DE LOS RESULTADOS COMPARATIVOS DE ACUERDO CON LA ESCALA DE ESTIMACIÓN EVOLUTIVA TAEO 8.0 (E.E.E) --> 
              <?php include("evaGraficosReport.php"); ?>
              <!-- INFORMACION DE LOS CONCLUSIONES Y RECOMENDACIONES -->
              <?php include("evaConclusionesReport.php"); ?>
              <!-- PAGINA DE LAS FIRMAS -->
              <?php include("evaFirmasReport.php"); ?>
              <!-- PAGINA DE LAS EVALUACIONES -->
              <?php include("evaEvaluacionesReport.php"); ?>
            </div>
            <!-- botton volver -->
            <div class="">
                <!-- botton ceerrar  -->
            </div>
          </div>
        </form>

      </div>
      <!-- Content Footer (Page footer) -->
      <div class="content-footer">
          <?php include("footerReport.php"); ?>
      </div>

    </div>
</body>
</html>