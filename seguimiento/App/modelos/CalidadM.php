<?php

class CalidadM
{
    private $db;

    public function __construct(){
        $this->db = new Base;
    }


    // public function obtener_modulos(){
    //     $this->db->query("SELECT * FROM cpifp_modulo;");
    //     return $this->db->registros();
    // }

    // public function obtener_profes(){
    //     $this->db->query("SELECT * FROM cpifp_profesor;");
    //     return $this->db->registros();
    // }

    //   public function obtener_profes(){
    //     $this->db->query("SELECT departamento,cpifp_profesor.id_profesor, nombre_completo from cpifp_profesor, cpifp_departamento, cpifp_profesor_departamento 
    //     where cpifp_profesor_departamento.id_profesor=cpifp_profesor.id_profesor 
    //     and cpifp_profesor_departamento.id_departamento=cpifp_departamento.id_departamento
    //     and cpifp_departamento.id_departamento=2;");
    //      return $this->db->registros();
    //  }

    // public function editar_modulo($modulo,$id){

    //     //var_dump($modulo);
    //     //echo $id;
    //     //exit;

    //     $this->db->query("UPDATE cpifp_modulo SET horas_totales=:horas,turno=:turno,edi_anterior=:edi_ant,modifica=:modifica,edi_vigente=:edi_vi,redactor=:redactor
    //     WHERE id_modulo=:id;");
        
    //     $this->db->bind(':horas',$modulo['horas']);
    //     $this->db->bind(':turno', $modulo['turno']);
    //     $this->db->bind(':edi_ant',$modulo['edi_ant']);
    //     $this->db->bind(':modifica',$modulo['modifica']);
    //     $this->db->bind(':edi_vi',$modulo['edi_vi']);
    //     $this->db->bind(':redactor',$modulo['redactor']);

    //     $this->db->bind(':id',$id);
        
    //     if ($this->db->execute()){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }


}