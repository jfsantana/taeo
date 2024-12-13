<!-- Detallle de la evlaucion  anterior-->
<?php
    $resultadosPorAreaAnterior = [];

    foreach ($arrayResumenEvaAnterior as $datoResumenAnterior) {
        $idAreaEvaluacion = $datoResumenAnterior['idAreaEvaluacion'];
        $nombreAreaEvaluacion = $datoResumenAnterior['nombreAreaEvaluacion'];
        $evaluacionDetalle = $datoResumenAnterior['evaluacion_detalle'];

        if (!isset($resultadosPorAreaAnterior[$idAreaEvaluacion])) {
            $resultadosPorAreaAnterior[$idAreaEvaluacion] = [
                'nombreArea' => $nombreAreaEvaluacion,
                'totalActividades' => 0,
                'totalLogradas' => 0,
                'totalApoyoParcialMasAusentes' => 0,
                'totalApoyoTotal' => 0,
                'totalAusentes' => 0
            ];
        }

        $resultadosPorAreaAnterior[$idAreaEvaluacion]['totalActividades']++;

        switch ($evaluacionDetalle) {
            case 'SA':
                $resultadosPorAreaAnterior[$idAreaEvaluacion]['totalLogradas']++;
                break;
            case 'AP':
                $resultadosPorAreaAnterior[$idAreaEvaluacion]['totalApoyoParcialMasAusentes']++;
                $resultadosPorAreaAnterior[$idAreaEvaluacion]['totalAusentes']++;
                break;
            case 'AT':
                $resultadosPorAreaAnterior[$idAreaEvaluacion]['totalApoyoTotal']++;
                $resultadosPorAreaAnterior[$idAreaEvaluacion]['totalAusentes']++;
                break;
        }
    }

    // Calcular porcentajes
    foreach ($resultadosPorAreaAnterior as $idArea => $resultados) {
        $totalActividades = $resultados['totalActividades'];
        $totalLogradas = $resultados['totalLogradas'];
        $totalAusentes = $resultados['totalAusentes'];

        $resultadosPorAreaAnterior[$idArea]['porcentajeLogradas'] = ($totalLogradas / $totalActividades) * 100;
        $resultadosPorAreaAnterior[$idArea]['porcentajeAusentes'] = ($totalAusentes / $totalActividades) * 100;
    }

    $totalActividades = 0;
    $totalLogradas = 0;
    $totalApoyoParcialMasAusentes = 0;
    $totalApoyoTotal = 0;
    $totalAusentes = 0;

    foreach ($resultadosPorAreaAnterior as $resultados) {
        $totalActividades += $resultados['totalActividades'];
        $totalLogradas += $resultados['totalLogradas'];
        $totalApoyoParcialMasAusentes += $resultados['totalApoyoParcialMasAusentes'];
        $totalApoyoTotal += $resultados['totalApoyoTotal'];
        $totalAusentes += $resultados['totalAusentes'];
    }
 
    if(@$totalActividades){
        $porcentajeLogradas = ($totalLogradas / $totalActividades) * 100;
        $porcentajeAusentes = ($totalAusentes / $totalActividades) * 100;
    }
    
    //solo aplica para el resumenarrayResumenEvaAnterior
    if(@$arrayHeaderAnterior[0]['fechaEvaluacion']){
        $GraficoFinalReevaluacionAnterior = [
            'tituloGraficoResumen' => 'FECHA DE EVALUACION ANTERIOR: '.$arrayHeaderAnterior[0]['fechaEvaluacion'],
            'totalActividades' => $totalActividades,
            'totalLogradas' => $totalLogradas,
            'totalApoyoParcialMasAusentes' => $totalApoyoParcialMasAusentes,
            'totalApoyoTotal' => $totalApoyoTotal,
            'totalAusentes' => $totalAusentes,
            'porcentajeLogradas' => $porcentajeLogradas,
            'porcentajeAusentes' => $porcentajeAusentes
        ];
    }
    
?>

    <div class="col-sm-2"  style="margin-bottom: 10px;">
        <!-- este es un simple separador para centrar los graficos -->
            <h3>Anterior</h3>
        
    </div>

    <!-- LENGUAJE ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaLenAnt" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaAntleng"  style='max-width: 100%; height: 130px'></div>
    </div>

    <!-- COGNITIVO ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntCog" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaAntCog"  style='max-width: 100%; height: 130px'></div>

    </div>
    <!-- SOCIOAFECTIVO ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntSoc" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaAntSoc"  style='max-width: 100%; height: 130px'></div>

    </div>
    <!-- PSICOMOTOR ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntPsi" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaAntPsi"  style='max-width: 100%; height: 130px'></div>

    </div>

    <!-- AUTONOMIA ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntAut" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaAntAut"  style='max-width: 100%; height: 130px'></div>

    </div>

    <!-- MORAL ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntMor" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaAntMor"  style='max-width: 100%; height: 130px'></div>

    </div>

    <!-- SEXUAL ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntSex" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaAntSex"  style='max-width: 100%;  height: 130px'></div>
        
    </div>

    <div class="col-sm-3"  style="margin-bottom: 10px;">
        <!-- este es un simple separador para centrar los graficos -->
            
        
    </div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    let inputCount = 0;

    function normalizeString(str) {
        // Eliminar espacios en blanco al inicio y al final
        str = str.trim();

        // Eliminar acentos y caracteres especiales
        str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

        // Eliminar caracteres especiales y espacios en blanco
        str = str.replace(/[^a-zA-Z0-9]/g, "");
        
        return str;
    }



    // Ejemplo de cómo asignar valores dinámicamente
    function setInputValues(values, nombreVariable) {
        const container = document.getElementById('dynamicInputs');
        values.forEach((value, index) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = nombreVariable + '[]';
            input.id = nombreVariable + (container.children.length + 1); // Asegura IDs únicos
            input.value = value;
            container.appendChild(input);
        });
    }

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawCharts);
    
    //GRAFICO RESUMEN EVALUACION ANTERIOR
    function drawCharts() {
        var GraficoFinalReevaluacionAnterior = <?php echo json_encode($GraficoFinalReevaluacionAnterior); ?>;
        var graficoText='';   
        
        if (GraficoFinalReevaluacionAnterior && GraficoFinalReevaluacionAnterior.porcentajeAusentes !== undefined && GraficoFinalReevaluacionAnterior.porcentajeLogradas !== undefined) {
            var data = google.visualization.arrayToDataTable([
                ['Estado', 'Porcentaje'],
                ['Por-Alcanzar', GraficoFinalReevaluacionAnterior.porcentajeAusentes], //pOR aLCANZAR
                ['Alcanzado', GraficoFinalReevaluacionAnterior.porcentajeLogradas]  //ALCANZADO
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
            
            document.getElementById('evaluacionAnteriorLabel').innerText = GraficoFinalReevaluacionAnterior.tituloGraficoResumen;

            var chart = new google.visualization.PieChart(document.getElementById('EvaluacionAnteriorGrafico'));

            google.visualization.events.addListener(chart, 'ready', function () {
                chart.innerHTML = chart.getImageURI() ;
                console.log(chart.innerHTML);
                setInputValues([chart.innerHTML],'graficoAnt');
            });

            chart.draw(data, options);
        } else {
            console.error('Grafico Anterior no tiene las propiedades necesarias.');
        }

        var areaToChartId = {
            'Lenguaje': 'EvaAntleng',
            'Cognitivo': 'EvaAntCog',
            'SocioAfectivo': 'EvaAntSoc',
            'Psicomotor': 'EvaAntPsi',
            'Autonomiaautodeterminacion': 'EvaAntAut',
            'Moral': 'EvaAntMor',
            'Sexual': 'EvaAntSex'
        };
        var labelToChartId = {
            'Lenguaje': 'chartTitleEvaLenAnt',
            'Cognitivo': 'chartTitleEvaAntCog',
            'SocioAfectivo': 'chartTitleEvaAntSoc',
            'Psicomotor': 'chartTitleEvaAntPsi',
            'Autonomiaautodeterminacion': 'chartTitleEvaAntAut',
            'Moral': 'chartTitleEvaAntMor',
            'Sexual': 'chartTitleEvaAntSex'
        };

        //GRAFICOS EVALUACION ANTERIOR RESUMEN POR AREA 
        var GraficoFinalReevaluacionAnteriorDetalle = <?php echo json_encode($resultadosPorAreaAnterior); ?>;
        Object.keys(GraficoFinalReevaluacionAnteriorDetalle).forEach(function(idArea) {
            var resultado = GraficoFinalReevaluacionAnteriorDetalle[idArea];
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
                        position: 'top' // Coloca la leyenda en la parte superior
                       
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
</script>