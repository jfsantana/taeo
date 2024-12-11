
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
        <canvas id="EvaAntleng" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>

    <!-- COGNITIVO ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntCog" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <canvas id="EvaAntCog" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

    </div>
    <!-- SOCIOAFECTIVO ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntSoc" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <canvas id="EvaAntSoc" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

    </div>
    <!-- PSICOMOTOR ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntPsi" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <canvas id="EvaAntPsi" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

    </div>

    <!-- AUTONOMIA ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntAut" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <canvas id="EvaAntAut" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

    </div>

    <!-- MORAL ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntMor" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <canvas id="EvaAntMor" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

    </div>

    <!-- SEXUAL ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntSex" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <canvas id="EvaAntSex" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        
    </div>

    <div class="col-sm-3"  style="margin-bottom: 10px;">
        <!-- este es un simple separador para centrar los graficos -->
            
        
    </div>


     

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
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
    var GraficoFinalReevaluacionAnterior = <?php echo json_encode($GraficoFinalReevaluacionAnterior); ?>;
        
    // Verificar que la variable tiene las propiedades necesarias
    if (GraficoFinalReevaluacionAnterior && GraficoFinalReevaluacionAnterior.porcentajeAusentes !== undefined && GraficoFinalReevaluacionAnterior.porcentajeLogradas !== undefined) {
        // Configuración del primer gráfico
        var ctxResumen = document.getElementById('EvaluacionAnteriorGrafico').getContext('2d');
        var data2 = {
            "Titulo": GraficoFinalReevaluacionAnterior.tituloGraficoResumen,
            "Por Alcanzar": GraficoFinalReevaluacionAnterior.porcentajeAusentes,
            "Alcanzado": GraficoFinalReevaluacionAnterior.porcentajeLogradas
        };

        // Configuración del segundo gráfico
        document.getElementById('evaluacionAnteriorLabel').innerText = data2.Titulo;
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
        console.error('Grafico Anterior no tiene las propiedades necesarias.');
    }

/////////////////////////////////////

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


    

    var GraficoFinalReevaluacionAnteriorDetalle = <?php echo json_encode($resultadosPorAreaAnterior); ?>;
    Object.keys(GraficoFinalReevaluacionAnteriorDetalle).forEach(function(idArea) {
        var resultado = GraficoFinalReevaluacionAnteriorDetalle[idArea];
        var nombreArea = resultado.nombreArea;
        var nombreArea = normalizeString(resultado.nombreArea);
        var chartId = areaToChartId[nombreArea];
        var LabelId = labelToChartId[nombreArea];
        //console.log(LabelId);
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
