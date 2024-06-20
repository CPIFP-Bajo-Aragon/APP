<!DOCTYPE html>
<html lang="es">
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
                    <label for="email" class="input-group-text bg-white"><img src="<?php echo RUTA_Icon?>usuario.svg" width="30px"></label>
                    <input type="text" name="email" id="email" class="form-control form-control-md bg-white" placeholder="Login" required>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="input-group mb-4 w-75">
                    <label for="passw"class="input-group-text bg-white"><img src="<?php echo RUTA_Icon?>llave.svg" width="30px"></label>
                    <input type="password" name="passw" id="passw" class="form-control form-control-md" placeholder="Password" required>               
                </div>
            </div> 
                
            <div class="d-flex justify-content-center" >          
                <button type="submit" class="btn boton w-75"><img src="<?php echo RUTA_Icon?>candado.png" width="35px">Login</button>                         
            </div>
            
            <div class="text-center">
                <a href="#!" data-bs-toggle="modal" data-bs-target="#modalRecuperar">
                    Recordar Contraseña
                </a>
            </div>
        </form>
    </div>
 

    <!-- ++++++++++++++++++++++++++++ Modal Editar Accion +++++++++++++++++++++++++++++++++ -->

    <div class="modal fade" id="modalRecuperar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRecuperarLabel">
                        Recuperar Contraseña
                    </h5>
                </div>

                <div class="modal-body">
                    <form method="post" id="formRecuperarEmail" name="formRecuperarEmail" 
                        action="javascript:recuperarEmail()"
                    >
                        <div class="row mx-5">
                            <div class="mb-3 col-12">
                                <label for="email_login" class="form-label">Email*</label>
                                <input 
                                    type="email" 
                                    class="form-control form-control-sm" 
                                    id="email_login" name="email_login" required
                                >
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" 
                        data-bs-dismiss="modal">Cancelar
                    </button>
                    <button type="submit" form="formRecuperarEmail" class="btn btn-warning" id="buttonEditar">
                        Recuperar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ++++++++++++++++++++++++++++++++++++++++ Toast de Validacion Asincrona ++++++++++++++++++ -->

<div class="toast-container position-fixed bottom-0 end-0 p-3 m-4" style="z-index: 11">
    <div id="toastOK" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class="toast-header">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="green">
                </rect>
            </svg>
            <strong class="me-auto">Revise su correo con nueva Contraseña.</strong>
        </div>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3 m-4" style="z-index: 11">
    <div id="toastKO" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class="toast-header">
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="red">
                </rect>
            </svg>
            <strong class="me-auto">Error --- Email Incorrecto !!!</strong>
        </div>
    </div>
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


  <!-- <script src="<?php echo RUTA_URL ?>/public/assets/bootstrap/js/bootstrap.min.js"></script> -->



<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>

<script>
    localStorage.removeItem("userStorage")  // Limpiamos la variable de nuxt para hacer logaut de la aplicacion mantenimiento
</script>

<script>

    async function recuperarEmail(){
        const datosForm = new FormData(document.getElementById("formRecuperarEmail"))

        await fetch(`<?php echo RUTA_URL?>/login/recuperar_pass`, {
            method: "POST",
            body: datosForm,
        })
            .then((resp) => resp.json())
            .then(function(data) {
                if(data){
                    // Mostamos mensaje de exito
                    const toast = document.getElementById("toastOK")
                    const bootToast = new bootstrap.Toast(toast)
                    bootToast.show()

                    const toastKO = document.getElementById("toastKO")  // ocultamos por si ha sido mostrada
                    const bootToastKO = new bootstrap.Toast(toastKO)
                    bootToastKO.hide()
                } else {
                    // Mostramos mensaje de error
                    const toast = document.getElementById("toastKO")
                    const bootToast = new bootstrap.Toast(toast)
                    bootToast.show()
                }

                // Cerrar el modal
                let myModalEl = document.getElementById('modalRecuperar')
                let myModal = bootstrap.Modal.getInstance(myModalEl)
                myModal.hide()

            })
            .catch((error) => {
                const toast = document.getElementById("toastKO")
                const bootToast = new bootstrap.Toast(toast)
                bootToast.show()

                // Cerrar el modal
                let myModalEl = document.getElementById('modalRecuperar')
                let myModal = bootstrap.Modal.getInstance(myModalEl)
                myModal.hide()
            })
    }

</script>
