<?php


class JefeDep extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['usuarioSesion']->id_rol = obtenerRol($this->datos['usuarioSesion']->roles);
       // $this->datos['rolesPermitidos'] = [30];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->jefeDepModelo = $this->modelo('JefeDepM');
       
    }

    

    // public function index(){
   
    //     $this->vista('jefeDep/inicio', $this->datos);
    // }


    public function index(){





        $id=$this->datos['usuarioSesion']->id_profesor;
        $datos = $this->jefeDepModelo->obtenerDatosId($id);
        $id_dep=$datos[0]->id_departamento;

        //$this->datos['modulos'] = $this->jefeDepModelo->obtener_modulos($id_dep);
        $this->datos['grados']= $this->jefeDepModelo->obtener_grados($id_dep);
        $this->datos['cursos']= $this->jefeDepModelo->obtener_ciclos_cursos($id_dep);

        $this->datos['asignaturas'] = $this->jefeDepModelo->obtener_asignaturas($id_dep);
        $this->datos['profes'] = $this->jefeDepModelo->obtener_profes($id_dep);
        $this->datos['prof_mod']=$this->jefeDepModelo->horas_profes_modulo($id_dep);

       
      // $this->datos['profes'] = $this->jefeDepModelo->obtener_profes($id_dep);
       //$this->datos['prof_mod']=$this->jefeDepModelo->prof_mod($id_dep);
       $this->datos['lectivo']=$this->jefeDepModelo->obtener_lectivo();
       

       $this->vista('jefeDep/grados', $this->datos);
   }


   
    public function reparto($id){

        $ciclo=explode('-',$id);
        $id_curso=$ciclo[0];
        $id_ciclo=$ciclo[1];

        $id=$this->datos['usuarioSesion']->id_profesor;
        $datos = $this->jefeDepModelo->obtenerDatosId($id);
        $id_dep=$datos[0]->id_departamento;

        //$this->datos['modulos'] = $this->jefeDepModelo->obtener_modulos($id_dep);
        $this->datos['grados']= $this->jefeDepModelo->obtener_grados($id_dep);
        $this->datos['cursos']= $this->jefeDepModelo->obtener_ciclos_cursos($id_dep);

        $this->datos['ciclo_id']= $this->jefeDepModelo->obtener_ciclo_id($id_ciclo);
        $this->datos['asignaturas'] = $this->jefeDepModelo->obtener_modulos_curso_ciclo($id_dep,$id_curso,$id_ciclo);
        $this->datos['profes'] = $this->jefeDepModelo->obtener_profes($id_dep);
        $this->datos['prof_mod']=$this->jefeDepModelo->horas_profes_modulo($id_dep);
        $this->datos['lectivo']=$this->jefeDepModelo->obtener_lectivo();


       $this->vista('jefeDep/reparto', $this->datos);
   }



   public function insertar_modulo($id_modulo){

    
    $id=$this->datos['usuarioSesion']->id_profesor;
    
    $datos = $this->jefeDepModelo->obtenerDatosId($id);
    
    $id_dep=$datos[0]->id_departamento;
    
    $registros=$this->jefeDepModelo->registros($id_dep,$id_modulo);
    
    $numero_registros=count($registros);
    
        $array=array();
        $tam=sizeof($_POST['profes']);
        for($i=0;$i<$tam;$i++){
            $obj=(object) [
                'profe' => $_POST['profes'][$i],
                'horas' => $_POST['horas'][$i],
            ];
            
            array_push($array,$obj);
        };

        $lectivo=$_POST['lectivo'];
        
        $evas=$this->jefeDepModelo->obtener_evas($lectivo); 
               

         if($numero_registros==0){
            $this->jefeDepModelo->insertar_modulo($id_modulo,$array,$lectivo,$evas);
            redireccionar('/jefeDep/grados');
        }else{
            $this->jefeDepModelo->actualizar_modulo($id_modulo,$array,$lectivo,$evas);
            redireccionar('/jefeDep/grados');
        }

  }



}