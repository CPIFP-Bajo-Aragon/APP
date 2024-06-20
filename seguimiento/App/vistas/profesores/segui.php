
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">
   
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">
    <title>Login</title>


  <!-- <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css"> -->



  <style>
    .boton {
      padding: 15px 25px;
      font-size: 20px;
      text-align: center;
      cursor: pointer;
      outline: none;
      color:white;
      background-color: #0b2a85 ;
      border: none;
      border-radius: 15px;
      width:200px;
    }

    .boton:hover {background-color: #f46116}

    .boton:active {
      background-color: #f46116;
      transform: translateY(4px);
    }
</style>






</head>


    
    <nav class="navbar navbar-expand-sm navbar-light" style="background-color: #e9e9e9">
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
    </nav>  



    
    <div class="container-fluid mt-5 mb-5">
      <div class="card d-flex justify-content-center align-items-center" style="background-color:#e9e9e9; border:solid 3px #0b2a85; width:70%; height:150px; border-radius:15px; margin-top:50px; margin:auto">
        <div class="card-body">
        <h5 class="card-title mt-2 mb-4 text-center" style="color:#0b2a85">SEGUIMIENTO DE LA PROGRAMACION</h5>
          <?php foreach($datos['modulo'] as $mod):?>
              <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/profeSegui/diario/<?php echo $mod->id_modulo?>">
                <button type="button" class="boton text-white me-2 mb-3"><?php echo $mod->modulo?></button>
              </a> 
          <?php endforeach ?>
        </div>
      </div>
    </div>


    <?php if ($datos['usuarioSesion']->id_rol == 30) {?>
            <div class="card d-flex justify-content-center align-items-center me-5" style="background-color:#e9e9e9; border:solid 3px #0b2a85; width:300px; height:150px; border-radius:15px; margin:auto">
                <div class="card-body">
                  <h5 class="card-title mt-2 mb-4 text-center" style="color:#0b2a85">REPARTO DE HORAS</h5>
                  <a style="text-decoration:none; color:black;" href="<?php echo RUTA_REPARTO?>">
                    <button type="button" class="boton text-white mb-3">Reparto</button>
                  </a> 
                </div>
              </div>
          <?php }?>


    <div class="container-fluid">
      <div class="row">

          
          
          <?php if ($datos['usuarioSesion']->id_rol == 50) {?>
            <div class="card d-flex justify-content-center align-items-center" style="background-color:#e9e9e9; border:solid 3px #0b2a85; width:300px; height:150px; border-radius:15px; margin:auto">
              <div class="card-body">
                <h5 class="card-title mt-2 mb-4 text-center" style="color:#0b2a85">CURSO LECTIVO</h5>
                <a style="text-decoration:none; color:black;" href="<?php echo RUTA_CURSO?>">
                  <button type="button" class="boton text-white mb-3">Nuevo curso</button>
                </a> 
              </div>
            </div>  
          <?php }?>      
      
      </div>      
    </div>

