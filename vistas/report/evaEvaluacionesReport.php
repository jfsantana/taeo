<div id="graficoContainer" class="row">
  <div class="col-sm-12">
    <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-2" style="font-size: 1rem; background-color: #235382;">ESCALA DE ESTIMACIÓN EVOLUTIVA TAEO 8.0 (E.E.E)</label>
  </div><?php 

  //ARREGLO PARA LOS CALCULOSD E LA EVALUACION ANTERIOR (datos de la evaluacion anterior : $arrayResumenEvaAnterior)
  $arrayResumenGraficoAllAnterior = [];
  $reumenByAreaAnterior = [];
  $GraficoFinalReevaluacionAnterior=[];



  //ARREGLO PARA LOS CALCULOSD E LA EVALUACION ACTUAL
  $arrayResumenGraficoAll = [];
  $reumenByArea = [];
  $GraficoFinalReevaluacion=[];
  ?>
  <!-- ITEMS  -->
  <div class="col-lg-12 col-12">
    <div class="card card-primary">

        <div class="card-body">
            <div class="col-lg-12 col-12">
              <div class="card">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    </thead>
                    <tbody>
                      <?php
                      $currentNivel = '';
                      $currentEdad = '';
                      $areas = [];
                      $dataByNivelAndEdad = [];
                      
                      //en array resumen esta todo lo que necesito para armar las graficas y dentro de este foreach recorre la informacion para armar la tabla
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

                      $modalsData = []; 

                      //Aqui recorre NIVEL
                      foreach ($dataByNivelAndEdad as $nivel => $edades) {
                        $tituloGrafico='';
                        $tituloGrafico= strtoupper($nivel);
                        echo "<tr ><td colspan='$numAreas'><strong>Nivel: " . strtoupper($nivel) . "</strong></td></tr>";
                        ksort($edades); // Sort edades by key (edad) in ascending order

                        


                        //aqui recorre EDAD CRONOLOGICA
                        //////////////
                        foreach ($edades as $edad => $areasData) {
                            $tituloGraficoResumen = '';
                            $totalAreaLogrado = 0;
                            $totalAreaApoyoParcial = 0;
                            $totalAreaApoyoTotal = 0;
                            $totalAusentes = 0;
                            $totalActividades = 0;
                            $tituloGraficoResumen = $tituloGrafico . "(Edad: $edad)";

                            // Necesito crear un id único para cada gráfico (eliminando los espacios en blanco y los caracteres especiales en el título)
                            $tituloGraficoResumenID = str_replace(' ', '', strtoupper($nivel));
                            $idGraficoResumen = $tituloGraficoResumenID . "_" . $edad;
                            $nivelGraficoResumen = $tituloGraficoResumenID;

                            echo "<tr><td colspan='$numAreas'><strong>Edad Cronologica: " . $edad . "</strong></td></tr>";
                            echo "<tr>";
                            $columnIndex = 1;
                            foreach ($areas as $area) {
                                $class = "gradient-blue-$columnIndex";
                                echo "<th class='$class'>" . strtoupper($area) . "</th>";
                                echo "<th class='$class'>eva.</th>";
                                $columnIndex = ($columnIndex % 8) + 1; // Cycle through 1 to 8
                            }
                            echo "</tr>";

                            //aqui recorre las areas
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
                                                $totalAreaApoyoTotal = $totalAreaApoyoTotal + 1;
                                                $totalAusentes = $totalAusentes + 1;
                                                break;
                                            case 'AP':
                                                $icon = 'P';
                                                $class = 'AParcial';
                                                $totalAreaApoyoParcial = $totalAreaApoyoParcial + 1;
                                                $totalAusentes = $totalAusentes + 1;
                                                break;
                                            case 'SA':
                                                $icon = '√';
                                                $totalAreaLogrado = $totalAreaLogrado + 1;
                                                break;
                                        }

                                        

                                        // Generar un ID único para el modal
                                        $modalId = "editModal_$id";

                                        echo "<td class='$class'>$detalle</td>
                                              <td class='$class'> $icon ($evaluacion)</td>";

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
                                            'idHeaderEvaluacion' => $idHeaderEvaluacion
                                        ];
                                    } else {
                                        echo "<td class='$class'></td><td class='$class'></td>";
                                    }
                                    $columnIndex = ($columnIndex % 8) + 1; // Cycle through 1 to 8
                                }
                                echo "</tr>";
                            }

                            $totalActividades = $totalAreaLogrado + $totalAusentes;
                            $porAlcanzado = round(($totalAreaLogrado / $totalActividades) * 100, 2);$porAusentes = round(($totalAusentes / $totalActividades) * 100, 2);

                            // Crear un array para consolidar los datos de los gráficos con todos los datos
                            $arrayResumenGrafico = [
                                'tituloGraficoResumen' => $tituloGraficoResumen,
                                'idGraficoResumen' => $idGraficoResumen,
                                'totalActividades' => $totalActividades,
                                'totalAreaLogrado' => $totalAreaLogrado,
                                'totalAreaApoyoParcial' => $totalAreaApoyoParcial,
                                'totalAreaApoyoTotal' => $totalAreaApoyoTotal,
                                'totalAusentes' => $totalAusentes,
                                'porAlcanzado' => $porAlcanzado,
                                'porAusentes' => $porAusentes,
                                'nivelGraficoResumen' => $nivelGraficoResumen

                            ];

                            
                            $arrayResumenGraficoAll[] = $arrayResumenGrafico;

                            $grafico = "<div class='col-sm-12'>
                                          <label id='$tituloGraficoResumen' class='d-block text-center text-white py-1' style='font-size: 1rem; background-color: #00B9F1;'>$tituloGraficoResumen</label>
                                          <canvas id='$idGraficoResumen' style='min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;'></canvas>
                                        </div>";

                            echo "
                            <tr>
                              <td colspan='$numAreas'>
                              Resumen:
                                <div style='display: flex; justify-content: center;'>
                                  <table width='50%'>
                                    <tr>
                                      <td width='30%'>
                                        <table width='100%'>
                                          <tr><td>H. Esperadas:</td><td>$totalActividades</td></tr>
                                          <tr><td>H. Alcanzadas:</td><td>$totalAreaLogrado </td></tr>
                                          <tr><td>H Ausentes:</td><td>$totalAusentes </td></tr>
                                        </table>
                                      </td>
                                      <td width='30%'>
                                        <table width='100%'>
                                          <tr><td colspan=2>PROMEDIO</td></tr>
                                          <tr><td>Alzanzado:</td><td>$porAlcanzado%</td></tr>
                                          <tr><td>Por Alcanzar:</td><td>$porAusentes%</td></tr>
                                        </table>
                                      </td>
                                      <td rowspan='3'>$grafico</td>
                                    </tr>
                                  </table>
                                </div>
                              </td>
                            </tr>";
                        }
                        /////////////
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


<?php
    $resultadosPorArea = [];

    foreach ($arrayResumen as $datoResumen) {
        $idAreaEvaluacion = $datoResumen['idAreaEvaluacion'];
        $nombreAreaEvaluacion = $datoResumen['nombreAreaEvaluacion'];
        $evaluacionDetalle = $datoResumen['evaluacion_detalle'];

        if (!isset($resultadosPorArea[$idAreaEvaluacion])) {
            $resultadosPorArea[$idAreaEvaluacion] = [
                'nombreArea' => $nombreAreaEvaluacion,
                'totalActividades' => 0,
                'totalLogradas' => 0,
                'totalApoyoParcialMasAusentes' => 0,
                'totalApoyoTotal' => 0,
                'totalAusentes' => 0
            ];
        }

        $resultadosPorArea[$idAreaEvaluacion]['totalActividades']++;

        switch ($evaluacionDetalle) {
            case 'SA':
                $resultadosPorArea[$idAreaEvaluacion]['totalLogradas']++;
                break;
            case 'AP':
                $resultadosPorArea[$idAreaEvaluacion]['totalApoyoParcialMasAusentes']++;
                $resultadosPorArea[$idAreaEvaluacion]['totalAusentes']++;
                break;
            case 'AT':
                $resultadosPorArea[$idAreaEvaluacion]['totalApoyoTotal']++;
                $resultadosPorArea[$idAreaEvaluacion]['totalAusentes']++;
                break;
        }
    }

    // Calcular porcentajes
    foreach ($resultadosPorArea as $idArea => $resultados) {
        $totalActividades = $resultados['totalActividades'];
        $totalLogradas = $resultados['totalLogradas'];
        $totalAusentes = $resultados['totalAusentes'];

        $resultadosPorArea[$idArea]['porcentajeLogradas'] = ($totalLogradas / $totalActividades) * 100;
        $resultadosPorArea[$idArea]['porcentajeAusentes'] = ($totalAusentes / $totalActividades) * 100;
    }

    //Imprimir resultados para verificación
    // echo '<pre>';
    // print_r($resultadosPorArea);
    // echo '</pre>';


    $totalActividades = 0;
    $totalLogradas = 0;
    $totalApoyoParcialMasAusentes = 0;
    $totalApoyoTotal = 0;
    $totalAusentes = 0;

    foreach ($resultadosPorArea as $resultados) {
        $totalActividades += $resultados['totalActividades'];
        $totalLogradas += $resultados['totalLogradas'];
        $totalApoyoParcialMasAusentes += $resultados['totalApoyoParcialMasAusentes'];
        $totalApoyoTotal += $resultados['totalApoyoTotal'];
        $totalAusentes += $resultados['totalAusentes'];
    }

    $porcentajeLogradas = ($totalLogradas / $totalActividades) * 100;
    $porcentajeAusentes = ($totalAusentes / $totalActividades) * 100;

    $GraficoFinalReevaluacion = [
        'tituloGraficoResumen' => 'FECHA DE REEVALUACIÓN: --',
        'totalActividades' => $totalActividades,
        'totalLogradas' => $totalLogradas,
        'totalApoyoParcialMasAusentes' => $totalApoyoParcialMasAusentes,
        'totalApoyoTotal' => $totalApoyoTotal,
        'totalAusentes' => $totalAusentes,
        'porcentajeLogradas' => $porcentajeLogradas,
        'porcentajeAusentes' => $porcentajeAusentes
    ];

       echo '<pre>';
       print_r($GraficoFinalReevaluacion);
       echo '</pre>';

?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      // Suponiendo que $arrayResumenGraficoAll se convierte a JSON y se pasa a JavaScript
      var arrayResumenGraficoAll = <?php echo json_encode($arrayResumenGraficoAll); ?>;
      //console.log('<?php echo json_encode($arrayResumenGraficoAll); ?>');
      
      // Asegúrate de que haya un contenedor específico para los gráficos
      var graficoContainer = document.getElementById('graficoContainer');
      if (!graficoContainer) {
          graficoContainer = document.createElement('div');
          graficoContainer.id = 'graficoContainer';
          graficoContainer.className = 'row';
          document.body.appendChild(graficoContainer);
      }

      arrayResumenGraficoAll.forEach(function(graficoData) {

          var titulo = graficoData.tituloGraficoResumen;
          var idGrafico = graficoData.idGraficoResumen;
          var porAlcanzado = graficoData.porAlcanzado;
          var porAusentes = graficoData.porAusentes;

          // Crear el contenedor del gráfico
          var graficoDiv = document.createElement('div');
          graficoDiv.className = 'col-sm-6';

          graficoContainer.appendChild(graficoDiv);

          // Configuración del gráfico
          var ctx = document.getElementById(idGrafico).getContext('2d');
          new Chart(ctx, {
              type: 'doughnut',
              data: {
                  labels: ['Por Alcanzar', 'Alcanzado'],
                  datasets: [{
                      data: [porAusentes, porAlcanzado],
                      backgroundColor: ['#FDCC45', '#235382']
                  }]
              },
              options: {
                  maintainAspectRatio: false,
                  responsive: true,
                  plugins: {
                      datalabels: {
                          color: '#fff',
                          anchor: 'end',
                          align: 'start',
                          offset: -10,
                          borderWidth: 2,
                          borderColor: '#fff',
                          borderRadius: 25,
                          backgroundColor: (context) => {
                              let backgroundColor = context.dataset.backgroundColor[context.dataIndex];
                              if (backgroundColor.startsWith('#')) {
                                  let hex = backgroundColor.replace('#', '');
                                  let r = parseInt(hex.substring(0, 2), 16);
                                  let g = parseInt(hex.substring(2, 4), 16);
                                  let b = parseInt(hex.substring(4, 6), 16);
                                  return `rgba(${r}, ${g}, ${b}, 0.5)`;
                              }
                              return backgroundColor;
                          },
                          font: {
                              weight: 'bold',
                              size: '16'
                          },
                          formatter: (value, ctx) => {
                              let sum = 0;
                              let dataArr = ctx.chart.data.datasets[0].data;
                              dataArr.map(data => {
                                  sum += data;
                              });
                              let percentage = (value * 100 / sum).toFixed(2) + "%";
                              return percentage;
                          }
                      }
                  }
              },
              plugins: [ChartDataLabels]
          });
      });
  });
</script>
              

<!-- ////// -->

<script>
  function normalizeString(str) {
    // Eliminar espacios en blanco al inicio y al final
    str = str.trim();

    // Eliminar acentos y caracteres especiales
    str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

    // Eliminar caracteres especiales y espacios en blanco
    str = str.replace(/[^a-zA-Z0-9]/g, "");
    
    return str;
}

document.addEventListener('DOMContentLoaded', function() {
  
    /////////////GRAFIGO RESUMEN GENERAL////////////
    var GraficoFinalReevaluacion = <?php echo json_encode($GraficoFinalReevaluacion); ?>;
    
    // NUEVA EVALUACION
    // Verificar que la variable tiene las propiedades necesarias
    if (GraficoFinalReevaluacion && GraficoFinalReevaluacion.porcentajeAusentes !== undefined && GraficoFinalReevaluacion.porcentajeLogradas !== undefined) {
        // Configuración del primer gráfico
        var ctxResumen = document.getElementById('resumenReevaluacion').getContext('2d');
        var data2 = {
            "Titulo": GraficoFinalReevaluacion.tituloGraficoResumen,
            "Por Alcanzar": GraficoFinalReevaluacion.porcentajeAusentes,
            "Alcanzado": GraficoFinalReevaluacion.porcentajeLogradas
        };

        // Configuración del segundo gráfico
        document.getElementById('chartTitle2').innerText = data2.Titulo;
        new Chart(ctxResumen, {
            type: 'doughnut',
            data: {
                labels: ['Por Alcanzar', 'Alcanzado'],
                datasets: [{
                    data: [data2['Por Alcanzar'], data2['Alcanzado']],
                    backgroundColor: ['#FDCC45', '#235382']
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#fff',
                        anchor: 'end',
                        align: 'start',
                        offset: -10,
                        borderWidth: 2,
                        borderColor: '#fff',
                        borderRadius: 25,
                        backgroundColor: (context) => {
                            let backgroundColor = context.dataset.backgroundColor[context.dataIndex];
                            if (backgroundColor.startsWith('#')) {
                                // Convert hex to rgba
                                let hex = backgroundColor.replace('#', '');
                                let r = parseInt(hex.substring(0, 2), 16);
                                let g = parseInt(hex.substring(2, 4), 16);
                                let b = parseInt(hex.substring(4, 6), 16);
                                return `rgba(${r}, ${g}, ${b}, 0.5)`; // 0.5 is the alpha value for 50% transparency
                            }
                            return backgroundColor;
                        },
                        font: {
                            weight: 'bold',
                            size: '16'
                        },
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value * 100 / sum).toFixed(2) + "%";
                            return percentage;
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    } else {
        console.error('GraficoFinalReevaluacion no tiene las propiedades necesarias.');
    }


    ////////////////////////////////////////////////////////////
    // Resumen de EVALUACION ACTUAL***********
    var resultadosPorArea = <?php echo json_encode($resultadosPorArea); ?>;

    // Mapeo de nombres de áreas a IDs de gráficos
    var areaToChartId = {
        'Lenguaje': 'EvaluacionReeeriorLenguaje',
        'Cognitivo': 'EvaReeCog',
        'SocioAfectivo': 'EvaReeSoc',
        'Psicomotor': 'EvaReePsi',
        'Autonomiaautodeterminacion': 'EvaReeAut',
        'Moral': 'EvaReeMor',
        'Sexual': 'EvaReeSex'
    };
    // Mapeo de nombres de áreas a IDs de gráficos con sus Titulos
        var labelToChartId = {
        'Lenguaje': 'chartTitleEvaLenRee',
        'Cognitivo': 'chartTitleEvaReeCog',
        'SocioAfectivo': 'chartTitleEvaReeSoc',
        'Psicomotor': 'chartTitleEvaReePsi',
        'Autonomiaautodeterminacion': 'chartTitleEvaReeAut',
        'Moral': 'chartTitleEvaReeMor',
        'Sexual': 'chartTitleEvaReeSex'
    };

    // Iterar sobre los resultados y configurar los gráficos
    Object.keys(resultadosPorArea).forEach(function(idArea) {
        var resultado = resultadosPorArea[idArea];
        var nombreArea = resultado.nombreArea;
        var nombreArea = normalizeString(resultado.nombreArea);
        var chartId = areaToChartId[nombreArea];
        var LabelId = labelToChartId[nombreArea];
        //alert(LabelId);

        if (chartId) {
            document.getElementById(LabelId).innerText = resultado.nombreArea;
            var ctx = document.getElementById(chartId).getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Por Alcanzar', 'Alcanzado'],
                    datasets: [{
                        data: [resultado.porcentajeAusentes, resultado.porcentajeLogradas],
                        backgroundColor: ['#FDCC45', '#235382']
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        datalabels: {
                            color: '#fff',
                            anchor: 'end',
                            align: 'start',
                            offset: -10,
                            borderWidth: 2,
                            borderColor: '#fff',
                            borderRadius: 25,
                            backgroundColor: (context) => {
                                let backgroundColor = context.dataset.backgroundColor[context.dataIndex];
                                if (backgroundColor.startsWith('#')) {
                                    // Convert hex to rgba
                                    let hex = backgroundColor.replace('#', '');
                                    let r = parseInt(hex.substring(0, 2), 16);
                                    let g = parseInt(hex.substring(2, 4), 16);
                                    let b = parseInt(hex.substring(4, 6), 16);
                                    return `rgba(${r}, ${g}, ${b}, 0.5)`; // 0.5 is the alpha value for 50% transparency
                                }
                                return backgroundColor;
                            },
                            font: {
                                weight: 'bold',
                                size: '16'
                            },
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                let percentage = (value * 100 / sum).toFixed(2) + "%";
                                return percentage;
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
        }
    });
});



</script>