<style>
        .header-right {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 9px;
            text-align: right;
        }
        .header-center {
            text-align: center;
            text-transform: uppercase;
            margin-top: 50px;
        }
    </style>

 <div class="header-right">
        PROGRAMA DE ACTIVACIÓN COGNITIVA (P.A.C)<br>
        VERSIÓN 5.0 08/17<br>
        MAYLUC MARTÍNEZ-TAEHO<br>
        LCDA. EDUCACIÓN ESPECIAL - MSc. LECTURA Y ESCRITURA
    </div>
    <div class="header-center">
        <?php echo "PROGRAMA DE :". @$nombreAuxArea;?>
    </div>
    <br>
    <?php echo "Nombre Aprendiz:". @$nombreAuxAprendiz;?>
    <br>
    <?php echo "Nombre Facilitador".@$nombreAuxMediador;?>
    <br>
    <div class="header-center">
        <?php echo "-------"?>
        </div>


<div id="printableArea2">
    <style>
        table.table-hover td {
            padding: 0 !important;
            margin: 0 !important;
            line-height: 1 !important;
        }

        @media print {
            table.table-hover td {
                padding: 0 !important;
                margin: 0 !important;
                line-height: 1 !important;
            }



            .table-hover td:nth-child(4),
            .table-hover td:nth-child(5),
            .table-hover td:nth-child(6) {
                background-color: rgb(138, 134, 134) !important;
            }

            .table-hover td:nth-child(7),
            .table-hover td:nth-child(8),
            .table-hover td:nth-child(9) {
                background-color: #cccccc !important;
            }
        }
    </style>

    <table class="">
        <tbody>
            <?php
            function hijosPrint($idPlanificacionHeader, $jerarquia, $token) {
                $URL = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/planning?type=6&idPlanificacionHeader=$idPlanificacionHeader&jerarquia=$jerarquia";
                $rs = API::GET($URL, $token);
                $arrayhijos = API::JSON_TO_ARRAY($rs);
                $banderaNodoPadre = false;
                return $arrayhijos;
            }

            function nivel4Print($nodoPadre, $level, $token, $idObjetivoHeader) {
                $arrayhijosNexLevel = hijosPrint($nodoPadre['idPlanificacionHeader'], $nodoPadre['jerarquia'], $token);
                if (count($arrayhijosNexLevel) > 0) { ?>
                    <tr class="expandable-body">
                        <td>
                            <div class="p-0">
                                <table class="table table-hover">
                                    <tbody>
                                        <?php
                                        foreach ($arrayhijosNexLevel as $datosArrayhijosNexLevel) { ?>
                                            <tr  >
                                                <td>
                                                    <div class="p-0">
                                                        <table class="table table-hover">
                                                            <tbody>
                                                                <?php
                                                                $arrayhijosN1 = hijosPrint($nodoPadre['idPlanificacionHeader'], $datosArrayhijosNexLevel['jerarquia'], $token);
                                                                $variable = $datosArrayhijosNexLevel['idItems'] . '-' . @$idObjetivoHeader;

                                                                if (count($arrayhijosN1) < 1) { ?>
                                                                    <tr  >
                                                                        <td width="325">
                                                                            <?php 
                                                                            $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                                            echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'];
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <table class="table table-hover">
                                                                                <tr>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #cccccc;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #cccccc;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; background-color: #cccccc;">&nbsp;</td>
                                                                                </tr>
                                                                            </table>
                                                                        </td> 
                                                                    </tr>
                                                                <?php } else { ?>
                                                                    <tr  >
                                                                        <td>
                                                                            
                                                                            <?php 
                                                                            $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                                            echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'];
                                                                            ?>
                                                                        </td>
                                                                        <td></td> 
                                                                    </tr>
                                                                    <!-- Código para el siguiente nivelPrint -->
                                                                    <?php
                                                                    // Aquí puedes agregar el código para los niveles adicionales
                                                                    ?>
                                                                    <!-- Fin del código para el siguiente nivelPrint -->
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                <?php }
            }

            function nivelPrint($nodoPadre, $level, $token, $idObjetivoHeader) {
                $arrayhijosNexLevel = hijosPrint($nodoPadre['idPlanificacionHeader'], $nodoPadre['jerarquia'], $token);
                if (count($arrayhijosNexLevel) > 0) { ?>
                    <tr class="expandable-body">
                        <td>
                            <div class="p-0">
                                <table class="table table-hover">
                                    <tbody>
                                        <?php
                                        foreach ($arrayhijosNexLevel as $datosArrayhijosNexLevel) { ?>
                                            <tr  >
                                                <td>
                                                    <div class="p-0">
                                                        
                                                        <table class="table table-hover">
                                                            <tbody>
                                                                <?php
                                                                $arrayhijosN1 = hijosPrint($nodoPadre['idPlanificacionHeader'], $datosArrayhijosNexLevel['jerarquia'], $token);
                                                                $variable = $datosArrayhijosNexLevel['idItems'] . '-' . @$idObjetivoHeader;

                                                                if (count($arrayhijosN1) < 1) { ?>
                                                                    <tr  >
                                                                    <td width="325">
                                                                            <?php 
                                                                            $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                                            echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'];
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <table class="table table-hover">
                                                                                <tr>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #cccccc;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #cccccc;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; background-color: #cccccc;">&nbsp;</td>
                                                                                </tr>
                                                                            </table>
                                                                        </td> 
                                                                    </tr>
                                                                <?php } else { ?>
                                                                    <tr  >
                                                                        <td>
                                                                            
                                                                            <?php 
                                                                            $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                                            echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'];
                                                                            ?>
                                                                        </td>
                                                                            <td></td> 
                                                                    </tr>
                                                                    <!-- Código para el siguiente nivelPrint -->
                                                                    <?php
                                                                    // Aquí puedes agregar el código para los niveles adicionales
                                                                    ?>
                                                                    <!-- Fin del código para el siguiente nivelPrint -->
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                <?php }
            }

            // Busca todos los nodos padres registrados en la planificación
            $URL = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/planning?type=5&idPlanificacionHeader=$idObjetivoHeader";
            $rs = API::GET($URL, $token);
            $arrayNodoPadre = API::JSON_TO_ARRAY($rs);
            $banderaNodoPadre = false;

            // Recorre los padres uno a uno
            foreach ($arrayNodoPadre as $datosNodoPadre) {
                $arrayhijos = hijosPrint($datosNodoPadre['idPlanificacionHeader'], $datosNodoPadre['jerarquia'], $token);

                // Imprime el primer nodo padre
                echo '<tr  ><td>';
                $variable = $datosNodoPadre['idItems'] . '-' . @$idObjetivoHeader;

                echo ' ' . $datosNodoPadre['descripcion'] . '</td></tr>';

                if (count($arrayhijos) > 0) { ?>
                    <tr class="expandable-body">
                        <td>
                            <div class="p-0">
                                <table class="table table-hover">
                                    <tbody>
                                        <?php
                                        foreach ($arrayhijos as $datosArrayhijos) { ?>
                                            <tr  >
                                                <td>
                                                    <div class="p-0">
                                                        <table class="table table-hover">
                                                            <tbody>
                                                                <?php
                                                                $arrayhijosN1 = hijosPrint($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijos['jerarquia'], $token);
                                                                $variable = $datosArrayhijos['idItems'] . '-' . @$idObjetivoHeader;

                                                                if (count($arrayhijosN1) < 1) { ?>
                                                                    <tr  >
                                                                        <td Width="380">
                                                                            <?php 
                                                                            $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijos['jerarquia']);
                                                                            echo ' ' . $jerarquia . ' - ' . $datosArrayhijos['descripcion'];
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <table class="table table-hover">
                                                                                <tr>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #cccccc;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; border-right: 2px solid black; background-color: #cccccc;">&nbsp;</td>
                                                                                    <td style="border: 1px solid black; background-color: #cccccc;">&nbsp;</td>
                                                                                </tr>
                                                                            </table>
                                                                        </td> 
                                                                    </tr>
                                                                <?php } else { ?>
                                                                    <tr  >
                                                                        <td>
                                                                            
                                                                            <?php 
                                                                            $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijos['jerarquia']);
                                                                            echo ' ' . $jerarquia . ' - ' . $datosArrayhijos['descripcion'];
                                                                            ?>
                                                                        </td>
                                                                        <td></td> 
                                                                    </tr>
                                                                    <?php
                                                                    $arrayhijosN2 = hijosPrint($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijos['jerarquia'], $token);
                                                                    if (count($arrayhijosN2) > 0) { ?>
                                                                        <tr class="expandable-body">
                                                                            <td>
                                                                                <div class="p-0">
                                                                                    <table class="table table-hover">
                                                                                        <tbody>
                                                                                            <?php
                                                                                            foreach ($arrayhijosN2 as $datosArrayhijosN3) { ?>
                                                                                                <tr  >
                                                                                                    <td>
                                                                                                        <div class="p-0">
                                                                                                            <table class="table table-hover">
                                                                                                                <tbody>
                                                                                                                    <?php
                                                                                                                    $arrayhijosN2 = hijosPrint($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosN3['jerarquia'], $token);
                                                                                                                    $variable = $datosArrayhijosN3['idItems'] . '-' . @$idObjetivoHeader;

                                                                                                                    if (count($arrayhijosN2) < 1) { ?>
                                                                                                                        <tr  >
                                                                                                                            <td width="400">
                                                                                                                                <?php 
                                                                                                                                $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosN3['jerarquia']);
                                                                                                                                echo ' ' . $jerarquia . ' - ' . $datosArrayhijosN3['descripcion'];
                                                                                                                                ?>
                                                                                                                            </td>
                                                                                                                            <td>
                                                                                                                                <table class="table table-hover">
                                                                                                                                    <tr>
                                                                                                                                        <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;</td>
                                                                                                                                        <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;</td>
                                                                                                                                        <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;</td>
                                                                                                                                        <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;</td>
                                                                                                                                        <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;</td>
                                                                                                                                        <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;</td>
                                                                                                                                        <td style="border: 1px solid black; border-right: 2px solid black; background-color: #cccccc;">&nbsp;</td>
                                                                                                                                        <td style="border: 1px solid black; border-right: 2px solid black; background-color: #cccccc;">&nbsp;</td>
                                                                                                                                        <td style="border: 1px solid black; background-color: #cccccc;">&nbsp;</td>
                                                                                                                                    </tr>
                                                                                                                                </table>
                                                                                                                            </td> 
                                                                                                                        </tr>
                                                                                                                    <?php } else { ?>
                                                                                                                        <tr  >
                                                                                                                            <td>
                                                                                                                                <?php 
                                                                                                                                $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosN3['jerarquia']);
                                                                                                                                echo ' ' . $jerarquia . ' - ' . $datosArrayhijosN3['descripcion'];
                                                                                                                                ?>
                                                                                                                            </td>
                                                                                                                            <td></td> 
                                                                                                                        </tr>
                                                                                                                        <?php
                                                                                                                        $arrayhijosNexLevel = hijosPrint($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosN3['jerarquia'], $token);
                                                                                                                        if (count($arrayhijosNexLevel) > 0) { ?>
                                                                                                                            <tr class="expandable-body">
                                                                                                                                <td>
                                                                                                                                    <div class="p-0">
                                                                                                                                        <table class="table table-hover">
                                                                                                                                            <tbody>
                                                                                                                                                <?php
                                                                                                                                                foreach ($arrayhijosNexLevel as $datosArrayhijosNexLevel) { ?>
                                                                                                                                                    <tr  >
                                                                                                                                                        <td>
                                                                                                                                                            <div class="p-0">
                                                                                                                                                                <table class="table table-hover">
                                                                                                                                                                    <tbody>
                                                                                                                                                                        <?php
                                                                                                                                                                        $arrayhijosN3 = hijosPrint($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosNexLevel['jerarquia'], $token);
                                                                                                                                                                        $variable = $datosArrayhijosNexLevel['idItems'] . '-' . @$idObjetivoHeader;

                                                                                                                                                                        if (count($arrayhijosN3) < 1) { ?>
                                                                                                                                                                            <tr  >
                                                                                                                                                                                <td width="380">
                                                                                                                                                                                    <?php 
                                                                                                                                                                                    $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                                                                                                                                                    echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'];
                                                                                                                                                                                    ?>
                                                                                                                                                                                </td>
                                                                                                                                                                                <td>
                                                                                                                                                                                    <table class="table table-hover">
                                                                                                                                                                                        <tr>
                                                                                                                                                                                            <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;</td>
                                                                                                                                                                                            <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;"> &nbsp;</td>
                                                                                                                                                                                            <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;"> &nbsp;</td>
                                                                                                                                                                                            <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);"> &nbsp;</td>
                                                                                                                                                                                            <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);"> &nbsp;</td>
                                                                                                                                                                                            <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);"> &nbsp;</td>
                                                                                                                                                                                            <td style="border: 1px solid black; border-right: 2px solid black; background-color: #cccccc;"> &nbsp;</td>
                                                                                                                                                                                            <td style="border: 1px solid black; border-right: 2px solid black; background-color: #cccccc;"> &nbsp;</td>
                                                                                                                                                                                            <td style="border: 1px solid black; background-color: #cccccc;"> &nbsp;</td>
                                                                                                                                                                                        </tr>
                                                                                                                                                                                    </table>
                                                                                                                                                                                </td> 
                                                                                                                                                                            </tr>
                                                                                                                                                                        <?php } else { ?>
                                                                                                                                                                            <tr  >
                                                                                                                                                                                <td>
                                                                                                                                                                                    <?php 
                                                                                                                                                                                    $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                                                                                                                                                    echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'];
                                                                                                                                                                                    ?>
                                                                                                                                                                                </td>
                                                                                                                                                                                <td></td> 
                                                                                                                                                                            </tr>
                                                                                                                                                                            <?php
                                                                                                                                                                            $arrayhijosNexLevel = hijosPrint($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosNexLevel['jerarquia'], $token);
                                                                                                                                                                            if (count($arrayhijosNexLevel) > 0) { ?>
                                                                                                                                                                                <tr class="expandable-body">
                                                                                                                                                                                    <td>
                                                                                                                                                                                        <div class="p-0">
                                                                                                                                                                                            <table class="table table-hover">
                                                                                                                                                                                                <tbody>
                                                                                                                                                                                                    <?php
                                                                                                                                                                                                    foreach ($arrayhijosNexLevel as $datosArrayhijosNexLevel) { ?>
                                                                                                                                                                                                        <tr  >
                                                                                                                                                                                                            <td>
                                                                                                                                                                                                                <div class="p-0">
                                                                                                                                                                                                                    <table class="table table-hover">
                                                                                                                                                                                                                        <tbody>
                                                                                                                                                                                                                            <?php
                                                                                                                                                                                                                            $arrayhijosN3 = hijosPrint($datosNodoPadre['idPlanificacionHeader'], $datosArrayhijosNexLevel['jerarquia'], $token);
                                                                                                                                                                                                                            $variable = $datosArrayhijosNexLevel['idItems'] . '-' . @$idObjetivoHeader;

                                                                                                                                                                                                                            if (count($arrayhijosN3) < 1) { ?>
                                                                                                                                                                                                                                <tr  >
                                                                                                                                                                                                                                    <td width="350">
                                                                                                                                                                                                                                        <?php 
                                                                                                                                                                                                                                        $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                                                                                                                                                                                                        echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'];
                                                                                                                                                                                                                                        ?>
                                                                                                                                                                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                                                                                                                                                    </td>
                                                                                                                                                                                                                                   
                                                                                                                                                                                                                                    <td>
                                                                                                                                                                                                                                        <table class="table table-hover">
                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                                                                                                                                                <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                                                                                                                                                <td style="border: 1px solid black; border-right: 2px solid black; background-color: #f2f2f2;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                                                                                                                                                <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                                                                                                                                                <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                                                                                                                                                <td style="border: 1px solid black; border-right: 2px solid black; background-color:rgb(138, 134, 134);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                                                                                                                                                <td style="border: 1px solid black; border-right: 2px solid black; background-color: #cccccc;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                                                                                                                                                <td style="border: 1px solid black; border-right: 2px solid black; background-color: #cccccc;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                                                                                                                                                <td style="border: 1px solid black; background-color: #cccccc;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                        </table>
                                                                                                                                                                                                                                    </td> 
                                                                                                                                                                                                                                </tr>
                                                                                                                                                                                                                            <?php } else { ?>
                                                                                                                                                                                                                                <tr  >
                                                                                                                                                                                                                                        <?php 
                                                                                                                                                                                                                                        $jerarquia = preg_replace('/^[^.]*\./', '', $datosArrayhijosNexLevel['jerarquia']);
                                                                                                                                                                                                                                        echo ' ' . $jerarquia . ' - ' . $datosArrayhijosNexLevel['descripcion'];
                                                                                                                                                                                                                                        ?>
                                                                                                                                                                                                                                    </td>
                                                                                                                                                                                                                                    <td></td> 
                                                                                                                                                                                                                                </tr>
                                                                                                                                                                                                                                <?php
                                                                                                                                                                                                                                nivel4Print($datosArrayhijosNexLevel, 5, $token, $idObjetivoHeader);
                                                                                                                                                                                                                                ?>
                                                                                                                                                                                                                            <?php } ?>
                                                                                                                                                                                                                        </tbody>
                                                                                                                                                                                                                    </table>
                                                                                                                                                                                                                </div>
                                                                                                                                                                                                            </td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                    <?php } ?>
                                                                                                                                                                                                </tbody>
                                                                                                                                                                                            </table>
                                                                                                                                                                                        </div>
                                                                                                                                                                                    </td>
                                                                                                                                                                                </tr>
                                                                                                                                                                            <?php } ?>
                                                                                                                                                                        <?php } ?>
                                                                                                                                                                    </tbody>
                                                                                                                                                                </table>
                                                                                                                                                            </div>
                                                                                                                                                        </td>
                                                                                                                                                    </tr>
                                                                                                                                                <?php } ?>
                                                                                                                                            </tbody>
                                                                                                                                        </table>
                                                                                                                                    </div>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        <?php } ?>
                                                                                                                    <?php } ?>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            <?php } ?>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>