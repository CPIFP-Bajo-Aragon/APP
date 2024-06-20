<?php

class LoginModelo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }


    public function loginEmail($login, $passw)
    {
        // $this->db->query("SELECT cpifp_profesor.id_profesor,login, password, nombre_completo, id_rol from cpifp_profesor, cpifp_profesor_departamento  
        // WHERE cpifp_profesor_departamento.id_profesor=cpifp_profesor.id_profesor and login = :email AND password = sha2(:passw,256)");
        $this->db->query("SELECT * 
                                FROM cpifp_profesor 
                                WHERE login = :login 
                                    AND password = sha2(:passw,256)");

        $this->db->bind(':login', $login);
        $this->db->bind(':passw', $passw);

        return $this->db->registro();
    }


    public function getRolesProfesor($id_profesor){
        $this->db->query("SELECT * 
                                    FROM cpifp_profesor_departamento
                                        NATURAL JOIN cpifp_rol
                                        NATURAL JOIN cpifp_departamento
                                    WHERE id_profesor=:id_profesor");

        $this->db->bind(':id_profesor',$id_profesor);

        return $this->db->registros();
    }

    
    public function regenerarPass($password,$email){
    
        $this->db->query("UPDATE cpifp_profesor SET password=sha2(:password,256) where email=:email");
        $this->db->bind(':password', $password);
        $this->db->bind(':email', $email);

        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }
    }


    // public function recuperar($socio){
    //     $this->db->query("SELECT email FROM USUARIO WHERE id_usuario=:socio");
    //     $this->db->bind(':socio', $socio);
    //     return $this->db->registro();
    // }


    // public function cambiarPass($password,$id){
    
    //     $this->db->query("UPDATE usuario SET passw=MD5(:passw) where id_usuario=:id");
    //     $this->db->bind(':passw', $password);
    //     $this->db->bind(':id', $id);
    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }



    /*public function registroSesion($id_usuario)
    {
        $this->db->query("INSERT INTO sesiones (id_sesion, id_usuario, fecha_inicio) 
                                        VALUES (:id_sesion, :id_usuario, NOW())");

        $this->db->bind(':id_sesion', session_id());
        $this->db->bind(':id_usuario', $id_usuario);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function registroFinSesion($id_usuario)
    {
        $this->db->query("UPDATE sesiones SET fecha_fin = NOW()  
                                    WHERE id_usuario = :id_usuario AND id_sesion = :id_sesion");

        $this->db->bind(':id_sesion', session_id());
        $this->db->bind(':id_usuario', $id_usuario);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }*/
}
