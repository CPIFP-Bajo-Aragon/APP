



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">
    <title>Login</title>


  <!-- <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css"> -->
</head>


                    <a type="button" id="botonLogout" class="btn" href="<?php echo RUTA_URL ?>/login/logout">
                        <span>Logout</span>
                        <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
                    </a>



<table class="table">



<!--CABECERA TABLA-->
<thead>
    <tr>
    
        <th>ID MODULO</th>
        <th>NOMBRE CORTO</th>
        <th>NOMBRE</th>
        <th>OPCIONES</th>


        <!-- <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
            <th>OPCIONES</th>
        <?php endif ?> -->
    </tr>
</thead>


 <!--BODY TABLA-->
<tbody class="table-light">

    <?php
    foreach($datos['modulos'] as $modulos): ?>
    <tr>

        <td><?php echo $modulos->id_modulo?></td>
        <td><?php echo $modulos->nombre_corto?></td>
        <td><?php echo $modulos->modulo?></td>

        <td>
            <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $modulos->id_modulo?>" >
              <img src="<?php echo RUTA_Icon?>editar.svg"></img>
            </a>


          <!-- Ventana modal-->
          <div class="modal" id="editar_<?php echo $modulos->id_modulo?>">
            <div class="modal-dialog modal-xl modal-dialog-centered">
              <div class="modal-content">

               <!-- Header -->
               <div class="modal-header">
                  <h2 class="modal-title"><?php echo $modulos->modulo?></h2>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Body -->
              <div class="modal-body">
                  <form method="post" action="<?php echo RUTA_URL?>/login/editar_modulo/<?php echo $modulos->id_modulo?>" class="card-body">

                  <div class="row">
                      <div class="col-6 mt-3 mb-3">
                          <label for="horas">Horas totales</label>
                          <input type="text" name="horas" id="horas" class="form-control form-control-lg"value="<?php echo $modulos->horas_totales?>" required>
                      </div>

                      <div class="col-6 mt-3 mb-3">
                          <label for="turno">Turno</label>
                          <input type="text" name="turno" id="turno" class="form-control form-control-lg" value="<?php echo $modulos->turno?>" required>
                      </div>
                  </div>



                <?php $prof="";
                    foreach($datos['profes'] as $profes):
                        // if ($tipo!=$prueba->tipo){
                        //     $tipo=$prueba->tipo;
                        //     echo '<br>';
                        //     echo $tipo.':'.'&nbsp;&nbsp;&nbsp;';
                        // } ?>
                        <input type="checkbox" name="id_profe[]" value="<?php echo $profes->id_profesor?>">  
                        <?php echo $profes->nombre_completo;   echo '<br>';
                endforeach ?> 

                  





                      <input type="submit" class="btn" value="Confirmar">
                  </form>

              </div>
          </div>
          </div>
          </div>

        </td>

        <!-- <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?> -->

         

       
        <!-- <?php endif ?> -->
    </tr>
    <?php endforeach ?>
</tbody>

</table>








  <script src="<?php echo RUTA_URL ?>/public/assets/bootstrap/js/bootstrap.min.js"></script>


 
</body>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>