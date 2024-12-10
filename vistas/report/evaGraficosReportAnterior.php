
    <!-- Detallle de la evlaucion  anterior-->

    <div class="col-sm-2"  style="margin-bottom: 10px;">
        <!-- este es un simple separador para centrar los graficos -->
            <h3>Anterior</h3>
        
    </div>

    <!-- LENGUAJE ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaLenAnt" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #00B9F1;"></label>
        <canvas id="EvaluacionAnteriorLenguaje" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>

    <!-- COGNITIVO ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntCog" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #00B9F1;"></label>
        <canvas id="EvaAntCog" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

    </div>
    <!-- SOCIOAFECTIVO ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntSoc" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #00B9F1;"></label>
        <canvas id="EvaAntSoc" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

    </div>
    <!-- PSICOMOTOR ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntPsi" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #00B9F1;"></label>
        <canvas id="EvaAntPsi" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

    </div>

    <!-- AUTONOMIA ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntAut" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #00B9F1;"></label>
        <canvas id="EvaAntAut" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

    </div>

    <!-- MORAL ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntMor" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #00B9F1;"></label>
        <canvas id="EvaAntMor" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

    </div>

    <!-- SEXUAL ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaAntSex" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #00B9F1;"></label>
        <canvas id="EvaAntSex" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        
    </div>

    <div class="col-sm-3"  style="margin-bottom: 10px;">
        <!-- este es un simple separador para centrar los graficos -->
            
        
    </div>


     


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Resumen de EVALUCION ANTERIOR Y EVALUACION ACTUAL-->

            //**************************************** */
            // EVALUACION ANTERIOR
            var data1 = {
                "Titulo": "FECHA DE EVALUACIÓN ANTERIOR: --",
                "Por Alcanzar": 50,
                "Alcanzado": 50
            };
           // Configuración del primer gráfico
            document.getElementById('chartTitle1').innerText = data1.Titulo;
            var ctx1 = document.getElementById('EvaluacionAnterior').getContext('2d');
            new Chart(ctx1, {
                type: 'doughnut',
                data: {
                    labels: ['Por Alcanzar', 'Alcanzado'],
                    datasets: [{
                        data: [data1['Por Alcanzar'], data1['Alcanzado']],
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
                               // return context.dataset.backgroundColor;
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

            //**************************************** */



            //**************************************** */
            // DETALLE EVALUACION  LENGUAJE ANTERIOR EvaluacionAnteriorLenguaje
            var dataLenguaje = {
                "Titulo": "Lenguaje",
                "Por Alcanzar": 12,
                "Alcanzado": 88
            };
            // Configuración del segundo gráfico
            document.getElementById('chartTitleEvaLenAnt').innerText = dataLenguaje.Titulo;
            var ctxEvaLenAnt = document.getElementById('EvaluacionAnteriorLenguaje').getContext('2d');
            new Chart(ctxEvaLenAnt, {
                type: 'doughnut',
                data: {
                    labels: ['Por Alcanzar', 'Alcanzado'],
                    datasets: [{
                        data: [dataLenguaje['Por Alcanzar'], dataLenguaje['Alcanzado']],
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

            //**************************************** */
            // DETALLE EVALUACION  COGNITICA ANTERIOR EvaluacionAnteriorLenguaje
            var dataCog = {
                "Titulo": "Cognitivo",
                "Por Alcanzar": 5,
                "Alcanzado": 95
            };
            // Configuración del segundo gráfico 
            document.getElementById('chartTitleEvaAntCog').innerText = dataCog.Titulo;
            var ctxEvaLenAnt = document.getElementById('EvaAntCog').getContext('2d');
            new Chart(ctxEvaLenAnt, {
                type: 'doughnut',
                data: {
                    labels: ['Por Alcanzar', 'Alcanzado'],
                    datasets: [{
                        data: [dataCog['Por Alcanzar'], dataCog['Alcanzado']],
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

            //**************************************** */
            // DETALLE EVALUACION  SOCIOAFECTIVA ANTERIOR EvaluacionAnteriorLenguaje
            var dataSoc = {
                "Titulo": "SocioAfectiva",
                "Por Alcanzar": 15,
                "Alcanzado": 85
            };
            // Configuración del segundo gráfico 
            document.getElementById('chartTitleEvaAntSoc').innerText = dataSoc.Titulo;
            var ctxEvaLenAnt = document.getElementById('EvaAntSoc').getContext('2d');
            new Chart(ctxEvaLenAnt, {
                type: 'doughnut',
                data: {
                    labels: ['Por Alcanzar', 'Alcanzado'],
                    datasets: [{
                        data: [dataSoc['Por Alcanzar'], dataSoc['Alcanzado']],
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

            //**************************************** */
            // DETALLE EVALUACION  PSICOMOTOR ANTERIOR EvaluacionAnteriorLenguaje
            var dataPsi = {
                "Titulo": "Psicomotor",
                "Por Alcanzar": 1,
                "Alcanzado": 99
            };
            // Configuración del segundo gráfico 
            document.getElementById('chartTitleEvaAntPsi').innerText = dataPsi.Titulo;
            var ctxEvaLenAnt = document.getElementById('EvaAntPsi').getContext('2d');
            new Chart(ctxEvaLenAnt, {
                type: 'doughnut',
                data: {
                    labels: ['Por Alcanzar', 'Alcanzado'],
                    datasets: [{
                        data: [dataPsi['Por Alcanzar'], dataPsi['Alcanzado']],
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

            //**************************************** */
            // DETALLE EVALUACION  Autonomia ANTERIOR EvaluacionAnteriorLenguaje
            var dataAut = {
                "Titulo": "Autonomia",
                "Por Alcanzar": 21,
                "Alcanzado": 79
            };
            // Configuración del segundo gráfico 
            document.getElementById('chartTitleEvaAntAut').innerText = dataAut.Titulo;
            var ctxEvaLenAnt = document.getElementById('EvaAntAut').getContext('2d');
            new Chart(ctxEvaLenAnt, {
                type: 'doughnut',
                data: {
                    labels: ['Por Alcanzar', 'Alcanzado'],
                    datasets: [{
                        data: [dataAut['Por Alcanzar'], dataAut['Alcanzado']],
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

            //**************************************** */
            // DETALLE EVALUACION  Moral ANTERIOR EvaluacionAnteriorLenguaje
            var dataMor = {
                "Titulo": "Moral",
                "Por Alcanzar": 31,
                "Alcanzado": 69
            };
            // Configuración del segundo gráfico 
            document.getElementById('chartTitleEvaAntMor').innerText = dataMor.Titulo;
            var ctxEvaLenAnt = document.getElementById('EvaAntMor').getContext('2d');
            new Chart(ctxEvaLenAnt, {
                type: 'doughnut',
                data: {
                    labels: ['Por Alcanzar', 'Alcanzado'],
                    datasets: [{
                        data: [dataMor['Por Alcanzar'], dataMor['Alcanzado']],
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

            //**************************************** */
            // DETALLE EVALUACION  Sexual ANTERIOR EvaluacionAnteriorLenguaje
            var dataSex = {
                "Titulo": "Sexual",
                "Por Alcanzar": 41,
                "Alcanzado": 59
            };
            // Configuración del segundo gráfico 
            document.getElementById('chartTitleEvaAntSex').innerText = dataSex.Titulo;
            var ctxEvaLenAnt = document.getElementById('EvaAntSex').getContext('2d');
            new Chart(ctxEvaLenAnt, {
                type: 'doughnut',
                data: {
                    labels: ['Por Alcanzar', 'Alcanzado'],
                    datasets: [{
                        data: [dataSex['Por Alcanzar'], dataSex['Alcanzado']],
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

        });
    </script>
