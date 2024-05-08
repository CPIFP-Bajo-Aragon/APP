<?php


class Calidad extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['usuarioSesion']->id_rol = obtenerRol($this->datos['usuarioSesion']->roles);
            // La siguiente linea la he comentado yo porque no se cual es el rol 20. Ahora no hay definido este rol
        // $this->datos['rolesPermitidos'] = [20];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->calidadModelo = $this->modelo('CalidadM');
       
    }

    

    public function index(){

        exit;
        $this->datos['modulos'] = $this->calidadModelo->obtener_modulos();
        $this->datos['profes'] = $this->calidadModelo->obtener_profes();
        $this->vista('calidad/inicio', $this->datos);
    }




}