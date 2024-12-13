<div id="graficoContainer" class="row">
  <div class="col-sm-12">
    <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-2" style="font-size: 1rem; background-color: #235382;">ESCALA DE ESTIMACIÓN EVOLUTIVA TAEO 8.0 (E.E.E)</label>
  </div>
  <?php 

  


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

                            echo "<tr ><td colspan='$numAreas'><strong>Edad Cronologica: " . $edad . "</strong></td></tr>";
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

                            // Necesito agregar el $arrayResumenGrafico al array principal $arrayResumenGraficoAll
                            $arrayResumenGraficoAll[] = $arrayResumenGrafico;

                            $grafico = "<div class='col-sm-12'>
                                          <label id='$tituloGraficoResumen' class='d-block text-center text-white py-1' style='font-size: 1rem; background-color: #00B9F1;'>$tituloGraficoResumen</label>
                                          <div id='$idGraficoResumen' style='max-width: 100%; '></div>
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
        'tituloGraficoResumen' => "FECHA DE REEVALUACIÓN: $fechaEvaluacion",
        'totalActividades' => $totalActividades,
        'totalLogradas' => $totalLogradas,
        'totalApoyoParcialMasAusentes' => $totalApoyoParcialMasAusentes,
        'totalApoyoTotal' => $totalApoyoTotal,
        'totalAusentes' => $totalAusentes,
        'porcentajeLogradas' => $porcentajeLogradas,
        'porcentajeAusentes' => $porcentajeAusentes
    ];

        // echo '<pre>';
        // print_r($GraficoFinalReevaluacion);
        // echo '</pre>';

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>



  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawCharts);

  // Ejemplo de cómo asignar valores dinámicamente
  function setInputValues(values, nombreVariable) {
    const container = document.getElementById('dynamicInputs');
    values.forEach((value, index) => {
        const input = document.createElement('input');
        input.type = 'text';
        input.name = nombreVariable + '[]';
        input.id = nombreVariable + (container.children.length + 1); // Asegura IDs únicos
        input.value = value;
        container.appendChild(input);
    });
  }
  
  function drawCharts() {
    var GraficoFinalReevaluacion = <?php echo json_encode($GraficoFinalReevaluacion); ?>;

        // Verificar que la variable tiene las propiedades necesarias
        if (GraficoFinalReevaluacion && GraficoFinalReevaluacion.porcentajeAusentes !== undefined && GraficoFinalReevaluacion.porcentajeLogradas !== undefined) {
            // Configuración del primer gráfico
            var data = google.visualization.arrayToDataTable([
                ['Estado', 'Porcentaje'],
                ['Por-Alcanzar', GraficoFinalReevaluacion.porcentajeAusentes],
                ['Alcanzado', GraficoFinalReevaluacion.porcentajeLogradas]
            ]);

            var options = {
              colors: ['#FDCC45', '#235382'], // Colores personalizados
              backgroundColor: 'transparent', // Fondo transparente
              legend: {
                position: 'top', // Coloca la leyenda en la parte superior
                maxLines: 2, // Asegura que los elementos de la leyenda se apilen verticalmente
                textStyle: { fontSize: 10 } // Ajusta el tamaño del texto de la leyenda
              },
              chartArea: {
                width: '80%', // Ajusta el área del gráfico dejando espacio para la leyenda
                height: '70%'
              }
            };

            document.getElementById('chartTitle2').innerText = GraficoFinalReevaluacion.tituloGraficoResumen;

            var chart = new google.visualization.PieChart(document.getElementById('resumenReevaluacion'));
            google.visualization.events.addListener(chart, 'ready', function () {
                chart.innerHTML = chart.getImageURI() ;
                console.log(chart.innerHTML);
                setInputValues([chart.innerHTML],'graficoNew');
            });

            
            chart.draw(data, options);
        } else {
            console.error('Grafico Actual no tiene las propiedades necesarias.');
        }



    // Suponiendo que $arrayResumenGraficoAll se convierte a JSON y se pasa a JavaScript
    var arrayResumenGraficoAll = <?php echo json_encode($arrayResumenGraficoAll); ?>;
    
    arrayResumenGraficoAll.forEach(function(graficoData) {
      var titulo = graficoData.tituloGraficoResumen;
      var idGrafico = graficoData.idGraficoResumen;
      var porAlcanzado = graficoData.porAlcanzado;
      var porAusentes = graficoData.porAusentes;

      var data = google.visualization.arrayToDataTable([
        ['Estado', 'Porcentaje'],
        ['P-A', porAusentes],
        ['A', porAlcanzado]
      ]);

      var options = {
                    colors: ['#FDCC45', '#235382'], // Colores personalizados
                    backgroundColor: 'transparent', // Fondo transparente
                    legend: {
                        position: 'top', // Coloca la leyenda en la parte superior
                        maxLines: 2, // Asegura que los elementos de la leyenda se apilen verticalmente
                        textStyle: { fontSize: 10 } // Ajusta el tamaño del texto de la leyenda
                    },
                    chartArea: {
                        width: '100%', // Ajusta el área del gráfico dejando espacio para la leyenda
                        
                    },
                    annotations: {
                        alwaysOutside: true, // Asegura que las anotaciones (montos) siempre se muestren
                        textStyle: {
                            fontSize: 12,
                            auraColor: 'none',
                            color: '#555'
                        }
                    },
                    enableInteractivity: true, // Asegura que la leyenda siempre se muestre
                    pieSliceText: 'value', // Muestra los valores en las porciones del gráfico
                    pieSliceTextStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                };

      var chart = new google.visualization.PieChart(document.getElementById(idGrafico));
      google.visualization.events.addListener(chart, 'ready', function () {
                chart.innerHTML = chart.getImageURI() ;
                console.log(chart.innerHTML);
                setInputValues([chart.innerHTML],idGrafico);
            });
      chart.draw(data, options);
    });

    // Resumen de EVALUACION ACTUAL
    var resultadosPorArea = <?php echo json_encode($resultadosPorArea); ?>;

    var areaToChartId = {
      'Lenguaje': 'EvaluacionReeeriorLenguaje',
      'Cognitivo': 'EvaReeCog',
      'SocioAfectivo': 'EvaReeSoc',
      'Psicomotor': 'EvaReePsi',
      'Autonomiaautodeterminacion': 'EvaReeAut',
      'Moral': 'EvaReeMor',
      'Sexual': 'EvaReeSex'
    };

    var labelToChartId = {
      'Lenguaje': 'chartTitleEvaLenRee',
      'Cognitivo': 'chartTitleEvaReeCog',
      'SocioAfectivo': 'chartTitleEvaReeSoc',
      'Psicomotor': 'chartTitleEvaReePsi',
      'Autonomiaautodeterminacion': 'chartTitleEvaReeAut',
      'Moral': 'chartTitleEvaReeMor',
      'Sexual': 'chartTitleEvaReeSex' 
    };

    Object.keys(resultadosPorArea).forEach(function(idArea) {
      var resultado = resultadosPorArea[idArea];
      var nombreArea = normalizeString(resultado.nombreArea);
      var chartId = areaToChartId[nombreArea];
      var LabelId = labelToChartId[nombreArea];

      if (chartId) {
        document.getElementById(LabelId).innerText = resultado.nombreArea;

        var data = google.visualization.arrayToDataTable([
          ['Estado', 'Porcentaje'],
          ['P-A', resultado.porcentajeAusentes],
          ['A', resultado.porcentajeLogradas]
        ]);

        var options = {
                    colors: ['#FDCC45', '#235382'], // Colores personalizados
                    backgroundColor: 'transparent', // Fondo transparente
                    legend: {
                        position: 'top', // Coloca la leyenda en la parte superior
                        maxLines: 2, // Asegura que los elementos de la leyenda se apilen verticalmente
                        textStyle: { fontSize: 10 } // Ajusta el tamaño del texto de la leyenda
                    },
                    chartArea: {
                        width: '100%', // Ajusta el área del gráfico dejando espacio para la leyenda
                        //height: '20%' // Reduce el área del gráfico
                    },
                    annotations: {
                        alwaysOutside: true, // Asegura que las anotaciones (montos) siempre se muestren
                        textStyle: {
                            fontSize: 12,
                            auraColor: 'none',
                            color: '#555'
                        }
                    },
                    enableInteractivity: true, // Asegura que la leyenda siempre se muestre
                    pieSliceText: 'value', // Muestra los valores en las porciones del gráfico
                    pieSliceTextStyle: {
                        fontSize: 12,
                        color: '#000'
                    }
                };

        var chart = new google.visualization.PieChart(document.getElementById(chartId));
        google.visualization.events.addListener(chart, 'ready', function () {
                    chart.innerHTML = chart.getImageURI();
                    console.log(chart.innerHTML);
                    setInputValues([chart.innerHTML], chartId);
                });

        chart.draw(data, options);
      }
    });
  }

  function normalizeString(str) {
    str = str.trim();
    str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    str = str.replace(/[^a-zA-Z0-9]/g, "");
    return str;
  }

   // Suponiendo que GraficoFinalReevaluacion ya está definido y contiene los datos necesarios
        var GraficoFinalReevaluacion = {
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
                datasets: [{
                    label: 'Reevaluación',
                    data: [12, 19, 3, 5, 2],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Función para renderizar el gráfico
        function renderGraficoFinalReevaluacion() {
            var ctx = document.getElementById('resumenReevaluacion').getContext('2d');
            new Chart(ctx, {
                type: 'bar', // Tipo de gráfico, ajusta según sea necesario
                data: GraficoFinalReevaluacion.data,
                options: GraficoFinalReevaluacion.options
            });
        }

        // Llamar a la función para renderizar el gráfico
        renderGraficoFinalReevaluacion();
</script>