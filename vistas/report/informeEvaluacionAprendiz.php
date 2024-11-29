<?php
require '../../vendor/autoload.php';

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id_user'])) {
    header("Location:  " . $_SESSION['HTTP_ORIGIN']);
    exit();
}

ob_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Evaluación Aprendiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
          
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }
        .content-header, .content-footer {
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
        .logo {
            width: 50%;
        }
        .separator {
            border: 1px solid grey;
            width: 100%;
        }
        .table {
            font-size: 55%;
        }
        #printableArea {
            font-size: 12px;
        }
    </style>
</head>
<body>
  <!-- Rest of your content -->
  <div class="container">
      <button id="generatePDF" class="btn btn-primary">Generar PDF</button>
      <div id="printableArea">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <?php include("evaHeaderReport.php"); ?>
        </div>
    
        <?php
          include("scriptReport.php");
          require_once '../../funciones/wsdl/clases/consumoApi.class.php';
          $token = $_SESSION['token'];
          $_POST = $_GET;

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

        <!-- Main content -->
        
        <form method="post" name="objetivo" id="objetivo"  enctype="multipart/form-data">
          <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
          <input type="hidden" name="idHeaderEvaluacion" value="<?php echo @$idHeaderEvaluacion; ?>">
          <div class="container-fluid">
          
            <div class="row">
              <!-- HEADER-->
              <div class="col-sm-12">
                <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-2" style="font-size: 1rem; background-color: #235382;">DATOS DE IDENTIFICACION</label>
              </div>
              <div class="col-lg-9 col-9">
                <div class="card card-primary">
                  <div class="card-body">
                    <div class="row">
                      <?php include("evaAprendizReport.php"); ?>
                      <?php include("evaRepresentantesReport.php"); ?>
                      <?php include("evaEvaluadoresReport.php"); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-3">
                <?php include("evaFechasReport.php"); ?>
              </div>
              <?php include("evaGraficosReport.php"); ?>
              <div class="col-sm-12">
                  <label for="conclucionesRecomendaciones" class="d-block text-center text-white " style="font-size: 1rem; background-color: #235382;">CONCLUSIONES Y RECOMENDACIONES</label>
                  <p><?php print_r(@$conclucionesRecomendaciones); ?></p>
              </div>
              <?php include("evaFirmasReport.php"); ?>
              <?php include("evaEvaluacionesReport.php"); ?>
            </div>
          </div>
        </form>


        
      </div>

      <div id="footerArea" class="content-footer">
        <?php include("footerReport.php"); ?>
    </div>
          
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<script>
    document.getElementById('generatePDF').addEventListener('click', function () {
        const element = document.getElementById('printableArea');
        const footer = document.getElementById('footerArea');

        if (!element || !footer) {
            console.error('Elementos footerArea o printableArea no encontrados.');
            return;
        }

        // Clonar el contenido del área imprimible y agregar el pie de página
        const clone = element.cloneNode(true);
        clone.appendChild(footer.cloneNode(true));

        // Configuración de html2pdf
        const opt = {
            margin:       1,
            filename:     'informe_evaluacion_aprendiz.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
        };

        // Generar el PDF
        html2pdf().from(clone).set(opt).save();
    });
</script>
</body>
</html>