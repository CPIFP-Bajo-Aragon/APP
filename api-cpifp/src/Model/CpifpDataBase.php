<?php

namespace App\Model;

use DomainException;
use PDO;

class CpifpDataBase
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

// ***************** PROFESORES *****************

    public function addProfesor($profesor)
    {

        $row = [
            'login' => $profesor['login'],
            'password' => $profesor['password'],
            'nombre_completo' => $profesor['nombre_completo'],
            'email' => $profesor['email'],
            'activo' => $profesor['activo'],
        ];

        $sql = "INSERT INTO cpifp_profesor SET 
                    login=:login, 
                    password=sha2(:password,256),
                    nombre_completo=:nombre_completo,
                    email=:email,
                    activo=:activo";

        $this->connection->prepare($sql)->execute($row);
        
        $idUltimoRegistroInsertado = (int)$this->connection->lastInsertId();

        return $idUltimoRegistroInsertado;
    }


    public function listProfesor()
    {

        $sql = "SELECT * FROM cpifp_profesor
                ORDER BY nombre_completo";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

    public function listTecnicos()
    {

        $sql = "SELECT email FROM `cpifp_profesor` 
        LEFT JOIN cpifp_profesor_departamento USING (id_profesor) WHERE id_rol = 40";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

    public function delProfesor($profesor)
    {

        $sql = "DELETE  FROM cpifp_profesor
                    WHERE id_profesor = $profesor[id_profesor]";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

    }

    public function updateProfesor($profesor) 
    {
        $idProfesor = $profesor['id_profesor'];

        $row = [
            'login' => $profesor['login'],
            'nombre_completo' => $profesor['nombre_completo'],
            'email' => $profesor['email'],
            "activo" => $profesor['activo'],
        ];

        $sql = "UPDATE cpifp_profesor SET 
            login=:login, 
            nombre_completo=:nombre_completo,
            email=:email,
            activo=:activo
            WHERE
            id_profesor = $idProfesor";


        $this->connection->prepare($sql)->execute($row);
        
    }

    public function updatePassword($password,$profesorId)
    {

        $row = [
            'password' => $password,
        ];

        $sql = "UPDATE cpifp_profesor SET 
            password=sha2(:password,256)
            
            WHERE
            id_profesor = $profesorId";


        $this->connection->prepare($sql)->execute($row);
        
    }

    public function checkEmail($email)
    {
  
        $sql = "SELECT *
                    FROM cpifp_profesor 
                    WHERE email = $email";

        $statement = $this->connection->prepare($sql);
        $statement->execute($row);

        $profesor = $statement->fetch();

        if (!$profesor) {
            $profesor = null;
        }else $profesor = "OK";

        return $profesor;
    }

    public function checkCodigo($email,$codigo)
    {
  
        $sql = "SELECT *
                    FROM cpifp_profesor 
                    WHERE email = $email AND cod_pass = $codigo";

        $statement = $this->connection->prepare($sql);
        $statement->execute($row);

        $profesor = $statement->fetch();

        if (!$profesor) {
            $profesor = null;
        }else $profesor = "OK";

        return $profesor;
    }

    public function recoveryPass($recovery)
    {
        $email = $recovery['email'];

        $row = [
            "password" => $recovery['password'],
        ];

        $sql = "UPDATE cpifp_profesor SET 

             password=sha2(:password,256)

            WHERE
            email='$email'";


        $this->connection->prepare($sql)->execute($row);
        
        
    }

    public function insertCodigo($email,$codigo)
    {
  
        $sql = "UPDATE cpifp_profesor SET 
        cod_pass=$codigo
        
        WHERE
        email = $email";

        $statement = $this->connection->prepare($sql);
        $statement->execute($row);

    }

    public function checkLogin(string $login,string $password)
    {
        $row = [
            'login' => $login,
            'password' => $password
        ];

        $sql = "SELECT *
                    FROM cpifp_profesor 
                    WHERE login = :login
                    AND password = sha2(:password,256)
                    AND activo = 1;";

        $statement = $this->connection->prepare($sql);
        $statement->execute($row);

        $profesor = $statement->fetch();

        if (!$profesor) {
            $profesor = null;
        }

        return $profesor;
    }

    public function getProfesorById(int $profesorId)
    {
        $row = [
            'id_profesor' => $profesorId,
        ];

       $sql = "SELECT *
                    FROM cpifp_profesor 
                    WHERE id_profesor = $profesorId;";

        $statement = $this->connection->prepare($sql);
        $statement->execute($row);

        $profesor= $statement->fetch();

        if (!$profesor) {
            throw new DomainException(sprintf('Profesor not found: %s', $profesorId));
        }
        return $profesor;
    }

    public function listComunicacion()
    {

        $sql = "SELECT p.nombre_completo, p.email,d.departamento,pd.id_profesor_departamento, r.rol FROM cpifp_profesor p
		LEFT JOIN cpifp_profesor_departamento pd USING (id_profesor)
        LEFT JOIN cpifp_departamento d USING (id_departamento)
        LEFT JOIN cpifp_rol r USING (id_rol)";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

// ***************** DEPARTAMENTOS *****************

    
    public function listDepartamentos()
    {

        $sql = "SELECT * FROM cpifp_departamento";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

    public function addProfDepartamento($profDepartamento)
    {

        $row = [
            'id_profesor' => $profDepartamento['id_profesor'],
            'id_departamento' => $profDepartamento['id_departamento'],
            'id_rol' => $profDepartamento['id_rol'],
        ];

        $sql = "INSERT INTO cpifp_profesor_departamento SET 
                    id_profesor=:id_profesor, 
                    id_departamento=:id_departamento,
                    id_rol=:id_rol";
                    

        $this->connection->prepare($sql)->execute($row);
        
        $idUltimoRegistroInsertado = (int)$this->connection->lastInsertId();

        return $idUltimoRegistroInsertado;
    }

    public function updateProfDep($profDep) 
    {
        $idProfDep = $profDep['id_profesor_departamento'];

        $row = [
            'id_profesor' => $profDep['id_profesor'],
            'id_departamento' => $profDep['id_departamento'],
            'id_rol' => $profDep['id_rol'],
        ];

        $sql = "UPDATE cpifp_profesor_departamento SET 
            id_profesor=:id_profesor, 
            id_departamento=:id_departamento,
            id_rol=:id_rol
            WHERE
            id_profesor_departamento = $idProfDep";


        $this->connection->prepare($sql)->execute($row);
        
    }

    public function delprofDep($profDep)
    {

        $sql = "DELETE  FROM cpifp_profesor_departamento
                    WHERE id_profesor_departamento = $profDep[id_profesor_departamento]";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

    }

    public function listRoles()
    {

        $sql = "SELECT * FROM cpifp_rol";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

    

    public function listProfDep($departamentoId)
    {

        $sql = " SELECT pd.id_profesor_departamento,pd.id_profesor, p.nombre_completo,pd.id_rol,r.rol 
            
                FROM cpifp_profesor_departamento pd
                
                LEFT JOIN cpifp_profesor p USING (id_profesor)
                LEFT JOIN cpifp_rol r USING (id_rol)
                WHERE
                id_departamento = $departamentoId";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

    public function addDepartamento($departamento)
    {

        $row = [
            'departamento' => $departamento['departamento'],
            'departamento_corto' => $departamento['departamento_corto'],
        ];

        $sql = "INSERT INTO cpifp_departamento SET 
                    departamento=:departamento,
                    departamento_corto=:departamento_corto";

        $this->connection->prepare($sql)->execute($row);
        
        $idUltimoRegistroInsertado = (int)$this->connection->lastInsertId();

        return $idUltimoRegistroInsertado;
    }

    public function updateDepartamento($departamento) 
    {
        $id_departamento = $departamento['id_departamento'];

        $row = [
            'departamento' => $departamento['departamento'],
            'departamento_corto' => $departamento['departamento_corto'],
        ];

        $sql = "UPDATE cpifp_departamento SET 
            departamento=:departamento,
            departamento_corto=:departamento_corto
            WHERE
            id_departamento = $id_departamento";


        $this->connection->prepare($sql)->execute($row);
        
    }

    public function delDepartamento($departamento)
    {

        $sql = "DELETE  FROM cpifp_departamento
                    WHERE id_departamento = $departamento[id_departamento]";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

    }

    public function getRolById(int $profesorId)
    {
        $row = [
            'id_profesor' => $profesorId,
        ];

       $sql = "SELECT max(id_rol) AS id_rol FROM cpifp_profesor_departamento
                    WHERE id_profesor = $profesorId";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $profesor= $statement->fetch();

        if (!$profesor) {
            throw new DomainException(sprintf('Profesor not found: %s', $profesorId));
        }
        return $profesor;
    }

    public function getDepartamentos($profesorId)
    {
        $row = [
            'id_profesor' => $profesorId,
        ];

       $sql = "SELECT * FROM cpifp_departamento 
                JOIN cpifp_profesor_departamento USING(id_departamento) 
                WHERE id_profesor = $profesorId AND id_rol=30";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

    public function getDepartamento($id_departamento)

    {
       $sql = "SELECT departamento FROM cpifp_departamento 
                WHERE id_departamento = $id_departamento";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $departamento= $statement->fetch();
 
        return $departamento;
    }

// ***************** MÓDULOS *****************

    public function addProfModulo($profesorModulo)
    {

        $row = [
            'anio_lectivo' => $profesorModulo['anio_lectivo'],
            'id_profesor' => $profesorModulo['id_profesor'],
            'id_modulo' => $profesorModulo['id_modulo'],
        ];

        $sql = "INSERT INTO cpifp_profesor_modulo SET 
                    anio_lectivo=:anio_lectivo, 
                    id_profesor=:id_profesor,
                    id_modulo=:id_modulo";
                    

        $this->connection->prepare($sql)->execute($row);
        
        $idUltimoRegistroInsertado = (int)$this->connection->lastInsertId();

        return $idUltimoRegistroInsertado;
    }

    public function listModulos($cicloID)
    {

        $sql = "SELECT m.*,c.curso,ci.ciclo FROM cpifp_modulo m
                
                LEFT JOIN cpifp_curso c USING (id_curso)
                LEFT JOIN cpifp_ciclos ci USING (id_ciclo)
                WHERE 
                id_ciclo = $cicloID";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

    public function addCiclo($ciclo)
    {

        $row = [
            'ciclo' => $ciclo['ciclo'],
            'ciclo_corto' => $ciclo['ciclo_corto'],
        ];

        $sql = "INSERT INTO cpifp_ciclos SET 
                    ciclo=:ciclo,
                    ciclo_corto=:ciclo_corto";

        $this->connection->prepare($sql)->execute($row);
        
        $idUltimoRegistroInsertado = (int)$this->connection->lastInsertId();

        return $idUltimoRegistroInsertado;
    }

    public function updateCiclo($ciclo) 
    {
        $id_ciclo = $ciclo['id_ciclo'];

        $row = [
            'ciclo' => $ciclo['ciclo'],
            'ciclo_corto' => $ciclo['ciclo_corto'],
        ];

        $sql = "UPDATE cpifp_ciclos SET 
            ciclo=:ciclo,
            ciclo_corto=:ciclo_corto
            WHERE
            id_ciclo = $id_ciclo";


        $this->connection->prepare($sql)->execute($row);
        
    }

    public function listCiclos()
    {

        $sql = "SELECT * FROM cpifp_ciclos";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

    public function delCiclo($ciclo)
    {

        $sql = "DELETE  FROM cpifp_ciclos
                    WHERE id_ciclo = $ciclo[id_ciclo]";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

    }

    public function addModulo($modulo)
    {

        $row = [
            'modulo' => $modulo['modulo'],
            'nombre_corto' => $modulo['nombre_corto'],
            'id_curso' => $modulo['id_curso'],
        ];

        $sql = "INSERT INTO cpifp_modulo SET 
                    modulo=:modulo, 
                    nombre_corto=:nombre_corto,
                    id_curso=:id_curso";
                    

        $this->connection->prepare($sql)->execute($row);
        
        $idUltimoRegistroInsertado = (int)$this->connection->lastInsertId();

        return $idUltimoRegistroInsertado;
    }

    public function updateModulo($modulo)
    {
        $idModulo = $modulo['id_modulo'];

        $row = [
            'modulo' => $modulo['modulo'],
            'nombre_corto' => $modulo['nombre_corto'],
            'id_curso' => $modulo['id_curso'],
        ];

        $sql = "UPDATE cpifp_modulo SET 
            modulo=:modulo, 
            nombre_corto=:nombre_corto,
            id_curso=:id_curso
            WHERE
            id_modulo = $idModulo";


        $this->connection->prepare($sql)->execute($row);
        
    }

    public function delModulo($modulo)
    {

        $sql = "DELETE  FROM cpifp_modulo
                    WHERE id_modulo = $modulo[id_modulo]";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

    }

    public function listCursos($cicloID)
    {

        $sql = " SELECT * FROM cpifp_curso
                
                WHERE
                id_ciclo = $cicloID";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

}