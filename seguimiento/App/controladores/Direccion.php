<?php

class Direccion extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['usuarioSesion']->id_rol = obtenerRol($this->datos['usuarioSesion']->roles);
       // $this->datos['rolesPermitidos'] = [50];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }
        $this->direccionModelo = $this->modelo('DireccionM');
       
    }

    

    // public function index(){

    //     $this->datos['curso'] = $this->direccionModelo->obtener_cursos();
    //     $this->datos['lectivo']=$this->direccionModelo->obtener_lectivo();
    //     $id=$this->datos['lectivo'][0]->id_lectivo;

    //     $this->datos['evaluacion']=$this->direccionModelo->obtener_evaluaciones($id);


    //     $this->vista('direccion/inicio', $this->datos);
    // }



    public function index(){
        $this->datos['curso'] = $this->direccionModelo->obtener_cursos();
        $this->datos['lectivo']=$this->direccionModelo->obtener_lectivo();
        $id=$this->datos['lectivo'][0]->id_lectivo;

        $this->datos['evaluacion']=$this->direccionModelo->obtener_evaluaciones($id);

        $this->datos['festivos']=$this->direccionModelo->ver_festivos_curso($id);
        $this->vista('direccion/curso', $this->datos);

        $this->vista('direccion/curso', $this->datos);
    }


    public function nuevo_curso(){

        $this->datos['rolesPermitidos'] = [50];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }


        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $nuevo = [
                'nombre' => trim($_POST['nombre']),
                'fecha_ini' => trim($_POST['fecha_ini']),
                'fecha_fin'=> trim($_POST['fecha_fin']),
                'primera'=>trim($_POST['primera']),
                'primera_ini'=>trim($_POST['primera_ini']),
                'primera_fin'=>trim($_POST['primera_fin']),
                'segunda'=>trim($_POST['segunda']),
                'segunda_ini'=>trim($_POST['segunda_ini']),
                'segunda_fin'=>trim($_POST['segunda_fin']),
                'final'=>trim($_POST['final']),
                'final_ini'=>trim($_POST['final_ini']),
                'final_fin'=>trim($_POST['final_fin'])
            ];
          
            if($this->direccionModelo->nuevo_curso($nuevo)){
                redireccionar('/direccion/curso');
            }else{
                die('Algo ha fallado!!');
            }

        }else{

            $this->datos['curso'] = (object)[
                'nombre'=>'',
                'fecha_ini'=>'',
                'fecha_fin'=>'',
                'primera'=>'',
                'primera_ini'=>'',
                'primera_fin'=>'',
                'segunda'=>'',
                'segunda_ini'=>'',
                'segunda_fin'=>'',
                'final'=>'',
                'final_ini'=>'',
                'final_fin'=>''
            ];
       
            $this->vista('direccion/curso',$this->datos);
        }

    }


    public function borrar($id){

        $this->datos['rolesPermitidos'] = [50];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->direccionModelo->borrar_curso($id)) {
                redireccionar('/direccion/curso');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{

            $this->vista('direccion/curso', $this->datos);
        }
    }


    public function editar_curso($id_curso){

        $this->datos['rolesPermitidos'] = [50];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $editar = [
                'nombre' => trim($_POST['nombre']),
                'fecha_ini' => trim($_POST['fecha_ini']),
                'fecha_fin'=> trim($_POST['fecha_fin']),
                'primera'=>trim($_POST['primera']),
                'primera_ini'=>trim($_POST['primera_ini']),
                'primera_fin'=>trim($_POST['primera_fin']),
                'segunda'=>trim($_POST['segunda']),
                'segunda_ini'=>trim($_POST['segunda_ini']),
                'segunda_fin'=>trim($_POST['segunda_fin']),
                'final'=>trim($_POST['final']),
                'final_ini'=>trim($_POST['final_ini']),
                'final_fin'=>trim($_POST['final_fin'])
            ];


            if($this->direccionModelo->editar_curso($editar,$id_curso,($_POST['id_primera']),($_POST['id_segunda']),($_POST['id_final']))){
                redireccionar('/direccion/curso');
            }else{
                die('Algo ha fallado!!');
            }

        }else{
       
            $this->vista('direccion/curso',$this->datos);
        }

    }


    public function nuevo_festivo($id_curso){

        $this->datos['rolesPermitidos'] = [50];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){

            $nuevo = [
                'festivo' => ($_POST['festivo']),
                'fecha' => ($_POST['fecha'])
            ];

            if($this->direccionModelo->nuevo_festivo($nuevo,$id_curso)){
                redireccionar('/direccion/curso');
            }else{
                die('Algo ha fallado!!');
            }

        }else{

            $this->datos['festivo'] = (object)[
                'festivo'=>'',
                'fecha'=>'',
            ];
       
            $this->vista('direccion/curso',$this->datos);
        }

    }

  

    public function borrar_festivo($id){
        $this->datos['rolesPermitidos'] = [50];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->direccionModelo->borrar_festivo($id)) {
                redireccionar('/direccion/curso');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{

            $this->vista('direccion/curso', $this->datos);
        }
    }


  



}