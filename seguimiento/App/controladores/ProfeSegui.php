<?php


class ProfeSegui extends Controlador{

    private $profeModelo;

    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['usuarioSesion']->id_rol = obtenerRol($this->datos['usuarioSesion']->roles);
        //$this->datos['rolesPermitidos'] = [10];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->profeModelo = $this->modelo('ProfesorM');
    }

    

    public function index(){
        $id_profe=$this->datos['usuarioSesion']->id_profesor;

        //obtiene el id del año lectivo
        $this->datos['lectivo']=$this->profeModelo->obtener_lectivo();
        $id_lectivo=$this->datos['lectivo'][0]->id_lectivo;
        $this->datos['evaluacion']=$this->profeModelo->obtener_evaluaciones($id_lectivo);

        // todos los modulos de ese profesor
        $this->datos['modulo']=$this->profeModelo->obtener_modulos($id_profe,$id_lectivo);

        $this->vista('profesores/segui',$this->datos);
    }




    public function segui_modulo($id_modulo){

        $this->datos['lectivo']=$this->profeModelo->obtener_lectivo();
        $id_lectivo=$this->datos['lectivo'][0]->id_lectivo;
        $this->datos['evaluacion']=$this->profeModelo->obtener_evaluaciones($id_lectivo);
        $this->datos['datos_modulo']=$this->profeModelo->datos_modulo($id_modulo,$id_lectivo);

        $this->datos['temas']=$this->profeModelo->obtener_temas($id_modulo);
        $this->datos['festivos']=$this->profeModelo->ver_festivos($id_lectivo);

        $this->vista('profesores/diario',$this->datos);

    }



//******************************** DIARIO DEL MODULO*****************************************/
    public function diario($id_modulo){

        $this->datos['lectivo']=$this->profeModelo->obtener_lectivo();
        $id_lectivo=$this->datos['lectivo'][0]->id_lectivo;
        $this->datos['evaluacion']=$this->profeModelo->obtener_evaluaciones($id_lectivo);
        $this->datos['datos_modulo']=$this->profeModelo->datos_modulo($id_modulo,$id_lectivo);
        
        $this->datos['segui_temas']=$this->profeModelo->obtener_segui_temas($id_modulo);
        $this->datos['festivos']=$this->profeModelo->ver_festivos($id_lectivo);  
        $this->datos['temas']=$this->profeModelo->temas_del_modulo($id_modulo);
        $this->datos['horario_semana']=$this->profeModelo->horario_semana($id_modulo);
        $this->datos['horas_impartidas']=$this->profeModelo->horas_impartidas($id_modulo);
        $this->vista('profesores/diario',$this->datos);

    }



    /**
     * Carga la información en el array datos y los pasa a la vista profesores/informes2
     * (21-06-2024)
     * 
     * @param integer id_modulo id del módulo a mostrar el informe
     */
    public function informes($id_modulo){

        $this->datos['lectivo']=$this->profeModelo->obtener_lectivo();
        $id_lectivo=$this->datos['lectivo'][0]->id_lectivo;
        $this->datos['evaluacion']=$this->profeModelo->obtener_evaluaciones($id_lectivo);
        $this->datos['datos_modulo']=$this->profeModelo->datos_modulo($id_modulo,$id_lectivo);
        
        $this->datos['segui_temas']=$this->profeModelo->obtener_segui_temas($id_modulo);
        $this->datos['festivos']=$this->profeModelo->ver_festivos($id_lectivo);  
        $this->datos['temas']=$this->profeModelo->temas_del_modulo($id_modulo);
        $this->datos['horario_semana']=$this->profeModelo->horario_semana($id_modulo);
        $this->datos['horas_impartidas']=$this->profeModelo->horas_impartidas($id_modulo);

        // (R.Olles 21-06-2024) incluye en datos las horas impartidas que se condieran en el ep1
        $this->datos['horas_impartidas_ep1']=$this->profeModelo->horas_impartidas_a_fecha(date('Y-m-d'), $id_modulo);

        // (R.Olles 21-06-2024) Incluye en datos ep1(Fecha hoy, id_modulo)
        $this->datos['ep1'] = $this->profeModelo->ep1(date('Y-m-d'), $id_modulo);

        // Carga la viasta *** infomres2 ****
        //      A REVISAR. Sigue con vista informe2 o camnbia a informe
        $this->vista('profesores/informes2',$this->datos);

    }

    public function segui_dia(){  
        
        $id_profe=$this->datos['usuarioSesion']->id_profesor;
        $fecha=($_POST['fecha']);
        $id_modulo=$_POST['id_modulo'];


        if($_SERVER['REQUEST_METHOD'] =='POST'){

            if($_POST['festivo']=='festivo'){

                $fecha_sig=explode('-',$fecha);
                $dia_sig= mktime(0, 0, 0, $fecha_sig[1] , $fecha_sig[2]+1, $fecha_sig[0]);
                $dia_siguiente = date ("Y-m-d",$dia_sig);

                redireccionar('/profeSegui/diario/'.$id_modulo.'&'.'fecha='.$dia_siguiente);

            }

            $seg_dia =[
                'id_profe'=>$id_profe,
                'plan'=>$_POST['plan'],
                'act'=>$_POST['act'],
                'observaciones'=>$_POST['observaciones'],
                'fecha'=>$fecha,
                'id_modulo'=>$id_modulo
            ];


                // MONTO LOS OBJETOS
                $array=array();
                $tam=sizeof($_POST['temas']);
                for($i=0;$i<$tam;$i++){
                    $obj=(object) [
                        'tema' => $_POST['temas'][$i],
                        'horas' => $_POST['hrs_dia'][$i]
                    ];
                    array_push($array,$obj);
                };

                // LIMPIO VACIOS Y AÑADO EN $nuevo
                $nuevo= array();
                for($i=0;$i<$tam;$i++){
                    if($array[$i]->horas!='')
                    array_push($nuevo,$array[$i]);
                }

                
                $fecha_sig=explode('-',$fecha);
                $dia_sig= mktime(0, 0, 0, $fecha_sig[1] , $fecha_sig[2]+1, $fecha_sig[0]);
                $dia_siguiente = date ("Y-m-j",$dia_sig);


                $this->profeModelo->segui_dia($seg_dia,$nuevo);
                redireccionar('/profeSegui/diario/'.$id_modulo.'&'.'fecha='.$dia_siguiente);

 
         }else{
         
             $this->vista('profeSegui/diario',$this->datos);
         }

    }


    public function borrar_segui_tema(){


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $borrado=$_POST['borrado'];
                $borrado=explode('&',$borrado);
                $tema=$borrado[0];
                $fecha=$borrado[1];

                $id_modulo=trim($_POST['id_modulo']);

            if ($this->profeModelo->borrar_segui_tema($id_modulo,$tema,$fecha)) {
                redireccionar('/profeSegui/diario/'.$id_modulo);
            }else{
                die('Algo ha fallado!!!');
            }
        }else{

            $this->vista('profesores/segui_modelo', $this->datos);
        }
    }




      //******************************** CUMPLIMIENTO DE LA PROGRAMACION *****************************************/
      public function cumplimiento($eva_mod){

        $this->datos['lectivo']=$this->profeModelo->obtener_lectivo();
        $id_lectivo=$this->datos['lectivo'][0]->id_lectivo;
        $this->datos['evaluacion']=$this->profeModelo->obtener_evaluaciones($id_lectivo);

         $info=explode('-',$eva_mod);
         // $info[0] es el id_evaluacion
         // $info[1] es el id_modulo
        $this->datos['datos_modulo']=$this->profeModelo->datos_modulo($info[1],$id_lectivo);
        $this->datos['id_segui']=$this->profeModelo->obt_id_seguimiento($id_lectivo,$info[0],$info[1]);
        $id_seguimiento=$this->datos['id_segui'][0]->id_seguimiento;

        $this->datos['respuestas_cumplimiento']=$this->profeModelo->obtener_resultados_cumplimiento($id_seguimiento);
        
        $this->datos['e_cumplimiento']=[
            'id_evaluacion'=>$info[0],
            'id_modulo'=>$info[1],
            'id_seguimiento'=>$id_seguimiento

        ];

        $this->datos['preguntas']=$this->profeModelo->obtener_preguntas();

        $this->vista('profesores/cumplimiento',$this->datos);

    }



    public function eva_cumplimiento($id_seguimiento){

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            //recojo todo lo que llega por POST
           $array_respuestas=$_POST;
           //elimino los dos ultimos elementos (id_modulo e id_evaluacion)
           $id_evaluacion=array_pop($array_respuestas);
           $id_modulo=array_pop($array_respuestas);

            foreach($array_respuestas as $res){
                $respuestas[]=explode("-",$res);
            }

            if($this->profeModelo->eva_cumplimiento($respuestas,$id_seguimiento)){
                redireccionar('/profeSegui/cumplimiento/'.$id_evaluacion.'-'.$id_modulo);
            }else{
                die('Algo ha fallado!!');
            }

        }else{

            $this->datos['curso'] = (object)[
                'respuesta'=>''
            ];
       
            $this->vista('direccion/curso',$this->datos);
        }



    }

    //******************************** PROCESO DE ENSEÑANZA *****************************************/
    public function ensenanza($eva_mod){

        $this->datos['lectivo']=$this->profeModelo->obtener_lectivo();
        $id_lectivo=$this->datos['lectivo'][0]->id_lectivo;
        $this->datos['evaluacion']=$this->profeModelo->obtener_evaluaciones($id_lectivo);
        
        $info=explode('-',$eva_mod);
        // $info[0] es el id_evaluacion
        // $info[1] es el id_modulo
        $this->datos['datos_modulo']=$this->profeModelo->datos_modulo($info[1],$id_lectivo);

        $this->datos['id_segui']=$this->profeModelo->obt_id_seguimiento($id_lectivo,$info[0],$info[1]);
        $id_seguimiento=$this->datos['id_segui'][0]->id_seguimiento;
        
        $this->datos['respuestas_ensenanza']=$this->profeModelo->obtener_resultados_ensenanza($id_seguimiento);
        
        $this->datos['e_ensenanza']=[
            'id_evaluacion'=>$info[0],
            'id_modulo'=>$info[1],
            'id_seguimiento'=>$id_seguimiento

        ];

        $this->vista('profesores/ensenanza',$this->datos);
    }



    public function eva_ensenanza($id_seguimiento){
    

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $evaluacion = [
                'matriculados' => trim($_POST['matriculados']),
                'excep' => trim($_POST['excep']),
                'efectivos'=> trim($_POST['efectivos']),
                'horas_alumno' => trim($_POST['horas_alumno']),
                'faltas' => trim($_POST['faltas']),
                'interes'=> trim($_POST['interes']),
                'comportamiento' => trim($_POST['comportamiento']),
                'puntualidad' => trim($_POST['puntualidad']),
                'limpieza'=> trim($_POST['limpieza']),
                'horas' => trim($_POST['horas']),
                'faltas_profe' => trim($_POST['faltas_profe']),
                'faltas_otros'=> trim($_POST['faltas_otros']),
                'evaluados' => trim($_POST['evaluados']),
                'aprobados'=> trim($_POST['aprobados'])
            ];
          
               if($this->profeModelo->update_eva_ensenanza($evaluacion,$id_seguimiento)){
                    redireccionar('/profeSegui/ensenanza/'.$_POST['id_evaluacion'].'-'.$_POST['id_modulo']);
               }
                
        }else{

            $this->datos['curso'] = (object)[
                'nombre'=>'',
                'fecha_ini'=>'',
                'fecha_fin'=>''
            ];
       
            $this->vista('direccion/curso',$this->datos);
        }

    }
    




    //******************************** DATOS MODULO *****************************************/
    public function datos_modulo($id_modulo){

        $this->datos['lectivo']=$this->profeModelo->obtener_lectivo();
        $id_lectivo=$this->datos['lectivo'][0]->id_lectivo;

        //$this->datos['temas']=$this->profeModelo->obtener_temas($id_modulo);
        //$this->datos['festivos']=$this->profeModelo->ver_festivos($id_lectivo);

        $this->datos['evaluacion']=$this->profeModelo->obtener_evaluaciones($id_lectivo);
        $this->datos['datos_modulo']=$this->profeModelo->datos_modulo($id_modulo,$id_lectivo);

        // todos los temas del modulo
        $this->datos['tem']=$this->profeModelo->temas_del_modulo($id_modulo);

        $this->datos['horario_modulo']=$this->profeModelo->obtener_horario_modulo($id_modulo);


        $this->vista('profesores/datos',$this->datos);

    }

    public function horas_dia($id_modulo){
    $registros=$this->profeModelo->obtener_registros($id_modulo);
  
        if($_SERVER['REQUEST_METHOD'] =='POST'){

            $lunes=(object)[
                'dia'=>'1',
                'horas'=>$_POST['horas'][0]
            ];
            $martes=(object)[
                'dia'=>'2',
                'horas'=>$_POST['horas'][1]
            ];
            $miercoles=(object)[
                'dia'=>'3',
                'horas'=>$_POST['horas'][2]
            ];
            $jueves=(object)[
                'dia'=>'4',
                'horas'=>$_POST['horas'][3]
            ];
            $viernes=(object)[
                'dia'=>'5',
                'horas'=>$_POST['horas'][4]
            ];

            $dias=[$lunes,$martes,$miercoles,$jueves,$viernes];


            if($registros==0){
                $this->profeModelo->horas_dia($dias,$id_modulo);
                redireccionar('/profeSegui/datos_modulo/'.$id_modulo);
            }else{
                $this->profeModelo->actualizar_horas_dia($dias,$id_modulo);
                redireccionar('/profeSegui/datos_modulo/'.$id_modulo);
            }

        }else{
       
            $this->vista('profesores/datos',$this->datos);
        }

  }

          
    
    
    
    public function nuevo_tema($id_modulo){

        $this->datos['rolesPermitidos'] = [10];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }


        if($_SERVER['REQUEST_METHOD'] =='POST'){

            $tam=sizeof($_POST['numero']);
            $nuevo=array();
            for($i=0;$i<$tam;$i++){
                $tema = [
                    'id_modulo'=> $id_modulo,
                    'tema' => trim($_POST['numero'][$i]),
                    'nombre' => trim($_POST['nombre'][$i]),
                    'horas'=> trim($_POST['horas'][$i])
                ];  
                array_push($nuevo,$tema);
            }
        
  
            if($this->profeModelo->nuevo_tema($nuevo)){
                redireccionar('/profeSegui/datos_modulo/'.$id_modulo);
            }else{
                die('Algo ha fallado!!');
            }

        }else{

            $this->datos['tema'] = (object)[
                'tema'=>'',
                'horas_tema'=>'',
                'descripcion'=>''
            ];
       
            $this->vista('profesores/segui_modelo',$this->datos);
        }

    }

    public function borrar_tema($id_tema){

        $this->datos['rolesPermitidos'] = [10];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_modulo=$_POST['id_modulo'];
            if ($this->profeModelo->borrar_tema($id_modulo,$id_tema)) {
                redireccionar('/profeSegui/datos_modulo/'.$id_modulo);
            }else{
                die('Algo ha fallado!!!');
            }
        }else{

            $this->vista('profesores/segui_modelo', $this->datos);
        }
    }


    public function editar_tema(){

        $this->datos['rolesPermitidos'] = [10];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $tema = [
                'id_modulo'=> trim($_POST['id_modulo']),
                'tema' => trim($_POST['id_tema']),
                'horas_tema' => trim($_POST['horas_tema']),
                'descripcion'=> trim($_POST['descripcion'])
            ];

            if($this->profeModelo->editar_tema($tema)){
                redireccionar('/profeSegui/datos_modulo/'.$_POST['id_modulo']);
            }else{
                die('Algo ha fallado!!');
            }

        }else{
            $this->vista('profesores/segui_modelo',$this->datos);
        }

    }



}