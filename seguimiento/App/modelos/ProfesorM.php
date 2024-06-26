<?php

class ProfesorM{
    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function obtener_lectivo(){
        $this->db->query("SELECT * from segui_lectivo where fecha_ini<CURDATE() and fecha_fin>CURDATE();");
       return $this->db->registros();
    }

    public function obtener_evaluaciones($id_lectivo){
        $this->db->query("SELECT * from segui_evaluacion where id_lectivo=:id;");
        $this->db->bind(':id',$id_lectivo);
       return $this->db->registros();
    }



    public function obtener_modulos($id_profe,$id_lectivo){
         $this->db->query("SELECT * FROM segui_departamento_modulo,segui_profesor_modulo 
                                    where segui_profesor_modulo.id_modulo=segui_departamento_modulo.id_modulo 
                                            and segui_profesor_modulo.id_profesor=:id_profe 
                                            and id_lectivo=:id_lectivo");
         $this->db->bind(':id_profe',$id_profe);
         $this->db->bind(':id_lectivo',$id_lectivo);
         return $this->db->registros();
    }



    public function datos_modulo($id_modulo,$id_lectivo){
       // echo $id_lectivo;
       // exit;
        $this->db->query("SELECT * FROM segui_profesor_modulo 
                                    where segui_profesor_modulo.id_modulo=:id_modulo 
                                            and id_lectivo=:id_lectivo");
        $this->db->bind(':id_modulo',$id_modulo);
        $this->db->bind(':id_lectivo',$id_lectivo);
        return $this->db->registros();
   }


   //***************************** DIARIO ********************************/
   
     
   /**
    * Calcula las horas impartidas de un módulo a una fecha.
    * (R.Olles 21-06-2024)
    *
    * @ param string $fecha  Fecha a la que calcular las horas impartidas.
    * @ param integer $id_modulo id del módulo sobre que que calcular las horas impartidas.
    * @ return integer horas impartidas
    */
    public function horas_impartidas_a_fecha($fecha, $id_modulo)
    {

      // Consulta. 
      //   De devuelve las horas impartidas para un id_modulo y hasta una fecha dada
      //   Comprueba que la fecha esté dentro del año académico
      //   Comprueba que las horas impartidas por tema no sea mayor que las programadas. Si es mayor se elige las horas programadas.
       $consulta = "
          SELECT SUM(Total_H_Impart) AS horas
             FROM(
             SELECT 
                md.id_modulo, 
                tm.tema,
                tm.total_horas AS Total_H_Progr,
                IF (SUM(sg_tm.horas_dia) > tm.total_horas, tm.total_horas, SUM(sg_tm.horas_dia)) AS Total_H_Impart
 
                FROM cpifp_modulo md  
                   JOIN segui_tema tm ON md.id_modulo = tm.id_modulo
                   JOIN segui_profesor_tema sg_tm ON tm.id_tema = sg_tm.id_tema
                
                WHERE
                   md.id_modulo = :id_modulo 
                   AND sg_tm.fecha < :fecha
                   AND (
                      IF ( MONTH (:fecha) >= 9,
                         sg_tm.fecha > DATE_FORMAT(:fecha, '%Y-09-01'),
                         sg_tm.fecha > DATE_FORMAT(DATE_SUB(:fecha, INTERVAL 1 YEAR), '%Y-09-01')
                         )
                      )
                      
                GROUP BY 
                   md.id_modulo, 
                   tm.tema, 
                   tm.total_horas
                   
             ) AS subconsulta
                GROUP BY 
                   subconsulta.id_modulo;
          ";
 
       $this->db->query($consulta);
 
       $this->db->bind(':fecha', $fecha);
       $this->db->bind(':id_modulo', $id_modulo);

       return $this->db->registros()[0]->horas;
    }
 
    /**
     * Calculo del EP1 de un módulo a una fecha
     *    EP1 = Horas Impartidas / Horas Lectivas
     * (R.Olles 21-06-2024)
     *
     * @ param string $fecha  Fecha a la que calcular ep1
     * @ param integer $id_modulo id del módulo sobre que que calcular ep1
     * @ return integer horas impartidas
     */
    public function ep1 ($fecha, $id_modulo)
    {
       $horas_lectivas_a_fecha = Indicador::horasHastaFecha( $fecha, $id_modulo ); 
       $horas_impartidas = $this->horas_impartidas_a_fecha($fecha, $id_modulo);
       
       return $horas_impartidas / $horas_lectivas_a_fecha * 100;
    }
 


   public function horas_impartidas($id_modulo){
      $this->db->query("SELECT sum(horas_dia) as horas_tema, id_tema,id_modulo 
                            from segui_profesor_tema where id_modulo=:id_modulo group by id_tema;");
      $this->db->bind(':id_modulo',$id_modulo);
      return $this->db->registros();
   }
  

   public function horario_semana($id_modulo){
      $this->db->query("SELECT segui_horario.id_horario,segui_horario.dia_sem, 
                                segui_horario_modulo.id_modulo, segui_horario_modulo.total_horas
                            from segui_horario,segui_horario_modulo 
                            where segui_horario.id_horario=segui_horario_modulo.id_horario 
                                and id_modulo=:id_modulo");
      $this->db->bind(':id_modulo',$id_modulo);
      return $this->db->registros();
   }
  
   public function ver_festivos($id){
      $this->db->query("SELECT * FROM segui_festivo where id_lectivo=:id;");
      $this->db->bind(":id",$id);
      return $this->db->registros();
     }
  
   public function obtener_segui_temas($id_modulo){
      $this->db->query("SELECT * FROM segui_profesor_tema, segui_tema 
                                where segui_profesor_tema.id_modulo=:id_modulo 
                                    and segui_tema.id_tema=segui_profesor_tema.id_tema;");
      $this->db->bind(":id_modulo",$id_modulo);
      return $this->db->registros();
   }

   public function obtener_segui_un_dia($id_modulo,$fecha){
      $this->db->query("SELECT * FROM segui_profesor_tema where id_modulo=:id_modulo and fecha=:fecha;");
      $this->db->bind(":id_modulo",$id_modulo);
      $this->db->bind(":fecha",$fecha);
      return $this->db->registros();
   }
   


   public function segui_dia($seg_dia,$array){
       //var_dump($seg_dia);
       // var_dump($array);
       // exit;

      $this->db->query("SELECT * FROM segui_profesor_tema where id_modulo=:id_modulo and fecha=:fecha;");
      $this->db->bind(":id_modulo",$seg_dia['id_modulo']);
      $this->db->bind(":fecha",$seg_dia['fecha']);
      $registros=$this->db->registros();
      $reg=count($registros);

      if ($reg>0){
         $this->db->query("DELETE FROM segui_profesor_tema where id_modulo=:id_modulo and fecha=:fecha;");
         $this->db->bind(":id_modulo",$seg_dia['id_modulo']);
         $this->db->bind(":fecha",$seg_dia['fecha']);
         $this->db->execute();
      }

  

   

      $tam=sizeof($array);

      if ($tam>0){

         foreach($array as $datos){

            $tema=$datos->tema;
            $horas=$datos->horas;

            $this->db->query("INSERT INTO segui_profesor_tema (id_profesor, id_tema, id_modulo, fecha, horas_dia, 
                                                                    plan, actividad, observaciones)
                                                    values (:id_profe, :id_tema, :id_modulo, :fecha, :hrs_dia, 
                                                                    :plan, :actividad, :observaciones);");

            $this->db->bind(':id_tema',$tema);         
            $this->db->bind(':hrs_dia',$horas);
            
            $this->db->bind(':id_modulo',$seg_dia['id_modulo']);
            $this->db->bind(':fecha',$seg_dia['fecha']);
            $this->db->bind(':id_profe',$seg_dia['id_profe']);

      
            // if($seg_dia['actividades']!=null){
            //    $this->db->bind(':otras_act',$seg_dia['actividades']);
            // }else{
            //    $this->db->bind(':otras_act',null);
            // }
      
            // if($seg_dia['faltas']!=null){
            //    $this->db->bind(':faltas_profes',$seg_dia['faltas']);
            // }else{
            //    $this->db->bind(':faltas_profes',null);
            // }
      
            // if($seg_dia['otros']!=null){
            //    $this->db->bind(':otros_mot',$seg_dia['otros']);
            // }else{
            //    $this->db->bind(':otros_mot',null);
            // }
      
            if($seg_dia['plan']!=null){
               $this->db->bind(':plan',$seg_dia['plan']);
            }else{
               $this->db->bind(':plan',null);
            }
      
            if($seg_dia['act']!=null){
               $this->db->bind(':actividad',$seg_dia['act']);
            }else{
               $this->db->bind(':actividad',null);
            }
      
            if($seg_dia['observaciones']!=null){
               $this->db->bind(':observaciones',$seg_dia['observaciones']);
            }else{
               $this->db->bind(':observaciones', null);
            }

            $this->db->execute();
         }        

      }else{

         $this->db->query("INSERT INTO segui_profesor_tema (id_profesor, id_tema, id_modulo, fecha, horas_dia, 
                                                            plan, actividad, observaciones)
                                                    values (:id_profe, -1 , :id_modulo, :fecha, 0 , 
                                                            :plan, :actividad, :observaciones);");

         $this->db->bind(':id_profe',$seg_dia['id_profe']);
         $this->db->bind(':id_modulo',$seg_dia['id_modulo']);
         $this->db->bind(':fecha',$seg_dia['fecha']);
         

         // if($seg_dia['actividades']!=null){
         //    $this->db->bind(':otras_act',$seg_dia['actividades']);
         // }else{
         //    $this->db->bind(':otras_act',null);
         // }

         // if($seg_dia['faltas']!=null){
         //    $this->db->bind(':faltas_profes',$seg_dia['faltas']);
         // }else{
         //    $this->db->bind(':faltas_profes',null);
         // }

         // if($seg_dia['otros']!=null){
         //    $this->db->bind(':otros_mot',$seg_dia['otros']);
         // }else{
         //    $this->db->bind(':otros_mot',null);
         // }

         if($seg_dia['plan']!=null){
            $this->db->bind(':plan',$seg_dia['plan']);
         }else{
            $this->db->bind(':plan',null);
         }

         if($seg_dia['act']!=null){
            $this->db->bind(':actividad',$seg_dia['act']);
         }else{
            $this->db->bind(':actividad',null);
         }

         if($seg_dia['observaciones']!=null){
            $this->db->bind(':observaciones',$seg_dia['observaciones']);
         }else{
            $this->db->bind(':observaciones', null);
         }

         $this->db->execute();

      }

     return true;
   }





   public function editar_segui_dia($seg_dia,$array){

      $this->db->query("UPDATE segui_profesor_tema SET id_profesor=:id_profe, examenes=:examenes, 
                                                        otras_act=:otras_act, faltas_profes=:faltas_profes, 
                                                        otros_mot=:otros_mot, plan=:plan, actividad=:actividad, 
                                                        observaciones=:observaciones 
                                        where id_modulo=:id_modulo and fecha=:fecha;");

      $this->db->bind(':id_profe',$seg_dia['id_profe']);
      $this->db->bind(':id_modulo',$seg_dia['id_modulo']);
      $this->db->bind(':fecha',$seg_dia['fecha']);
      
      if($seg_dia['examenes']!=null){
         $this->db->bind(':examenes',$seg_dia['examenes']);
      }else{
         $this->db->bind(':examenes',null);
      }

      if($seg_dia['actividades']!=null){
         $this->db->bind(':otras_act',$seg_dia['actividades']);
      }else{
         $this->db->bind(':otras_act',null);
      }

      if($seg_dia['faltas']!=null){
         $this->db->bind(':faltas_profes',$seg_dia['faltas']);
      }else{
         $this->db->bind(':faltas_profes',null);
      }

      if($seg_dia['otros']!=null){
         $this->db->bind(':otros_mot',$seg_dia['otros']);
      }else{
         $this->db->bind(':otros_mot',null);
      }

      if($seg_dia['plan']!=null){
         $this->db->bind(':plan',$seg_dia['plan']);
      }else{
         $this->db->bind(':plan',null);
      }

      if($seg_dia['act']!=null){
         $this->db->bind(':actividad',$seg_dia['act']);
      }else{
         $this->db->bind(':actividad',null);
      }

      if($seg_dia['observaciones']!=null){
         $this->db->bind(':observaciones',$seg_dia['observaciones']);
      }else{
         $this->db->bind(':observaciones', null);
      }

      $this->db->execute();


      foreach ($array as $datos){
         if($datos->horas!=null){
            $tema=$datos->tema;
            $horas=$datos->horas;
            $this->db->query("UPDATE segui_profesor_tema set id_tema=:id_tema, horas_dia=:hrs_dia 
                                    where id_modulo=:id_modulo and fecha=:fecha;"); 

            $this->db->bind(':id_tema',$tema);         
            $this->db->bind(':hrs_dia',$horas);
            $this->db->bind(':id_modulo',$seg_dia['id_modulo']);
            $this->db->bind(':fecha',$seg_dia['fecha']);

            $this->db->execute();

         }else{

            $this->db->query("DELETE FROM segui_profesor_tema 
                                    where id_modulo=:modulo and id_tema=:tema and fecha=:fecha;");
            $this->db->bind(':modulo',$seg_dia['id_modulo']);
            $this->db->bind(':tema',$tema);
            $this->db->bind(':fecha',$seg_dia['fecha']);
            $this->db->execute();


         }
      }

     return true;

   }



public function borrar_segui_tema($id_modulo,$tema,$fecha){
    $this->db->query("DELETE FROM segui_profesor_tema where id_modulo=:modulo and id_tema=:tema and fecha=:fecha;");
    $this->db->bind(':modulo',$id_modulo);
    $this->db->bind(':tema',$tema);
    $this->db->bind(':fecha',$fecha);

    if ($this->db->execute()){
      return true;
  }else{
      return false;
  }

 
}

public function borrar_segui_completo($id_modulo){
   $this->db->query("DELETE FROM segui_profesor_tema where id_modulo=:modulo;");
   $this->db->bind(':modulo',$id_modulo);


   if ($this->db->execute()){
     return true;
 }else{
     return false;
 }


}




  


//---------------------------- DATOS DEL MODULO  ---------------------------------//




public function temas_del_modulo($id_modulo){
   $this->db->query("SELECT * FROM segui_tema where id_modulo=:id_modulo ORDER BY tema");
   $this->db->bind(':id_modulo',$id_modulo);
   return $this->db->registros();
}



public function nuevo_tema($nuevo){

   $this->db->query("SELECT * FROM segui_tema where id_modulo=:id_modulo");
   $this->db->bind(":id_modulo",$nuevo[0]['id_modulo']);
   $cantidad = $this->db->rowCount();

    if($cantidad>0){
       array_splice($nuevo,0,4);
    }


   foreach($nuevo as $tema){
      $this->db->query("INSERT into segui_tema (id_modulo, tema, descripcion, total_horas, estado) 
                                        values (:id_modulo,:numero,:nombre,:horas,1)");
      $this->db->bind(":id_modulo",$tema['id_modulo']);
      $this->db->bind(":numero", $tema['tema']);
      $this->db->bind(":nombre",$tema['nombre']);
      $this->db->bind(":horas",$tema['horas']);

      $this->db->execute();
   }
      return true;
   }


   public function borrar_tema($id_modulo,$id_tema){
    $this->db->query ("DELETE from segui_tema where id_modulo=:id_modulo and id_tema=:id_tema");
    $this->db->bind(":id_modulo",$id_modulo);
    $this->db->bind(":id_tema",$id_tema);

    if ($this->db->execute()){
        return true;
    }else{
        return false;
    }
   }

   public function editar_tema($tema){

      $this->db->query("UPDATE segui_tema SET tema=:tema, descripcion=:descripcion,total_horas=:total_horas 
                                            where id_modulo=:id_modulo and id_tema=:id_tema");
      $this->db->bind(":tema",$tema['tema']);
      $this->db->bind(":id_modulo",$tema['id_modulo']);
      $this->db->bind(":id_tema", $tema['id_tema']);
      $this->db->bind(":descripcion",$tema['descripcion']);
      $this->db->bind(":total_horas",$tema['horas_tema']);
  
      if($this->db->execute()){
          return true;
      }else{
          return false;
      }
     }

 

   public function horas_dia($horario,$id_modulo){

    foreach($horario as $hrs){
            $this->db->query("INSERT into segui_horario_modulo (id_horario,id_modulo,total_horas) 
                                                        values (:id_horario, :id_modulo, :total_horas)");
            $this->db->bind(":id_horario",$hrs->dia);
        
            if($hrs->horas==''){
                $this->db->bind(':total_horas',0);
            }else{
               $this->db->bind(':total_horas',$hrs->horas); 
            }          
            $this->db->bind(':id_modulo',$id_modulo);
            $this->db->execute();
        }

       return true;
   }


   public function actualizar_horas_dia($horario,$id_modulo){

    foreach($horario as $hrs){
            $dia=$hrs->dia;
            $hora=$hrs->horas;

        $this->db->query("UPDATE segui_horario_modulo set total_horas=:total_horas 
                                    where id_modulo=:id_modulo and id_horario=:id_horario;");
         $this->db->bind(":id_horario",$dia);

        if($hora==''){
            $this->db->bind(':total_horas',0);
        }else{
           $this->db->bind(':total_horas',$hora); 
        }  

        $this->db->bind(':id_modulo',$id_modulo);
        $this->db->execute();
    }

    return true;
}


   public function obtener_horario_modulo($id_modulo){
    $this->db->query("SELECT * FROM segui_horario_modulo where id_modulo=:id_modulo");
    $this->db->bind(':id_modulo',$id_modulo);
    return $this->db->registros();
   }

   public function obtener_registros($id_modulo){
    $this->db->query("SELECT * FROM segui_horario_modulo where id_modulo=:id_modulo");
    $this->db->bind(':id_modulo',$id_modulo);
    return $this->db->rowCount();
   }



     //----------------------------EVALUACION CUMPLIMIENTO  ---------------------------------//

     public function obtener_preguntas(){
        $this->db->query("SELECT * FROM segui_preguntas");
        return $this->db->registros();
    }

    public function obtener_id_seguimiento($id_modulo,$id_evaluacion){
        $this->db->query("SELECT id_seguimiento FROM segui_seguimiento_modulo 
                                                where id_modulo=:id_modulo and id_eva=:id_eva");
        $this->db->bind(":id_modulo",$id_modulo);
        $this->db->bind(":id_eva",$id_evaluacion);
        return $this->db->registros();
    }

    public function eva_cumplimiento($respuestas,$id_seguimiento){

      $this->db->query("SELECT * FROM segui_preguntas_seguimiento where id_seguimiento=:id_segui;");
      $this->db->bind(":id_segui",$id_seguimiento);
      $cantidad = $this->db->rowCount();

      if ($cantidad==0){

         foreach($respuestas as $res){
            $id_preg=$res[0];
            $respuesta=$res[1];
            $this->db->query("INSERT into segui_preguntas_seguimiento (id_seguimiento, id_pregunta, respuesta) 
                                                                values (:id_seguimiento,:id_pregunta,:respuesta);");
            $this->db->bind(":id_seguimiento",$id_seguimiento);
            $this->db->bind(":id_pregunta",$id_preg);
            $this->db->bind(":respuesta",$respuesta);
            $this->db->execute();
         }       
         return true;

      }else{

         foreach($respuestas as $res){
            $id_preg=$res[0];
            $respuesta=$res[1];
            $this->db->query("UPDATE segui_preguntas_seguimiento set respuesta=:respuesta 
                                    where id_pregunta=:id_pregunta and id_seguimiento=:id_seguimiento;");
            $this->db->bind(":id_seguimiento",$id_seguimiento);
            $this->db->bind(":id_pregunta",$id_preg);
            $this->db->bind(":respuesta",$respuesta);
            $this->db->execute();
         }       
         return true;

      }
      
    }



    public function obtener_resultados_cumplimiento($id_seguimiento){
      $this->db->query("SELECT * from segui_preguntas_seguimiento where id_seguimiento=:id_seguimiento");
      $this->db->bind(":id_seguimiento",$id_seguimiento);   
      return $this->db->registros();    
     }
    


   //----------------------------EVALUACION ENSEÑANZA ---------------------------------//


   public function update_eva_ensenanza($evaluacion,$id_seguimiento){
    $this->db->query("UPDATE segui_seguimiento set alu_mat=:matriculados,alu_discon=:excep,
                                                    alu_efect=:efectivos,hrs_x_alu=:horas_alumno,alu_falt=:faltas,
                                                    hrs_docen=:horas,faltas_profe=:faltas_profe,
                                                    faltas_otros=:faltas_otros,alu_eva=:evaluados,
                                                    alu_apro=:aprobados,interes=:interes,
                                                    comportamiento=:comportamiento,puntualidad=:puntualidad,
                                                    limpieza=:limpieza 
                                where id_seguimiento=:id_seguimiento;");

    $this->db->bind(":matriculados",$evaluacion['matriculados']);
    $this->db->bind(":excep",$evaluacion['excep']);
    $this->db->bind(":efectivos",$evaluacion['efectivos']);
    $this->db->bind(":horas_alumno",$evaluacion['horas_alumno']);
    $this->db->bind(":faltas",$evaluacion['faltas']);
    $this->db->bind(":horas",$evaluacion['horas']);
    $this->db->bind(":faltas_profe",$evaluacion['faltas_profe']);
    $this->db->bind(":faltas_otros",$evaluacion['faltas_otros']);
    $this->db->bind(":evaluados",$evaluacion['evaluados']);
    $this->db->bind(":aprobados",$evaluacion['aprobados']);
    $this->db->bind(":interes",$evaluacion['interes']);
    $this->db->bind(":comportamiento",$evaluacion['comportamiento']);
    $this->db->bind(":puntualidad",$evaluacion['puntualidad']);
    $this->db->bind(":limpieza",$evaluacion['limpieza']);

    $this->db->bind(":id_seguimiento",$id_seguimiento);

    if($this->db->execute()){
        return true;
    }else{
        return false;
    }

   }


   public function obt_id_seguimiento($id_lectivo,$id_evaluacion,$id_modulo){
    $this->db->query("SELECT * FROM segui_seguimiento_modulo, segui_evaluacion
                                where segui_seguimiento_modulo.id_eva=segui_evaluacion.id_eva
                                    and segui_seguimiento_modulo.id_modulo=:id_modulo
                                    and segui_evaluacion.id_lectivo=:id_lectivo
                                    and segui_evaluacion.id_eva=:id_evaluacion");

    $this->db->bind(":id_modulo",$id_modulo);
    $this->db->bind(":id_lectivo",$id_lectivo);
    $this->db->bind(":id_evaluacion",$id_evaluacion);
    return $this->db->registros();

   }


   public function obtener_resultados_ensenanza($id_seguimiento){
     $this->db->query("SELECT * from segui_seguimiento where id_seguimiento=:id_seguimiento");
     $this->db->bind(":id_seguimiento",$id_seguimiento);   
     return $this->db->registros();    
    }
   

   //  public function obtener_resultados_ensenanza($id_evaluacion,$id_modulo){
   //   $this->db->query("SELECT * from seguimiento,seguimiento_modulo
   //   where seguimiento.id_seguimiento=seguimiento_modulo.id_seguimiento
   //   and seguimiento_modulo.id_eva=:id_eva and seguimiento_modulo.id_modulo=:id_mod;");
   //   $this->db->bind(":id_eva",$id_evaluacion); 
   //   $this->db->bind(":id_mod",$id_modulo);   
   //   return $this->db->registros();   
     
   //  }
   














}