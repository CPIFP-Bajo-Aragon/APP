<?php

class JefeDepM
{
    private $db;

    public function __construct(){
        $this->db = new Base;
    }


    public function obtenerDatosId($id){
        $this->db->query("SELECT * FROM segui_profesor_departamento WHERE id_profesor=:id");
        $this->db->bind(':id', $id);
        return $this->db->registros();
    }

    public function obtener_grados($id_dep){
        $this->db->query("SELECT cpifp_departamento.id_departamento, departamento, departamento_corto,id_ciclo, 
                                        ciclo, ciclo_corto, segui_grado.id_grado, nombre 
                                from cpifp_ciclos, segui_grado, cpifp_departamento 
                                where cpifp_ciclos.id_departamento=:id_departamento
                                    and segui_grado.id_grado=cpifp_ciclos.id_grado 
                                    and cpifp_departamento.id_departamento=cpifp_ciclos.id_departamento");
        $this->db->bind(':id_departamento',$id_dep);
        return $this->db->registros();
    }

    public function obtener_ciclos_cursos($id_dep){
        $this->db->query("SELECT cpifp_ciclos.id_ciclo, ciclo, segui_grado.id_grado, nombre,
                                        cpifp_curso.id_curso, cpifp_curso.curso
                                from cpifp_ciclos,segui_grado, cpifp_curso 
                                where cpifp_ciclos.id_departamento=:id_departamento
                                    and segui_grado.id_grado=cpifp_ciclos.id_grado 
                                    and cpifp_curso.id_ciclo=cpifp_ciclos.id_ciclo");
        $this->db->bind(':id_departamento',$id_dep);
        return $this->db->registros();
    }

    public function obtener_asignaturas($id_dep){
        $this->db->query("SELECT * FROM segui_departamento_modulo where id_departamento=:id_dep;");
        $this->db->bind(':id_dep',$id_dep);
        return $this->db->registros();
    }

    public function obtener_modulos_curso_ciclo($id_dep,$id_curso,$id_ciclo){
        $this->db->query("SELECT * FROM segui_departamento_modulo 
                                    where id_departamento=:id_dep 
                                            and id_ciclo=:id_ciclo and id_curso=:id_curso;");
        $this->db->bind(':id_dep',$id_dep);
        $this->db->bind(':id_curso',$id_curso);
        $this->db->bind(':id_ciclo',$id_ciclo);
        return $this->db->registros();
    }

    public function obtener_ciclo_id($id_ciclo){
        $this->db->query("SELECT * FROM cpifp_ciclos where id_ciclo=:id_ciclo;");
        $this->db->bind(':id_ciclo',$id_ciclo);
        return $this->db->registros();
    }

    public function obtener_lectivo(){
        $this->db->query("SELECT id_lectivo from segui_lectivo 
                                            where fecha_ini<CURDATE() and fecha_fin>CURDATE();");
        return $this->db->registros();
    }


    //PROFESORES X DEPARTAMENTO
       public function obtener_profes($id_dep){
         $this->db->query("SELECT departamento,cpifp_profesor.id_profesor, nombre_completo 
                                from cpifp_profesor, cpifp_departamento, cpifp_profesor_departamento,segui_lectivo
                                    where cpifp_profesor_departamento.id_profesor=cpifp_profesor.id_profesor 
                                        and cpifp_profesor_departamento.id_departamento=cpifp_departamento.id_departamento
                                        and cpifp_departamento.id_departamento=:id_dep
                                        and id_lectivo 
                                            in(select id_lectivo from segui_lectivo where fecha_ini<curdate() and fecha_fin>curdate());");
         $this->db->bind(':id_dep',$id_dep);
         return $this->db->registros();
      }


    public function obtener_evas($id_lectivo){
        $this->db->query("SELECT * from segui_evaluacion where id_lectivo=:id_lectivo");
        $this->db->bind(':id_lectivo',$id_lectivo);
        return $this->db->registros();
    }


    public function insertar_modulo($modulo,$array,$lectivo,$evas){
      
        $max=sizeof($array);
        $nuevo= array();

        for($i=0;$i<$max;$i++){
            if($array[$i]->horas!='')
            array_push($nuevo,$array[$i]);
        }

        //var_dump($nuevo);
        //exit;
        foreach($nuevo as $datos){
            $p=$datos->profe;
            $h=$datos->horas;
    
            $this->db->query("INSERT INTO cpifp_profesor_modulo (id_lectivo, id_profesor, id_modulo, horas_profesor) 
                                                        VALUES (:lectivo, :profe, :modulo, :horas);");
            $this->db->bind(':profe',$p);
            $this->db->bind(':modulo',$modulo);     
            $this->db->bind(':horas',$h);
            $this->db->bind(':lectivo',$lectivo);

            $this->db->execute();
        }

        $tam=sizeof($evas);
        for ($i=0;$i<$tam;$i++){

            $this->db->query("INSERT into segui_seguimiento (alu_mat,alu_discon,alu_efect,hrs_x_alu,alu_falt,
                                        hrs_docen,faltas_profe,faltas_otros,alu_eva,alu_apro,interes,
                                        comportamiento,puntualidad,limpieza) 
                                    values (0,0,0,0,0,0,0,0,0,0,0,0,0,0);");
            $this->db->execute();

            $id_seguimiento=$this->db->ultimoIndice();
            $id_eva=$evas[$i]->id_eva;

            $this->db->query("INSERT into segui_seguimiento_modulo (id_seguimiento,id_eva,id_modulo) 
                                                            values (:id_segui,:id_eva,:id_mod)");
            $this->db->bind(":id_segui",$id_seguimiento);
            $this->db->bind(":id_eva",$id_eva);
            $this->db->bind(":id_mod",$modulo);

            $this->db->execute();
        }

        return true;

     }


     public function horas_profes_modulo($id_dep){
        $this->db->query("SELECT cpm.* FROM cpifp_profesor_modulo cpm 
                                            left join cpifp_profesor_departamento cpd 
                                            on cpm.id_profesor=cpd.id_profesor 
                                        where id_departamento=:id");
        $this->db->bind(':id',$id_dep);
        return $this->db->registros();
     }

     public function registros($id_dep,$id_modulo){
        $this->db->query("SELECT cpm.* FROM cpifp_profesor_modulo cpm 
                                            left join cpifp_profesor_departamento cpd 
                                            on cpm.id_profesor=cpd.id_profesor 
                                        where id_departamento=:id and id_modulo=:id_modulo");
        $this->db->bind(':id',$id_dep);
        $this->db->bind(':id_modulo',$id_modulo);
        return $this->db->registros();
     }

     

    public function actualizar_modulo($modulo,$array,$lectivo,$evas){

        $max=sizeof($array);
        $nuevo= array();

        for($i=0;$i<$max;$i++){
            if($array[$i]->horas!='')
            array_push($nuevo,$array[$i]);
        }

        $this->db->query("DELETE FROM cpifp_profesor_modulo where id_modulo=:id_modulo and id_lectivo=:lectivo");
        $this->db->bind(':id_modulo',$modulo);
        $this->db->bind(':lectivo',$lectivo);
        $this->db->execute();

        foreach($nuevo as $datos){
            $p=$datos->profe;
            $h=$datos->horas;

            $this->db->query("INSERT INTO cpifp_profesor_modulo (id_lectivo, id_profesor, id_modulo, horas_profesor) 
                                                        VALUES (:lectivo, :profe, :modulo, :horas);");
            $this->db->bind(':profe',$p);
            $this->db->bind(':modulo',$modulo);     
            $this->db->bind(':horas',$h);
            $this->db->bind(':lectivo',$lectivo);

            $this->db->execute();
        }

  return true;

    }

}