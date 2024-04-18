
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
        color: #fff;
        background-color: #0b2a85;
        border: none;
        border-radius: 15px;
        box-shadow: 0 9px #999;
        width:250px;
        }

        .boton:hover {background-color: #f46116}

        .boton:active {
        background-color: #f46116;
        /* box-shadow: 0 5px #666; */
        transform: translateY(4px);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light fixed-top" style="background-color: #e9e9e9">
        <div class="container-fluid">
            <img src="<?php echo RUTA_Icon?>logo_cpifp.png" style="width:230px;" class="mt-2 mb-2"> 
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

    <div class="container" style="margin-top:90px">
        <div class="row justify-content-around">
            <!-- <div class="col-4 col-xs-6 col-md-6 pt-5 mx-5 ">    
                <a style="text-decoration:none; color:black;" href="../seguimiento/profeSegui" >
                <button type="button" class="boton text-white shadow-lg">Seguimiento de la programacion</button></a>
            </div> -->
            
            <?php if($datos['accesos']->seguimiento): ?>
                <div class="col-12 col-md-3 col-sm-4 pt-5">    
                    <a style="text-decoration:none; color:black;" href="../seguimiento/profeSegui" >
                    <button type="button" class="boton text-white shadow-lg" style="height:90px">Seguimiento de la programacion</button></a>
                </div>
            <?php endif ?>

            <?php if($datos['accesos']->mantenimiento || $datos['usuarioSesion']->isAdmin): ?>
                <div class="col-12 col-md-3 col-sm-4 pt-5">    
                    <a style="text-decoration:none; color:black;" href="../mantenimiento/index.html" >
                    <button type="button" class="boton text-white shadow-lg" style="height:90px">Mantenimiento</button></a>
                </div>
            <?php endif ?>

            <?php if($datos['accesos']->orientacion): ?>
                <div class="col-12 col-md-3 col-sm-4 pt-5">    
                    <a style="text-decoration:none; color:black;" href="../orientacion" >
                    <button type="button" class="boton text-white shadow-lg" style="height:90px">IOPE</button></a>
                </div>
            <?php endif ?>
        </div>
    </div>
    <hr style="margin-top:100px">
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Roles de Usuario</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos['usuarioSesion']->roles as $rol): ?>
                    <tr>
                        <td></td>
                        <td><?php echo $rol->departamento ?></td>
                        <td><?php echo $rol->rol ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    
    <script>
        <?php
            // Cuando se quite la aplicacion de nuxt, esto se podra quitar

            $userStorage = [
                'id_profesor' => $datos["usuarioSesion"]->id_profesor,
                'login' => $datos["usuarioSesion"]->login,
                'email' => $datos["usuarioSesion"]->email,
                'nombre_completo' => $datos["usuarioSesion"]->nombre_completo,
                'access_token' => session_id(),
                'expires_in' => 3600
            ];
        
        ?>
        localStorage.setItem("userStorage", '<?php echo json_encode($userStorage) ?>');
    </script>
</body>
</html>

