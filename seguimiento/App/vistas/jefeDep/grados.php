


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

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 

</head>





<style>
* {box-sizing: border-box}
body {font-family: Arial, Helvetica, sans-serif;}

.menu{
  width: 100%;
  background-color: #555;
  overflow: auto;
}

.menu a {
  float: left;
  padding: 7px 0 7px 0;
  color: white;
  text-decoration: none;
  font-size: 17px;
  width: 25%; 
  text-align: center;
}

.menu a:hover {
  background-color: #000;
}

.menu a.active {
  background-color: #f46116;
}

@media screen and (max-width: 500px) {
  .menu a {
    float: none;
    display: block;
    width: 100%;
    text-align: left;
  }
}
</style>



    <header class="navbar navbar-expand-sm" style="background-color: #e9e9e9">
      <div class="container-fluid">
            <a href="<?php echo RUTA_CPIFP?>/inicio" class="nav-link"> 
                <img src="<?php echo RUTA_Icon?>logo_cpifp.png" style="width:230px;" class="mt-2 mb-2"> 
            </a> 
            <ul class="navbar-nav ms-auto me-4 mb-2 mb-md-0">
                <li class="navbar-text">
                    <?php echo $datos['usuarioSesion']->login ?>
                </li>
            </ul>
            <a type="button" id="botonLogout" class="btn" href="<?php echo RUTA_LOGOUT?>">
                <span>Logout</span>
                <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
            </a>
      </div>
    </header>  

    
    <!-- <a  data-bs-toggle="tab" href="#menu1" href="<?php echo RUTA_URL ?>/jefeDep/reparto/<?php echo $cursos->id_curso.'-'.$grados->id_ciclo?>"><span><?php echo $grados->ciclo.' - '?><?php echo $grados->ciclo_corto?></span></a> -->

    <body>

        <div class="menu nav nav-tabs" role="tablist">
            <a class="active" href="<?php echo RUTA_SEGUIMIENTO?>">Volver atrás</a> 
            <?php foreach($datos['grados'] as $grados):?>
                <a class="" id="<?php echo $grados->id_ciclo?>" data-bs-toggle="tab" href="#<?php echo $grados->ciclo_corto?>"><span><?php echo $grados->ciclo.' - '?><?php echo $grados->ciclo_corto?></span></a>
            <?php endforeach ?>
        </div>



        <div class="tab-content">
            <?php foreach($datos['grados'] as $grados):?>
                <div id="<?php echo $grados->ciclo_corto?>" class="container tab-pane "><br>
                    <h3><?php echo $grados->ciclo?></h3>


                    <table id="tabla" class="table table-responsive table-hover">

                    <!--CABECERA TABLA-->
                    <thead>
                        <tr>
                            <th>ASIGNATURAS</th>
                            <th>CURSO</th>
                            <th>PROFESORES ASIGNADOS Y HORAS</th>
                        </tr>
                    </thead>

                    <!--BODY TABLA-->
                    <tbody>
                        <?php
                        foreach($datos['asignaturas'] as $asignaturas): ?>
                        <?php if ($grados->id_ciclo == $asignaturas->id_ciclo) { ?>
                        <tr>

                            <td data-bs-toggle="modal" data-bs-target="#anadir_<?php echo $asignaturas->id_modulo ?>" style="cursor:pointer"><?php echo $asignaturas->modulo?></td>
                            <td data-bs-toggle="modal" data-bs-target="#anadir_<?php echo $asignaturas->id_modulo ?>" style="cursor:pointer"><?php echo $asignaturas->curso?></td>
                            <td data-bs-toggle="modal" data-bs-target="#anadir_<?php echo $asignaturas->id_modulo ?>" style="cursor:pointer">
                                <?php foreach ($datos['profes'] as $prof) {
                                foreach ($datos['prof_mod'] as $mod) {
                                if ($prof->id_profesor == $mod->id_profesor && $mod->id_modulo == $asignaturas->id_modulo) {
                                    echo $prof->nombre_completo . ' (' . $mod->horas_profesor . ' horas) ;  ';
                                }};}?>
                            </td>

                            <!-- MODAL REPARTO HORAS-->
                            <td>
                                <div class="modal" id="anadir_<?php echo $asignaturas->id_modulo?>">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">

                                <!-- Header -->
                                <div class="modal-header mb-4">
                                    <h2 class="modal-title"><?php echo $asignaturas->modulo.' ('.$asignaturas->curso.')'?></h2> 
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Body --> 
                                <div class="modal-body">
                                <form method="post" action="<?php echo RUTA_URL ?>/jefeDep/insertar_modulo/<?php echo $asignaturas->id_modulo ?>" class="card-body" onsubmit="activo(<?php echo $asignaturas->id_ciclo?>)">

                                    <div class="row mb-5 ps-4">                     
                                        <div class="col-6 ">
                                            <div class="input-group">
                                                <label for="horas" class="input-group-text">Horas totales <sup>*</sup></label>
                                                <input type="text" style="width:100px" name="horas" id="horas" value="<?php echo $asignaturas->horas_totales ?>"  required >
                                            </div>
                                        </div>  
                                        <div class="col-6">
                                            <div class="input-group">
                                                <label for="turno" class="input-group-text">Horas semanales <sup>*</sup></label>
                                                <input type="text" style="width:100px" name="turno" id="turno" value="<?php echo $asignaturas->horas_semanales?>"  required >
                                            </div>
                                        </div> 
                                    </div> 

                                    <h5 class="ps-4 mb-4">Indica las horas por profesor</h5>
                                    <?php foreach ($datos['profes'] as $profes): ?>
                                        <div class="row">
                                        <input type="text" class="mb-4" style="width:45px; margin-left:40px; margin-right: 10px;" id="horas" name="horas[]" 
                                            value="<?php foreach ($datos['prof_mod'] as $prof_mod) {
                                            if (($prof_mod->id_profesor == $profes->id_profesor) && ($prof_mod->id_modulo == $asignaturas->id_modulo)) {
                                                echo $prof_mod->horas_profesor;
                                            }
                                        }

                                            ?>"
                                        ><?php echo $profes->nombre_completo; ?>
                                        <input type="hidden" name="profes[]" value="<?php echo $profes->id_profesor ?>">
                                        </div>  
                                    <?php endforeach ?> 

                                    <input type="hidden" name="lectivo" value="<?php echo $datos['lectivo'][0]->id_lectivo ?>">
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
              <?php } ?>
              <?php endforeach ?>
            </tbody>
        </table>
    
                </div>
            <?php endforeach ?>
        </div>
     





               




       
<script>

    function activo(id_modulo){
       // console.log(id_modulo)
        var activo=document.getElementById(id_modulo)
        activo.setAttribute("class","active")
        //console.log(activo)
        activo.setAttribute("style","background-color:#f46116")
       console.log(activo)
    }

</script>