<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Login</title>
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/assets/fonts/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/assets/css/Login-Form-Dark.css">
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/assets/css/styles.css">

  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">
</head>



<body id="bodyLogin" class="m-0 vh-100 row justify-content-center align-items-center" style="background-color:eae9e9">

  <div id="ventanaLogin" class="card card-center col-auto shadow-lg">
  
      <form method="post" >

        <div class="row justify-content-center mt-3">
          <img src="<?php echo RUTA_Icon?>logo_cpifp.png" style="height:75px; width:375px;">
        </div>

          <div class="row justify-content-center mt-4">
            <div class="input-group mb-3 w-75">
                <label for="email"class="input-group-text bg-white"><img src="<?php echo RUTA_Icon?>email.svg" width="30px"></label>
                <input type="text" name="email" id="email" class="form-control form-control-md bg-white" placeholder="Email" required>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="input-group mb-4 w-75">
                <label for="password"class="input-group-text bg-white"><img src="<?php echo RUTA_Icon?>llave.svg" width="30px"></label>
                <input type="password" name="passw" id="passw" class="form-control form-control-md" placeholder="Password" required>               
            </div>
          </div> 
              
          <div class="d-flex justify-content-center" >          
              <button type="submit" class="btn boton w-75"><img src="<?php echo RUTA_Icon?>candado.png" width="35px">Login</button>                         
          </div>
      </form>
  


          <!-- <div class="row ms-2">
            <a class="mt-1 ms-5" data-bs-toggle="modal" data-bs-target="#recuperar" href="#"><strong>Recuperar contraseña</strong></a>
          </div> -->

          <!-- VENTANA -->
          <!-- <div class="modal fade" id="recuperar">
          <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content modal-content-md"> -->

          <!-- <form action="<?php echo RUTA_URL?>/login/recuperar/" method="post"> -->
                <!-- Modal Header -->
                <!-- <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div> -->

                <!-- Modal body -->
                <!-- <div class="modal-body">
                    <h6>Escribe tu email y numero de socio y te enviaremos un correo con tu nueva contraseña</h6>
                    <div class="row justify-content-center">
                      <div class="input-group mt-3 mb-3 w-75">
                        <label for="email"class="input-group-text"><img src="<?php echo RUTA_Icon?>email.svg" width="30px"></label>
                        <input type="email" name="email" id="email" class="form-control form-control-md bg-white" placeholder="Email" required>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="input-group mt-3 mb-3 w-75">
                        <label for="socio" class="input-group-text"><img src="<?php echo RUTA_Icon?>usuario.svg" width="30px"></label>
                        <input type="text" name="socio" id="socio" class="form-control form-control-md bg-white" placeholder="Nº socio" required>
                      </div>
                    </div>
                </div> -->
               
                <!-- Modal footer -->
                <!-- <div class="modal-footer">                  
                    <input type="submit" id="confirmar" class="btn" value="Confirmar">     
                </div>
            </form>

          </div>
          </div>
          </div> -->


  </div>
 


    <?php if (isset($datos['error']) && $datos['error'] == 'error_1') : ?>

      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
      </svg>

      <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
          <use xlink:href="#exclamation-triangle-fill" />
        </svg>
        <div><strong>El Email y la contraseña no coinciden.</strong>Intentalo de nuevo.</div>
      </div>

    <?php endif ?>


  <script src="<?php echo RUTA_URL ?>/public/assets/bootstrap/js/bootstrap.min.js"></script>

</body>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>


