<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <script src="<?php echo RUTA_URL?>/js/main.js"></script>
    
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/estilos.css">
    <title><?php echo NOMBRE_SITIO ?></title>

    <style>
        #botonLogout{
            background-color:#0b2a85;
        }

        #botonLogout a:hover{
            background-color: #f46116; 
        }


        #botonLogout span{
            font-size:20px;
            color:white;
        }

        #botonLogout img{
            width:25px;
            height:25px;
        }
    </style>
</head>
<body>

    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top" -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #e9e9e9">
        <div class="container-fluid">
            <a class="" href="<?php echo RUTA_URL ?>/..">
                <img src="<?php echo RUTA_URL ?>/img/icons/logo_cpifp.png" style="width:150px;" class="mt-2 mb-2"> 
            </a>
            <!-- <a class="navbar-brand" href="<?php echo RUTA_URL ?>/..">Orientación</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-5 ps-5">
                    <li class="nav-item">
                        <?php if (isset($datos['menuActivo']) && $datos['menuActivo'] == 'home' ): ?>
                            <a class="nav-link active fw-bolder" aria-current="page" href="<?php echo RUTA_URL ?>">Home</a>
                        <?php else: ?>
                            <a class="nav-link fw-bolder" aria-current="page" href="<?php echo RUTA_URL ?>">Home</a>
                        <?php endif ?>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($datos['menuActivo']) && $datos['menuActivo'] == 'asesorias' ): ?>
                            <a class="nav-link active fw-bolder" href="<?php echo RUTA_URL ?>/asesorias/filtro">Limpiar Filtro</a>
                        <?php else: ?>
                            <a class="nav-link fw-bolder" href="<?php echo RUTA_URL ?>/asesorias/filtro">Filtro</a>
                        <?php endif ?>
                    </li>
                </ul>

                <span class="navbar-nav fs-2 fw-bold mx-auto" style="color: #003d80">Orientación</span>

                <ul class="navbar-nav ms-auto me-4 mb-2 mb-md-0">
                    <li class="navbar-text">
                        <?php echo $datos['usuarioSesion']->login ?>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" 
                            href="<?php echo RUTA_URL ?>/login/logout">LogOut
                        </a>
                    </li> -->
                </ul>

                <a type="button" id="botonLogout" class="btn" href="<?php echo RUTA_URL ?>/login/logout">
                    <span>Logout</span>
                    <img class="ms-2" src="<?php echo RUTA_URL ?>/img/icons/logout.png">
                </a>

            </div>
        </div>
    </nav>

    <br><br><br>
    