
    <!-- Detallle de la evlaucion  anterior-->

    <div class="col-sm-2"  style="margin-bottom: 10px;">
        <!-- este es un simple separador para centrar los graficos -->
            <h3>Reevaluacion</h3>
    </div>
    
    <?php 
        
        function getPorcentaje($resultados, $nombreArea) {
            foreach ($resultados as $resultado) {
                $areaResultado = preg_replace('/[^a-zA-Z0-9]/', '', mb_strtolower($resultado['nombreArea']));
                $areaNombre = preg_replace('/[^a-zA-Z0-9]/', '', mb_strtolower($nombreArea));
                if ($areaResultado == $areaNombre) {
                    return $resultado['totalApoyoTotal'];
                }
            }
            return 0;
        }
    ?>
    <!-- LENGUAJE ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaLenRee" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaluacionReeeriorLenguaje" ></div>
        <div style="display: flex; justify-content: center;">
            <table style="width: 70%; text-align: center;">
                <tr style="background-color: #235382; color: white;">
                    <td >PROMEDIO TOTAL DE DESARROLLO <br>  <?php echo getPorcentaje($resultadosPorAreaAnterior, 'Lenguaje'); ?>%</td>
                
                </tr>
                <TR><td colspan="2">&nbsp;</td></TR>
            </table>
        </div>
    </div>

    <!-- COGNITIVO ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaReeCog" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaReeCog" ></div>
        <div style="display: flex; justify-content: center;">
            <table style="width: 70%; text-align: center;">
                <tr style="background-color: #235382; color: white;">
                    <td >PROMEDIO TOTAL DE DESARROLLO <br>  <?php echo getPorcentaje($resultadosPorAreaAnterior, 'Cognitivo'); ?>%</td>
                </tr>
                <TR><td colspan="2">&nbsp;</td></TR>
            </table>
        </div>
    </div>
    <!-- SOCIOAFECTIVO ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaReeSoc" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaReeSoc" ></div>
        <div style="display: flex; justify-content: center;">
            <table style="width: 70%; text-align: center;">
                <tr style="background-color: #235382; color: white;">
                    <td >PROMEDIO TOTAL DE DESARROLLO <br>  <?php echo getPorcentaje($resultadosPorAreaAnterior, 'Socioafectivo'); ?>%</td>
                </tr>
                <TR><td colspan="2">&nbsp;</td></TR>
            </table>
        </div>
    </div>
    <!-- PSICOMOTOR ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaReePsi" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaReePsi" ></div>
        <div style="display: flex; justify-content: center;">
            <table style="width: 70%; text-align: center;">
                <tr style="background-color: #235382; color: white;">
                    <td >PROMEDIO TOTAL DE DESARROLLO <br>  <?php echo getPorcentaje($resultadosPorAreaAnterior, 'Psicomotor'); ?>%</td>
                </tr>
                <TR><td colspan="2">&nbsp;</td></TR>
            </table>
        </div>
    </div>

    <!-- AUTONOMIA ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaReeAut" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaReeAut" ></div>
        <div style="display: flex; justify-content: center;">
            <table style="width: 70%; text-align: center;">
                <tr style="background-color: #235382; color: white;">
                    <td >PROMEDIO TOTAL DE DESARROLLO <br> <?php echo getPorcentaje($resultadosPorAreaAnterior, 'Autonomía/ autodeterminación'); ?>%</td>
                </tr>
                <TR><td colspan="2">&nbsp;</td></TR>
            </table>
        </div> 
    </div>

    <!-- MORAL ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaReeMor" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaReeMor" ></div>
        <div style="display: flex; justify-content: center;">
            <table style="width: 70%; text-align: center;">
                <tr style="background-color: #235382; color: white;">
                    <td >PROMEDIO TOTAL DE DESARROLLO  <br> <?php echo getPorcentaje($resultadosPorAreaAnterior, 'Moral'); ?>%</td>
                </tr>
                <TR><td colspan="2">&nbsp;</td></TR>
            </table>
        </div>
    </div>

    <!-- SEXUAL ANTERIOR -->
    <div class="col-sm-1"  style="margin-bottom: 10px;">
        <label id="chartTitleEvaReeSex" class="d-block text-center text-white py-1" style="font-size: 1rem; background-color: #2570a1;"></label>
        <div id="EvaReeSex" ></div>
        <div style="display: flex; justify-content: center;">
            <table style="width: 70%; text-align: center;">
                <tr style="background-color: #235382; color: white;">
                    <td >PROMEDIO TOTAL DE DESARROLLO <br> <?php echo getPorcentaje($resultadosPorAreaAnterior, 'Sexual'); ?>%</td>
                </tr>
                <TR><td colspan="2">&nbsp;</td></TR>
            </table>
        </div>
    </div>

    <div class="col-sm-3"  style="margin-bottom: 10px;">
        <!-- este es un simple separador para centrar los graficos -->
            
        
    </div>

     


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

