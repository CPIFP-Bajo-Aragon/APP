<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


        <header style="margin-left:22%;">
            <div class="row mb-5">
                <div class="col-10 text-center d-flex align-items-center justify-content-center">
                    <span class="w-75" id="textoHead">
                    <h4>Grado de cumplimiento de la programacionnnn 
                        <span style="font-weight:bold;"><?php foreach ($datos['evaluacion'] as $evaluacion) {
                            if ($datos['e_cumplimiento']['id_evaluacion'] == $evaluacion->id_eva) {
                                echo 'Evaluacion '.$evaluacion->eva;
                            }}?>
                        </span>
                    </h4>
                    <?php echo "ep1: " . $datos['ep1']; ?>
                    </span>
                </div>
            </div>                                   
        </header>


        


  