<?php

class Informes extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['usuarioSesion']->id_rol = obtenerRol($this->datos['usuarioSesion']->roles);
        $this->datos['rolesPermitidos'] = [10];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->profeModelo = $this->modelo('ProfesorM');
       
    }

    

    public function index($id_modulo){

        $this->datos['lectivo']=$this->profeModelo->obtener_lectivo();
        $id_lectivo=$this->datos['lectivo'][0]->id_lectivo;
        $this->datos['evaluacion']=$this->profeModelo->obtener_evaluaciones($id_lectivo);
        $this->datos['datos_modulo']=$this->profeModelo->datos_modulo($id_modulo,$id_lectivo);
        

        $this->vista('profesores/informes', $this->datos);
    }




}