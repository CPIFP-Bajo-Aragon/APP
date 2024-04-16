

<?php require_once RUTA_APP . '/vistas/inc/nav_dep.php' ?>




<table id="tabla" class="table table-responsive table-hover">

<!--CABECERA TABLA-->
<thead>
    <tr>
        <th>ASIGNATURAS</th>
        <th>PROFESORES ASIGNADOS Y HORAS</th>
    </tr>
</thead>

<!--BODY TABLA-->
<tbody>







    <?php
    foreach($datos['asignaturas'] as $asignaturas): ?>
    <tr>

        <td data-bs-toggle="modal" data-bs-target="#anadir_<?php echo $asignaturas->id_modulo?>" style="cursor:pointer"><?php echo $asignaturas->modulo?></td>
        <td data-bs-toggle="modal" data-bs-target="#anadir_<?php echo $asignaturas->id_modulo?>" style="cursor:pointer">

            <?php  foreach($datos['profes'] as $prof){
                    foreach($datos['prof_mod'] as $mod){
                      if($prof->id_profesor==$mod->id_profesor && $mod->id_modulo==$asignaturas->id_modulo){
                        echo $prof->nombre_completo.' ('.$mod->horas_profesor.' horas) ;  ';
                      }

                  };
            }
            ?>
        </td>


        
        <td>
          <!-- Ventana modal-->
          <div class="modal" id="anadir_<?php echo $asignaturas->id_modulo?>">
          <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">

               <!-- Header -->
               <div class="modal-header mb-4">
                  <h2 class="modal-title"><?php echo $asignaturas->modulo?></h2> 
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Body --> 
                <div class="modal-body">
                <form method="post" action="<?php echo RUTA_URL?>/jefeDep/insertar_modulo/<?php echo $asignaturas->id_modulo?>" class="card-body">

                      <div class="row mb-5 ps-4">                     
                          <div class="col-6 ">
                              <div class="input-group">
                                  <label for="horas" class="input-group-text">Horas totales <sup>*</sup></label>
                                  <input type="text" style="width:100px" name="horas" id="horas" value="<?php echo $asignaturas->horas_totales?>"  required >
                              </div>
                          </div>  
                          <div class="col-6">
                              <div class="input-group">
                                  <label for="turno" class="input-group-text">Horas semanales <sup>*</sup></label>
                                  <input type="text" style="width:100px" name="turno" id="turno"value="<?php echo $asignaturas->horas_semanales?>"  required >
                              </div>
                          </div> 
                      </div> 

                      <h5 class="ps-4 mb-4">Indica las horas por profesor</h5>
                        <?php foreach($datos['profes'] as $profes): ?>
                            <div class="row">
                              <input type="text" class="mb-4" style="width:45px; margin-left:40px; margin-right: 10px;" id="horas" name="horas[]" 
                                value="<?php
                                  foreach($datos['prof_mod'] as $prof_mod){
                                    if(($prof_mod->id_profesor==$profes->id_profesor) && ($prof_mod->id_modulo==$asignaturas->id_modulo)){
                                      echo $prof_mod->horas_profesor;
                                    }
                                  }
                                
                                ?>"
                              ><?php echo $profes->nombre_completo;?>
                              <input type="hidden" name="profes[]" value="<?php echo $profes->id_profesor?>">
                            </div>  
                        <?php endforeach ?> 

                            <input type="hidden" name="lectivo" value="<?php echo $datos['lectivo'][0]->id_lectivo?>">
                            <div class="d-flex justify-content-end">
                                <input type="submit" class="btn mt-3 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                            </div> 

                </form>
                </div>
          </div>
          </div>
          </div>



                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
        </table>
               



  <script src="<?php echo RUTA_URL ?>/public/assets/bootstrap/js/bootstrap.min.js"></script>


 
</body>


<script>



</script>

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>