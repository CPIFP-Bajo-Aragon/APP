<?php

class DireccionM
{
    private $db;

    public function __construct(){
        $this->db = new Base;
    }


    public function obtener_cursos(){
        $this->db->query("SELECT * FROM segui_lectivo;");
        return $this->db->registros();
    }

    public function obtener_lectivo(){
        $this->db->query("SELECT id_lectivo from segui_lectivo 
                                            where fecha_ini<CURDATE() and fecha_fin>CURDATE();");
        return $this->db->registros();
    }

     public function obtener_evaluaciones($id_lectivo){
         $this->db->query("SELECT * from segui_evaluacion 
                                    where id_lectivo=:id_lectivo");
         $this->db->bind(":id_lectivo",$id_lectivo);
         return $this->db->registros();
     }



    public function nuevo_curso($nuevo){

        $this->db->query("INSERT INTO segui_lectivo (nombre,fecha_ini,fecha_fin) 
                                VALUES (:nombre,:ini,:fin)");
        $this->db->bind(':nombre', $nuevo['nombre']);
        $this->db->bind(':ini',$nuevo['fecha_ini']);
        $this->db->bind(':fin',$nuevo['fecha_fin']);
        $this->db->execute();

        $id_lectivo=$this->db->ultimoIndice();
        
        $this->db->query("INSERT INTO segui_evaluacion (eva,fecha_ini,fecha_fin,id_lectivo) 
                                VALUES (:eva,:ini,:fin,:id_lectivo)");
        $this->db->bind(':id_lectivo',$id_lectivo);
        $this->db->bind(':eva', $nuevo['primera']);
        $this->db->bind(':ini',$nuevo['primera_ini']);
        $this->db->bind(':fin',$nuevo['primera_fin']);
        $this->db->execute();

        $this->db->query("INSERT INTO segui_evaluacion (eva,fecha_ini,fecha_fin,id_lectivo) 
                                VALUES (:eva,:ini,:fin,:id_lectivo)");
        $this->db->bind(':id_lectivo',$id_lectivo);
        $this->db->bind(':eva', $nuevo['segunda']);
        $this->db->bind(':ini',$nuevo['segunda_ini']);
        $this->db->bind(':fin',$nuevo['segunda_fin']);
        $this->db->execute();

        $this->db->query("INSERT INTO segui_evaluacion (eva,fecha_ini,fecha_fin,id_lectivo) 
                                VALUES (:eva,:ini,:fin,:id_lectivo)");
        $this->db->bind(':id_lectivo',$id_lectivo);
        $this->db->bind(':eva', $nuevo['final']);
        $this->db->bind(':ini',$nuevo['final_ini']);
        $this->db->bind(':fin',$nuevo['final_fin']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }


    public function borrar_curso($id){
        $this->db->query("DELETE FROM segui_lectivo WHERE id_lectivo =:id");
        $this->db->bind(':id',$id);
        $this->db->execute();

        $this->db->query("DELETE FROM segui_evaluacion WHERE id_lectivo =:id");
        $this->db->bind(':id',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function editar_curso($editar,$id_lectivo,$id_primera,$id_segunda,$id_final){

        $this->db->query("UPDATE segui_lectivo SET nombre=:nombre, fecha_ini=:ini, fecha_fin=:fin 
                                WHERE id_lectivo = :id"); 
        $this->db->bind(':nombre',$editar['nombre']);
        $this->db->bind(':ini',$editar['fecha_ini']);
        $this->db->bind(':fin',$editar['fecha_fin']);
        $this->db->bind(':id',$id_lectivo);
        $this->db->execute();

        $this->db->query("UPDATE segui_evaluacion SET eva=:eva,fecha_ini=:ini,fecha_fin=:fin 
                                WHERE id_eva = :id");
        $this->db->bind(':id',$id_primera);
        $this->db->bind(':eva', $editar['primera']);
        $this->db->bind(':ini',$editar['primera_ini']);
        $this->db->bind(':fin',$editar['primera_fin']);
        $this->db->execute();

        $this->db->query("UPDATE segui_evaluacion SET eva=:eva,fecha_ini=:ini,fecha_fin=:fin 
                                WHERE id_eva = :id");
        $this->db->bind(':id',$id_segunda);
        $this->db->bind(':eva', $editar['segunda']);
        $this->db->bind(':ini',$editar['segunda_ini']);
        $this->db->bind(':fin',$editar['segunda_fin']);
        $this->db->execute();

        $this->db->query("UPDATE segui_evaluacion SET eva=:eva,fecha_ini=:ini,fecha_fin=:fin 
                                WHERE id_eva = :id");
        $this->db->bind(':id',$id_final);
        $this->db->bind(':eva', $editar['final']);
        $this->db->bind(':ini',$editar['final_ini']);
        $this->db->bind(':fin',$editar['final_fin']);
  

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
        

    }


/************************FESTIVOS **************************************/

    public function nuevo_festivo($nuevo,$id_curso){

        $tam=sizeof($nuevo['festivo']);

        for($i=0; $i<$tam; $i++){
            $this->db->query("INSERT INTO segui_festivo (fecha,nombre,id_lectivo) 
                                    VALUES (:fecha,:nombre,:id_curso)");
            $this->db->bind(':fecha', $nuevo['fecha'][$i]);
            $this->db->bind(':nombre', $nuevo['festivo'][$i]);
            $this->db->bind(':id_curso', $id_curso);
            $this->db->execute(); 
        }        
         return true;
    }


    public function ver_festivos_curso($id_lectivo){
        $this->db->query("SELECT * from segui_festivo where id_lectivo=:id_lectivo;");
        $this->db->bind(':id_lectivo',$id_lectivo);
        return $this->db->registros();
    }


    public function borrar_festivo($id){
        $this->db->query("DELETE FROM segui_festivo WHERE id_festivo =:id");
        $this->db->bind(':id',$id);

        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


}