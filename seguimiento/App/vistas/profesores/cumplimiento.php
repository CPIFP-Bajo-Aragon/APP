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
            </div>                                   
        </header>


        <form  action="<?php echo RUTA_URL?>/profeSegui/eva_cumplimiento/<?php echo $datos['e_cumplimiento']['id_seguimiento']?>" method="post">
            <table id="tabla" class="table" style="margin-left:24%;">
                <thead>
                    <tr>
                        <th>DESCRIPCION</th>
                        <th>No o casi</th>
                        <th>Poco</th>
                        <th>A medias</th>
                        <th>Bastante</th>
                        <th>Si o casi</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($datos['preguntas'] as $pregun):?>
                        <tr>        
                            <td><?php echo $pregun->descripcion?></td> 

                            <td><input type="radio" id="no" name="<?php echo $pregun->id_pregunta?>" value="<?php echo $pregun->id_pregunta?>-0" 
                                <?php foreach ($datos['respuestas_cumplimiento'] as $respu) {
                                if(($pregun->id_pregunta==$respu->id_pregunta) && ($respu->respuesta==0)){
                                echo "checked";
                                }}?>>
                            </td>

                            <td><input type="radio" id="poco" name="<?php echo $pregun->id_pregunta?>" value="<?php echo $pregun->id_pregunta?>-2.5"
                            <?php foreach ($datos['respuestas_cumplimiento'] as $respu) {
                                if(($pregun->id_pregunta==$respu->id_pregunta) && ($respu->respuesta==2.5)){
                                echo "checked";
                                }}?>>
                            </td> 

                            <td><input type="radio" id="medias" name="<?php echo $pregun->id_pregunta?>" value="<?php echo $pregun->id_pregunta?>-5"
                            <?php foreach ($datos['respuestas_cumplimiento'] as $respu) {
                                if(($pregun->id_pregunta==$respu->id_pregunta) && ($respu->respuesta==5)){
                                echo "checked";
                                }}?>>
                            </td>

                            <td><input type="radio" id="bastante" name="<?php echo $pregun->id_pregunta?>" value="<?php echo $pregun->id_pregunta?>-7.5"
                            <?php foreach ($datos['respuestas_cumplimiento'] as $respu) {
                                if(($pregun->id_pregunta==$respu->id_pregunta) && ($respu->respuesta==7.5)){
                                echo "checked";
                                }}?>>
                            </td>

                            <td><input type="radio" id="si" name="<?php echo $pregun->id_pregunta?>" value="<?php echo $pregun->id_pregunta?>-10"
                            <?php foreach ($datos['respuestas_cumplimiento'] as $respu) {
                                if(($pregun->id_pregunta==$respu->id_pregunta) && ($respu->respuesta==10)){
                                echo "checked";
                                }}?>>
                            </td>
                        </tr>

                    <?php endforeach?>

                    <input type="hidden" name="id_modulo" value="<?php echo $datos['e_cumplimiento']['id_modulo']?>">
                    <input type="hidden" name="id_evaluacion" value="<?php echo $datos['e_cumplimiento']['id_evaluacion']?>">
                </tbody>
            </table>

            <div class="col mt-5 mb-4" style="margin-left:55%;">
                <input type="submit" id="anadir" class="btn" value="Confirmar">
            </div>
        </form>



  