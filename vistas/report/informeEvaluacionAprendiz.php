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
                size: landscape;
                margin: 0;
            }
            body {
                margin: 1cm;
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
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <img src="../../dist/img/Logo-TAEO-horizontal-cyan.png" width=40% alt="Logo Taeo" class="logo">
                </div>
                <div class="col-sm-6 text-right">
                    <small>
                        TAEO VERSIÓN 8.0  11/21
                        <br>
                        Elaborado para la Organización Psicoeducativa TAEO por
                        <br>
                        <div class="row justify-content-end" style="display: flex; align-items: center;">
                            <div class="col-auto" style="border-right: 5px solid grey; padding-right: 10px;">
                                DRA. MAYLUC MARTÍNEZ<br>
                                MSc. LECTURA Y ESCRITURA- LCDA. EDUCACIÓN ESPECIAL<br>
                                ANALISTA CONDUCTUAL – MÁSTER ABA
                            </div>
                            <div class="col-auto" style="padding-left: 10px;">
                                MA. GABRIELA FERNÁNDEZ<br>
                                LCDA. EN PSICOLOGÍA<br>
                                MENCIÓN CLÍNICA
                            </div>
                        </div>
                    </small>
                    <button id="printButtonNoScript" class="btn btn-primary" onclick="window.print()">Imprimir</button>
                </div>
            </div>
            <hr class="separator">
        </div>
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


          //print( "<pre>".print_r(($_SESSION) ,true)."</pre>"); //die;

          require_once '../../funciones/wsdl/clases/consumoApi.class.php';
          $token = $_SESSION['token'];

          //print("<pre>".print_r(($_POST) ,true)."</pre>"); //die;
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


          // busqueda de los distintos aprendices activos creados
          $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/aprendiz?type=1";
          $rs         = API::GET($URL, $token);
          $arrayAprendices  = API::JSON_TO_ARRAY($rs);

          //Sedes
          $URL1        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/sede?type=1";
          $rs         = API::GET($URL1, $token);
          $arraySede  = API::JSON_TO_ARRAY($rs);

          //facilitadores
          $URL1        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/empleados?type=3&rolUsuario=3";
          $rs         = API::GET($URL1, $token);
          $arrayFacilitadores  = API::JSON_TO_ARRAY($rs);

          $flag=true;
          $accion = "Actualizar";
          $disabled = 'disabled';

          //datos Representante
          $idHeaderEvaluacion = @$_POST["id"];

          //consulta de los header
          $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=1&idHeaderEvaluacion=$idHeaderEvaluacion";
          $rs         = API::GET($URL, $token);
          $arrayHeader  = API::JSON_TO_ARRAY($rs);

          //VARIABLES PARA EDICION
          $idHeaderEvaluacion = @$arrayHeader[0]['idHeaderEvaluacion'];
          $fechaUltimaEvaluacion = @$arrayHeader[0]['fechaUltimaEvaluacion'];
          $fechaEvaluacion = @$arrayHeader[0]['fechaEvaluacion'];
          $conclucionesRecomendaciones = @$arrayHeader[0]['conclucionesRecomendaciones'];
          $idAprendiz = @$arrayHeader[0]['idAprendiz'];
          $idEvaluadoPor = @$arrayHeader[0]['idEvaluadoPor'];
          $idSede = @$arrayHeader[0]['idSede'];
          $activo = @$arrayHeader[0]['activo'];
          $observacion = @$arrayHeader[0]['observacion'];
          $creadoPor = @$arrayHeader[0]['creadoPor'];
          $fechaNacimientoAprendiz = @$arrayHeader[0]['fechaNacimientoAprendiz'];
          $nombreAprendiz= @$arrayHeader[0]['apellidoAprendiz'].', '.@$arrayHeader[0]['nombreAprendiz'];
          $nombreAprendizAux= '('.$nombreAprendiz.')';
          $anioAprendiz=edadAprendiz($fechaNacimientoAprendiz);

          $idNivelEvaluacion= @$_POST["idNivelEvaluacion"];
          $edadCronologica= @$_POST["edadCronologica"];
          $idAreaEvaluacion= @$_POST["idAreaEvaluacion"];

          //echo $fechaUltimaEvaluacion;
          //consulta de los NIVELES PARA LA CREACION
          $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=6";
          $rs         = API::GET($URL, $token);
          $arrayNiveles  = API::JSON_TO_ARRAY($rs);

          //consulta de los ITEMS PARA LA CREACION
          $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=5";
          $rs         = API::GET($URL, $token);
          $arrayItemCreate  = API::JSON_TO_ARRAY($rs);

          //consulta las calificaciones de una evaluaicon
          $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/evaluacion?type=3";
          $rs         = API::GET($URL, $token);
          $arrayEvaluacion  = API::JSON_TO_ARRAY($rs);

          //consulta de los ITEMS PARA LA CREACION
          $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=7&idHeaderEvaluacion=$idHeaderEvaluacion";
          $rs         = API::GET($URL, $token);
          $arrayResumen  = API::JSON_TO_ARRAY($rs);

          //consulta de los items
          $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=2";
          $rs         = API::GET($URL, $token);
          $arrayItemByHeader  = API::JSON_TO_ARRAY($rs);

          require_once("style.php")  ;
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
              <div class="col-lg-12 col-12">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title"><?php echo $accion; ?> Evaluación <?php echo @$nombreAprendizAux;?></h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" id="HeaderTable">
                        <i class="fas fa-minus"></i>
                      </button>

                    </div>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-3">
                          <label for="Aprendiz">Aprendiz</label>
                                            <select class="form-control" name="idAprendiz" id="Aprendiz" <?php echo @$disabled;?> onchange="fetchNiveles(this.value,<?php echo $_POST['mod'];?>)" required>
                            <option  value=''>Seleccione</option>
                            <?php foreach($arrayAprendices as $dataAprendices ){?>
                              <option <?php if ($dataAprendices['idAprendiz'] == @$idAprendiz) {echo 'selected';} ?> value=<?php echo $dataAprendices['idAprendiz']; ?>><?php echo strtoupper($dataAprendices['apellidoAprendiz'].', '. $dataAprendices['nombreAprendiz']);?></option>
                            <?php }?>
                          </select>
                        </div>
                        <div class="col-sm-2">
                          <label for="idHeaderEvaluacionAnteriorl">Evaluación previa</label>
                          <select class="form-control" name="idHeaderEvaluacionAnterior" id="idHeaderEvaluacionAnterior" <?php echo @$disabled;?>  <?php if ($_POST['mod']==1){echo 'disabled';}?>>

                          </select>
                        </div>
                        <div class="col-sm-2">
                          <label for="sede">Sede:</label>
                          <select class="form-control" name="idSede" id="idSede"  <?php echo @$disabled;?>  onchange="fetchMediadores(this.value,'')"  required>
                            <option value=''>Seleccione</option>
                            <?php foreach($arraySede as $sede ){?>
                              <option <?php if ($sede['idSede'] == @$idSede) {echo 'selected';} ?> value=<?php echo $sede['idSede']; ?>><?php echo $sede['nombreSede']; ?></option>
                            <?php }?>
                          </select>
                        </div>
                        <div class="col-sm-4">
                          <label for="aprendiz">Evaluadores:</label>
                          <div id="idFacilitadorContainer">
                            <!-- Checkboxes will be populated here by fetchMediadores -->
                          </div>
                        </div>
                        <div class="col-sm-1">
                          <label>Activo</label>
                          <select class="form-control" name="activo" id="activo"  required>
                            <option <?php if (@$activo == 1) {
                                      echo 'selected';
                                    } ?> value=1>Activo</option>
                            <option <?php if (@$activo == 0) {
                                      echo 'selected';
                                    } ?> value=0>Desactivado</option>
                            <option <?php if (@$activo == 2)  {
                                      echo 'selected';
                                    } ?> value=2>Cerrada</option>
                          </select>
                        </div>
                        <div class="col-sm-12">

                          <div class="col-sm-12">
                              <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-2" style="font-size: 1.75rem; background-color: #235382;">CONCLUSIONES Y RECOMENDACIONES</label>
                              <?php echo @$conclucionesRecomendaciones; ?>
                          </div>

                          <div class="col-sm-12">
                            <label for="nombreRepresentante">Observacion Evaluación</label>
                            <textarea  id="observacion" name="observacion"><?php echo @$observacion; ?></textarea>
                          </div>

                          <div class="col-sm-2">
                            <label for="cedulaRepresentante">Fecha Creación de la Evaluacion</label>
                            <input type="text" class="form-control" readonly name="fechaCreacion" id="fechaCreacion" placeholder="fechaCreacion" value="<?php echo @$fechaEvaluacion; ?>">
                          </div>

                          <div class="col-sm-2">
                            <label for="telefonoRepresentante">Creado Por</label>
                            <input type="text" class="form-control" name="creadoPor" id="creadoPor" placeholder="creadoPor" readonly value="<?php echo @$creadoPor; ?>">
                          </div>

                        </div>

                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <!-- ITEMS  -->
              <div class="col-lg-12 col-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Detalle de la Evaluacion </h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"  id="HeaderItems">
                          <i class="fas fa-minus"></i>
                        </button>

                      </div>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 col-12">
                          <div class="card">
                            <div class="card-header bg-gray">
                              <h3 class="card-title">Resumen  de Evaluaciones Creadas</h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"  id="HeaderDetail">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                </thead>
                                <tbody>
                                  <?php
                                  $currentNivel = '';
                                  $currentEdad = '';
                                  $areas = [];
                                  $dataByNivelAndEdad = [];
                                  foreach ($arrayResumen as $datoResumen) {
                                    $nivel = $datoResumen['nombreNivelEvaluacion'];
                                    $edad = $datoResumen['edadCronologica'];
                                    $area = $datoResumen['nombreAreaEvaluacion'];

                                    if (!isset($dataByNivelAndEdad[$nivel])) {
                                      $dataByNivelAndEdad[$nivel] = [];
                                    }
                                    if (!isset($dataByNivelAndEdad[$nivel][$edad])) {
                                      $dataByNivelAndEdad[$nivel][$edad] = [];
                                    }
                                    if (!isset($dataByNivelAndEdad[$nivel][$edad][$area])) {
                                      $dataByNivelAndEdad[$nivel][$edad][$area] = [];
                                    }

                                    $dataByNivelAndEdad[$nivel][$edad][$area][] = $datoResumen;

                                    if (!in_array($area, $areas)) {
                                      $areas[] = $area;
                                    }
                                  }

                                  $numAreas = count($areas)*2;

                                  // Print data

                                  $modalsData = []; // Array para almacenar los datos de los modales


                                  foreach ($dataByNivelAndEdad as $nivel => $edades) {
                                    echo "<tr class='bg-danger'><td colspan='$numAreas'><strong>Nivel: " . strtoupper($nivel) . "</strong></td></tr>";
                                    ksort($edades); // Sort edades by key (edad) in ascending order
                                    foreach ($edades as $edad => $areasData) {
                                      echo "<tr><td class='bg-info' colspan='$numAreas'><strong>Edad Cronologica: " . $edad . "</strong></td></tr>";
                                      echo "<tr>";
                                      $columnIndex = 1;
                                      foreach ($areas as $area) {
                                        $class = "gradient-blue-$columnIndex";
                                        echo "<th class='$class'>" . strtoupper($area) . "</th>";
                                        echo "<th class='$class'>eva.</th>";
                                        $columnIndex = ($columnIndex % 8) + 1; // Cycle through 1 to 8
                                      }
                                      echo "</tr>";
                                      $maxRows = max(array_map('count', $areasData));
                                      for ($i = 0; $i < $maxRows; $i++) {
                                        echo "<tr>";
                                        $columnIndex = 1;
                                        foreach ($areas as $area) {
                                          $class = "gradient-blue-$columnIndex";
                                          if (isset($areasData[$area][$i])) {
                                            $detalle = $areasData[$area][$i]['detalleEvalaacion'];
                                            $evaluacion = $areasData[$area][$i]['evaluacion_detalle'];
                                            $id = isset($areasData[$area][$i]['idDetalleEvaluacion']) ? $areasData[$area][$i]['idDetalleEvaluacion'] : ''; // Verificar si 'idDetalleEvaluacion' existe

                                            switch ($evaluacion) {
                                              case 'AT':
                                                $icon = 'X';
                                                $class = 'Atotal';
                                                break;
                                              case 'AP':
                                                $icon = 'P';
                                                $class = 'AParcial';
                                                break;
                                              case 'SA':
                                                $icon = '√';
                                                break;
                                            }

                                            // Generar un ID único para el modal
                                            $modalId = "editModal_$id";

                                            echo "<td class='$class'><a href='#' class='edit-link' data-toggle='modal' data-target='#$modalId' data-id='$id' data-idHeaderEvaluacion='$idHeaderEvaluacion' data-nivel='$nivel' data-edad='$edad' data-area='$area' data-descripcion='$detalle' data-evaluacion='$evaluacion'>$detalle</a></td><td class='$class'> $icon ($evaluacion)</td>";

                                            // Almacenar los datos del modal en el array
                                            $modalsData[] = [
                                              'modalId' => $modalId,
                                              'id' => $id,
                                              'nivel' => $nivel,
                                              'idNivelEvaluacion' => $areasData[$area][$i]['idNivelEvaluacion'],
                                              'edad' => $edad,
                                              'edadCronologica' => $areasData[$area][$i]['edadCronologica'],
                                              'area' => $area,
                                              'idAreaEvaluacion' => $areasData[$area][$i]['idAreaEvaluacion'],
                                              'descripcion' => $detalle,
                                              'evaluacion' => $evaluacion,
                                              'idHeaderEvaluacion'=>$idHeaderEvaluacion
                                            ];
                                          } else {
                                            echo "<td class='$class'></td><td class='$class'></td>";
                                          }
                                          $columnIndex = ($columnIndex % 8) + 1; // Cycle through 1 to 8
                                        }
                                        echo "</tr>";
                                      }
                                    }
                                  }
                                  ?>
                                </tbody>
                                <tfoot>
                                  <tr>
                                  </tr>
                                </tfoot>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>

                  </div>
              </div>
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
      <script>
          document.addEventListener('DOMContentLoaded', function() {
            <?php if ($_POST['mod'] == 2): ?>
              fetchNiveles('<?php echo @$idAprendiz; ?>','<?php echo @$_POST['mod']; ?>');
              fetchMediadores('<?php echo @$idSede; ?>','<?php echo  $idEvaluadoPor; ?>');

              document.getElementById('HeaderTable').click();
            // document.getElementById('HeaderItems').click();
            // document.getElementById('HeaderDetail').click();

            <?php endif; ?>
          });
      </script>
      <!-- ******************** -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    </div>
</body>
</html>
