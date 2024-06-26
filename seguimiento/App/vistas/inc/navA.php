
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">

    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>  -->

    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">  -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 


      <!-- <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script> 
 <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>   -->

 <!-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' type="text/css"></script>  
 <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js' type="text/js"></script>  
 <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css' type="text/css"></script>  
 <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.js' type="text/js"></script>  
 <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.js' type="text/js"></script>  
 <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/package.json' type="text/json"></script>   -->




    <title><?php echo NOMBRE_SITIO ?></title>
</head>


<style>

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width:100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}


/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: rgb(142, 193, 231 );
}

</style>

<body>


    <nav class="navbar navbar-expand-sm navbar-light" style="background-color: #e9e9e9">
        <div class="container-fluid">
            <a href="<?php echo RUTA_CPIFP?>/inicio" class="nav-link"> 
                <img src="<?php echo RUTA_Icon?>logo_cpifp.png" style="width:230px;" class="mt-2 mb-2"> 
            </a> 

            <div class="col-8 d-flex align-items-center justify-content-center">
                <span id="textoHead">Modulo de <?php echo $datos['datos_modulo'][0]->modulo?></span>
            </div>

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

        


    <section>

        <nav class="menu1" id="menu1" style="position:fixed">
      

            <a href="<?php echo RUTA_URL ?>/profeSegui/diario/<?php echo $datos['datos_modulo'][0]->id_modulo?>" class="nav-link">                           
                <span class="tMenu">Diario</span>                                                          
            </a>   

            <a href="<?php echo RUTA_URL ?>/profeSegui/datos_modulo/<?php echo $datos['datos_modulo'][0]->id_modulo?>" class="nav-link">                           
                <span class="tMenu">Datos del modulo</span>                                                          
            </a>

            <div class="sidenav">
                <a class="dropdown-btn">
                    <span class="tMenu">1º Evaluacion</span>
                </a>
                <div class="dropdown-container">
                    <a href="<?php echo RUTA_URL ?>/profeSegui/cumplimiento/<?php echo $datos['evaluacion'][0]->id_eva.'-'.$datos['datos_modulo'][0]->id_modulo?>" class="nav-link"><span class="tDes">Cumplimiento de la programacion</span></a>
                    <a href="<?php echo RUTA_URL ?>/profeSegui/ensenanza/<?php echo $datos['evaluacion'][0]->id_eva.'-'.$datos['datos_modulo'][0]->id_modulo?>"><span class="tDes">Proceso de enseñanza</span></a>
                </div>
            </div>

            <div class="sidenav">
                <a class="dropdown-btn">
                    <span class="tMenu">2º Evaluacion</span>
                </a>
                <div class="dropdown-container">
                    <a href="<?php echo RUTA_URL ?>/profeSegui/cumplimiento/<?php echo $datos['evaluacion'][1]->id_eva.'-'.$datos['datos_modulo'][0]->id_modulo?>" class="nav-link"><span class="tDes">Cumplimiento de la programacion</span></a>
                    <a href="<?php echo RUTA_URL ?>/profeSegui/ensenanza/<?php echo $datos['evaluacion'][1]->id_eva.'-'.$datos['datos_modulo'][0]->id_modulo?>" class="nav-link "><span class="tDes">Proceso de enseñanza</span></a>
                </div>
            </div>

            <div class="sidenav">
                <a class="dropdown-btn">
                    <span class="tMenu">Evaluacion Final</span>
                </a>
                <div class="dropdown-container">
                    <a href="<?php echo RUTA_URL ?>/profeSegui/cumplimiento/<?php echo $datos['evaluacion'][2]->id_eva.'-'.$datos['datos_modulo'][0]->id_modulo?>" class="nav-link"><span class="tDes">Cumplimiento de la programacion</span></a>
                    <a href="<?php echo RUTA_URL ?>/profeSegui/ensenanza/<?php echo $datos['evaluacion'][2]->id_eva.'-'.$datos['datos_modulo'][0]->id_modulo?>" class="nav-link "><span class="tDes">Proceso de enseñanza</span></a>
                </div>
            </div>

            <!-- (R.Olles 24-06-2024) Cambio de enlace de "/informes/" a /profeSegui/informes/" -->
            <a href="<?php echo RUTA_URL ?>/profeSegui/informes/<?php echo $datos['datos_modulo'][0]->id_modulo?>" class="nav-link">                           
                <span class="tMenu">Informes</span>                                                          
            </a>


            <div class="d-flex justify-content-center mt-5">
                <a href="<?php echo RUTA_SEGUIMIENTO?>" class="btn btn-light">Volver</a>
            </div>

  
        </nav>




<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
        } else {
        dropdownContent.style.display = "block";
        }
    });
    }
</script>