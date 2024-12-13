<style>
    .small-font {
        font-size: 10px;
    }
    .logo {
        width: 30%;
    }
</style> 
<div class="container-fluid  small-font">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <img src=<?php echo $_SESSION['HTTP_ORIGIN'] ;?>"/dist/img/Logo-TAEO-horizontal-cyan.png" alt="Logo Taeo" class="logo">
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
                     <button type="submit" id="printButtonNoScript" class="btn btn-primary">Imprimir2</button>
                    <!-- <button onclick="window.location.href='generatePdf.php'">Generar PDF</button> -->
                </div>
            </div>
            <hr class="separator">
        </div>
