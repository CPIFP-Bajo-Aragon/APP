<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


        <header style="margin-left:22%;">
            <div class="row mb-5">
                <div class="col-10 text-center d-flex align-items-center justify-content-center">
                    <span class="w-75" id="textoHead">
                    <h4>Grado de cumplimiento de la programacion 
                        <span style="font-weight:bold;"><?php foreach ($datos['evaluacion'] as $evaluacion) {
                            if ($datos['e_cumplimiento']['id_evaluacion'] == $evaluacion->id_eva) {
                                echo 'Evaluacion '.$evaluacion->eva;
                            }}?>
                        </span>
                    </h4>
                    </span>
                </div>

                <!-- (R.Olles 28-06-2024) Muestra datos ep1 de todos los meses
                A cambiar con el diseño elegido para la vista-->
                <div>
                    <h3>ep1 a fecha acutal</h3>
                    <?php echo 'ep1 a ' . date('Y-m-d') . ': ' . $datos['ep1']; ?>

                    <h3>ep1 de todos los meses (a final del mes)</h3>
                    <?php
                        foreach ($datos['ep1s'] as $mes => $ep1) {
                            echo $mes . ' - ep1: '. $ep1 . '<br>';
                        }
                    ?>
                </div>

            </div>                                   
        </header>





        


  