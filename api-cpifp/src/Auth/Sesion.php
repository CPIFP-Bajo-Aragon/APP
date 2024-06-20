<?php
    namespace App\Auth;
    
    class Sesion{

        public static function crearSesion($usuarioSesion) {
            $sessionTime = 60 * 60;                  // 1 hora de duración
            session_set_cookie_params($sessionTime);
            session_start();
            session_regenerate_id();                            // Para crear un id de sesion distinto al antiguo
            $_SESSION["usuarioSesion"] = $usuarioSesion;
            
        }


        // public static function iniciarSesion(&$datos = []) {
        //     session_start();
        //     if (isset($_SESSION["usuarioSesion"])){
        //         $datos['usuarioSesion'] = $_SESSION["usuarioSesion"];       // pasamos por referencia los datos de la sesion
        //     } else {
        //         session_destroy();
        //         redireccionar('/login/');
        //     }
        // }


        public static function sesionCreada() {
            session_start();
            if (isset($_SESSION["usuarioSesion"])){
                return true;
            } else {
                return false;
            }
        }


        // public static function cerrarSesion() {        
        //     session_start();                    // no seria necesaria esta linea, pero por asegurarnos en futuros usos
        //     setcookie(session_name(), '', time() -3600, "/");
        //     session_unset();
        //     session_destroy();
        //     $_SESSION = array();
        // }
    }

