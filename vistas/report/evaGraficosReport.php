<!-- aqui inicia los graficos por edad del aprendiz -->

    <!-- Titulo EDAD PERIODO DE ABORDAJE-->

    <div class="col-sm-12" style="margin-bottom: 10px;">
        <div class="d-flex justify-content-between" style="background-color: #00B9F1; ">
            <div>
                <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-1" style="font-size: 0.8rem; background-color: #00B9F1;">
                    <strong>Edad: 5</strong>
                </label>
            </div>
            <div>
                <label for="periodoAbordaje" class="d-block text-center text-white py-1" style="font-size: 0.8rem; background-color: #00B9F1;">
                    <strong>Periodo de Abordaje: 2021-2022</strong>
                </label>
            </div>
        </div>
    </div>
    
    <!-- GRAFICO RESUMEN EVALUACION ANTERIOR -->
    <div class="col-sm-5">
        <label id="chartTitle1" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #00B9F1;"></label>
        <canvas id="EvaluacionAnterior" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        <div style="display: flex; justify-content: center;">
            <table style="width: 70%; text-align: center;">
                <tr style="background-color: #235382; color: white;">
                    <td >PROMEDIO TOTAL DE DESARROLLO</td>
                    <td >36%</td>
                </tr>
                <TR><td colspan="2">&nbsp;</td></TR>
            </table>
        </div>
    </div>
    <!-- GRAFICO RESUMEN EVALUACION NUEVA-->
    <div class="col-sm-5">
        <label id="chartTitle2" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #00B9F1;"></label>
        <canvas id="resumenReevaluacion" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        <div style="display: flex; justify-content: center;">
            <table style="width: 70%; text-align: center;">
                <tr style="background-color: #235382; color: white;">
                    <td >PROMEDIO TOTAL DE DESARROLLO</td>
                    <td >36%</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-2">
        <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-1" style="font-size: 0.8rem; background-color: #00B9F1;"><strong>RESULTADOS</strong></label>
        <div style="display: flex; justify-content: center;">
            <table style="width: 70%; text-align: center;">
                <tr>
                    <td style="background-color: #FDCC45;">VARIACIÓN DEL 40 %</td>
                </tr>
                <tr>
                    <td style="background-color: #235382; color: white;">Promedio alcanzado: 4 %</td>
                </tr>
                <tr>
                    <td>Por alcanzar: 60 %</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Detallle de la evlaucion  anterior-->
    <?php include("evaGraficosReportAnterior.php"); ?>
    <?php include("evaGraficosReportNueva.php"); ?>