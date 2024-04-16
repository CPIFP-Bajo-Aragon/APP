<?php

class Login extends Controlador
{
    public function __construct()
    {
        $this->loginModelo = $this->modelo('LoginModelo');
    }


    public function index($error = '')
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->datos['email'] = trim($_POST['email']);
            $this->datos['passw'] = trim($_POST['passw']);

            $usuarioSesion = $this->loginModelo->loginEmail($this->datos['email'], $this->datos['passw']);  // obtenemos profesor
    
            if (isset($usuarioSesion) && !empty($usuarioSesion)) { 
                $usuarioSesion->roles = $this->loginModelo->getRolesProfesor($usuarioSesion->id_profesor);  // obtenemos sus roles  
                Sesion::crearSesion($usuarioSesion);
                redireccionar('/');
            } else {
                redireccionar('/login/index/error_1');
            }
        } else {
            if (Sesion::sesionCreada($this->datos)) {    
                redireccionar('/inicio');
            } else {
                $this->datos['error'] = $error;
                $this->vista('login', $this->datos);
            }
        }
    }

    
    public function logout(){
        Sesion::iniciarSesion($this->datos);        // controlamos si no esta iniciada la sesion y cogemos los datos de la sesion
        // $this->loginModelo->registroFinSesion($this->datos['usuarioSesion']->id_usuario);       // registramos fecha cierre de sesion
        Sesion::cerrarSesion();
        redireccionar('/');
    }


    public function recuperar_pass(){
        $email = trim($_POST['email_login']);

        $nuevoPass = generarCadenaAleatoria(10);
        $existeEmail = $this->loginModelo->regenerarPass($nuevoPass,$email);

        if ($existeEmail){
            emailNuevoPassword($email,$nuevoPass);
        }

        $this->vistaApi($existeEmail);
    }
   



}
