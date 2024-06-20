<?php

class Controladorborrar extends Controlador{



    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        
        
        $this->datos['usuarioSesion']->id_rol = obtenerRol($this->datos['usuarioSesion']->roles);
        $this->datos['rolesPermitidos'] = [50];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->profeModelo = $this->modelo('ProfesorM');
    }

    

    public function index(){

        echo "fff";
    }

    public function nuevoMetodo($a=0){

        // print_r($this->datos);

        $this->datos['lectivo']=$this->profeModelo->obtener_lectivo();

        $this->vista('profesores/profesores_borrar',$this->datos);

    }


}