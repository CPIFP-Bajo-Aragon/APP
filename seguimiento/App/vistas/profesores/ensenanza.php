<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


        <header style="margin-left:22%;">
            <div class="row mb-5">
                <div class="col-10 d-flex text-center align-items-center justify-content-center">
                    <span class="w-75" id="textoHead">
                    <h4>Proceso de enseñanza y de la practica docente
                        <span style="font-weight:bold;"><?php foreach ($datos['evaluacion'] as $evaluacion) {
                            if ($datos['e_ensenanza']['id_evaluacion'] == $evaluacion->id_eva) {
                                echo 'Evaluacion '.$evaluacion->eva;
                            }}?>
                        </span>
                    </h4>
                </div>
            </div>                                   
        </header>


  
    <form method="post" action="<?php echo RUTA_URL?>/profeSegui/eva_ensenanza/<?php echo $datos['e_ensenanza']['id_seguimiento']?>" style="margin-left:22%;">

        <div class="row mt-5"> 
            <div class="col-6">
                <div class="card mt-5 w-75 card-center" style=" margin: auto;">
                    <div class="card-header">Asistencia de los alumnos</div>
                    <div class="input-group">
                        <label for="matriculados" class="input-group-text">Alumnos matriculados<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md" name="matriculados" value="<?php echo $datos['respuestas_ensenanza'][0]->alu_mat?>" required >
                    </div>
                    <div class="input-group">
                        <label for="excep" class="input-group-text">Alumnos que solo han asistido a clase excepcionalmente<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md"  name="excep" value="<?php echo $datos['respuestas_ensenanza'][0]->alu_discon?>" required >
                    </div>
                    <div class="input-group">
                        <label for="efectivos" class="input-group-text">Alumnos efectivos<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md" name="efectivos" value="<?php echo $datos['respuestas_ensenanza'][0]->alu_efect?>" required >
                    </div>
                    <div class="input-group">
                        <label for="horas_alumno" class="input-group-text">Horas previstas (x alumno efectivo)<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md" name="horas_alumno" value="<?php echo $datos['respuestas_ensenanza'][0]->hrs_x_alumno?>" required >
                    </div>
                    <div class="input-group">
                        <label for="faltas" class="input-group-text">Numero total de faltas consignadas<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md" name="faltas" value="<?php echo $datos['respuestas_ensenanza'][0]->alu_falt?>" required >
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card  mt-5 w-75 card-center" style=" margin: auto;">
                    <div class="card-header">Ambiente de trabajo</div>
                    <div class="input-group">
                        <label for="interes" class="input-group-text">Interes/atencion del grupo<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md" name="interes" value="<?php echo $datos['respuestas_ensenanza'][0]->interes?>"required >
                    </div>
                    <div class="input-group">
                        <label for="comportamiento" class="input-group-text">Comportamiento general,respeto,trato<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md"  name="comportamiento" value="<?php echo $datos['respuestas_ensenanza'][0]->comportamiento?>" required >
                    </div>
                    <div class="input-group">
                        <label for="puntualidad" class="input-group-text">Puntualidad<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md" name="puntualidad" value="<?php echo $datos['respuestas_ensenanza'][0]->puntualidad?>" required >
                    </div>
                    <div class="input-group">
                        <label for="limpieza" class="input-group-text">Limpieza/orden aula,taller,equipos...<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md" name="limpieza" value="<?php echo $datos['respuestas_ensenanza'][0]->limpieza?>" required >
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card mt-5 w-75 card-center" style=" margin: auto;">
                    <div class="card-header">Horas de docencia impartidas</div>
                    <div class="input-group">
                        <label for="horas" class="input-group-text">Horas previstas<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md" name="horas" value="<?php echo $datos['respuestas_ensenanza'][0]->hrs_docen?>" required >
                    </div>
                    <div class="input-group">
                        <label for="faltas_profe" class="input-group-text">Horas faltadas por el profesor<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md" name="faltas_profe" value="<?php echo $datos['respuestas_ensenanza'][0]->faltas_profe?>"required >
                    </div>
                    <div class="input-group">
                        <label for="faltas_otros" class="input-group-text">Horas perdidas por otros motivos<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md" name="faltas_otros" value="<?php echo $datos['respuestas_ensenanza'][0]->faltas_otros?>" required >
                    </div>    
                </div>
                
            </div>
            <div class="col-6">
                <div class="card mt-5 w-75 card-center" style=" margin: auto;">
                    <div class="card-header">Indicador de aprobados</div>
                    <div class="input-group">
                        <label for="evaluados" class="input-group-text">Total alumnos evaluados<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md" name="evaluados" value="<?php echo $datos['respuestas_ensenanza'][0]->alu_eva?>" required >
                    </div>
                    <div class="input-group">
                        <label for="aprobados" class="input-group-text">Total alumnos aprobados<sup>*</sup></label>
                        <input type="text" class="form-control form-control-md" name="aprobados" value="<?php echo $datos['respuestas_ensenanza'][0]->alu_apro?>" required >
                    </div>   
                </div>
                
            </div>
        </div>
         
         <input type="hidden" name="id_evaluacion" value="<?php echo $datos['e_ensenanza']['id_evaluacion']?>">
         <input type="hidden" name="id_modulo" value="<?php echo $datos['e_ensenanza']['id_modulo']?>">


         <div class="col mt-5 mb-4" style="margin-left:45%;">
            <input type="submit" id="anadir" name="aceptar" class="btn" value="Confirmar">
        </div>

    </form>
        


       
               