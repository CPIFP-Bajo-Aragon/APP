
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


<!-- <style>

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

</style> -->

<body>


    <nav class="navbar navbar-expand-sm" style="background-color: #e9e9e9">
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

    

    <section>

    
<!-- 
        <nav class="menu1" id="menu1">      
           
            <div class="sidenav">
                <?php foreach($datos['grados'] as $grados):?>
                    <button class="dropdown-btn" style="border-bottom:solid white 5px;">                           
                        <p class="tMenu text-center"><?php echo $grados->ciclo?></p></span>                                                          
                    </button>
                    <div class="dropdown-container">
                        <?php foreach($datos['cursos'] as $cursos):
                            if($cursos->id_ciclo==$grados->id_ciclo){?>
                                <a href="<?php echo RUTA_URL ?>/jefeDep/reparto/<?php echo $cursos->id_curso.'-'.$grados->id_ciclo?>"><span class="tDes"><?php echo $cursos->curso?></span></a>
                           <?php }?>
                        <?php endforeach ?> 
                    </div>
                <?php endforeach ?> 
            </div>


         

            <div class="d-flex justify-content-center mt-5">
                <a href="<?php echo RUTA_SEGUIMIENTO?>" class="btn btn-light">Volver</a>
            </div>

                                 
            

        </nav>  -->

        

 
<!-- <script>
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
</script>  -->