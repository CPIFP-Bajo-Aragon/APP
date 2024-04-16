<?php

namespace App\Model;

use DomainException;
use PDO;

class MantenimientoDataBase
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }



    public function listIncidencias()
    {
        $sql = "SELECT i.id_incidencia, (SELECT p.nombre_completo FROM cpifp_profesor p WHERE p.id_profesor=id_profesor_crea) AS ProfCrea,
                (SELECT p.nombre_completo FROM cpifp_profesor p WHERE p.id_profesor=id_prof_modifica)  AS ProfMod,
                (SELECT p.nombre_completo FROM cpifp_profesor p WHERE p.id_profesor=id_tec_atiende) AS TecAtiende,
                i.id_profesor_crea, i.descripcion, i.desc_tecnica,i.id_estado, es.estado, i.id_ubicacion, e.id_edificio, e.edificio,ub.ubicacion,
                CONCAT(e.edificio,' - ',ub.ubicacion) AS ubi_completa, i.observaciones, 
                DATE_FORMAT(i.fecha, '%d/%m/%y') AS fecha,i.nivel_urgencia,u.urgencia, DATE_FORMAT(i.fecha_ini_rep, '%d/%m/%y') AS fecha_ini_rep,
                DATE_FORMAT(i.fecha_fin_rep, '%d/%m/%y') AS fecha_fin_rep,i.horas, i.id_departamento,d.departamento, i.id_prof_modifica, i.id_tec_atiende
                FROM man_incidencias i
                LEFT JOIN man_urgencia u ON (nivel_urgencia = id_urgencia) 
                LEFT JOIN man_estado es USING (id_estado) 
                LEFT JOIN man_ubicacion ub USING (id_ubicacion)
                LEFT JOIN man_edificio e USING (id_edificio)
                LEFT JOIN cpifp_departamento d USING (id_departamento) ORDER BY i.fecha DESC";
       

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

    public function addIncidencia($incidencia)
    {

        $row = [
            'id_profesor_crea' => $incidencia['id_profesor_crea'],
            'descripcion' => $incidencia['descripcion'],
            'desc_tecnica' => $incidencia['desc_tecnica'],
            'horas' => $incidencia['horas'],
            'id_estado' => 1,
            'fecha_ini_rep'=> $incidencia['fecha_ini_rep'], 
            'fecha_fin_rep'=> $incidencia['fecha_fin_rep'], 
            'nivel_urgencia' => $incidencia['nivel_urgencia'],
            'id_ubicacion' => $incidencia['id_ubicacion'],
            'observaciones' => '',
            'id_departamento' => $incidencia['id_departamento'],
            'id_prof_modifica' => $incidencia['id_prof_modifica'],
            'id_tec_atiende' => $incidencia['id_tec_atiende'],

        ];

        $sql = "INSERT INTO man_incidencias SET 
                    id_profesor_crea=:id_profesor_crea, 
                    descripcion=:descripcion,
                    desc_tecnica=:desc_tecnica,
                    horas=:horas,
                    id_estado=:id_estado,
                    fecha = CURDATE(),
                    fecha_ini_rep=:fecha_ini_rep,
                    fecha_fin_rep=:fecha_fin_rep,
                    nivel_urgencia=:nivel_urgencia,
                    id_ubicacion=:id_ubicacion,
                    observaciones=:observaciones,
                    id_departamento=:id_departamento,
                    id_prof_modifica=:id_prof_modifica,
                    id_tec_atiende=:id_tec_atiende";

        $this->connection->prepare($sql)->execute($row);
        
        $idUltimoRegistroInsertado = (int)$this->connection->lastInsertId();

        return $idUltimoRegistroInsertado;
    }

    public function updateIncidencia($incidencia) 
    {

        $row = [
            'descripcion' => $incidencia['descripcion'],
            'desc_tecnica' => $incidencia['desc_tecnica'],
            'horas' => $incidencia['horas'],
            'id_estado' => $incidencia['id_estado'],
            'nivel_urgencia' => $incidencia['nivel_urgencia'],
            'id_ubicacion' => $incidencia['id_ubicacion'],
            'observaciones' => $incidencia['observaciones'],
            'id_departamento' => $incidencia['id_departamento'],
            'id_prof_modifica' => $incidencia['id_prof_modifica'],
        ];

            $sql = "UPDATE man_incidencias SET 
                descripcion=:descripcion,
                desc_tecnica=:desc_tecnica,
                horas=:horas,
                id_estado=:id_estado,
                nivel_urgencia=:nivel_urgencia,
                id_ubicacion=:id_ubicacion,
                observaciones=:observaciones,
                id_departamento=:id_departamento,
                id_prof_modifica=:id_prof_modifica

                 WHERE
                 id_incidencia = $incidencia[id_incidencia]";

       


        $this->connection->prepare($sql)->execute($row);
        
    }

    public function delIncidencia($incidencia)
    {

        $sql = "DELETE  FROM man_incidencias
                    WHERE id_incidencia = $incidencia[id_incidencia]";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

    }


    public function atiendeIncidencia($incidenciaId,$observaciones,$id_tec_atiende)
    {


         $sql = "UPDATE man_incidencias SET 
                id_estado = 2,
                observaciones = $observaciones,
                fecha_ini_rep = CURDATE(),
                id_tec_atiende = $id_tec_atiende
                
                 WHERE
                id_incidencia = $incidenciaId";


        $this->connection->prepare($sql)->execute($row);
    }

    public function reabrirIncidencia($incidenciaId)
    {


         $sql = "UPDATE man_incidencias SET 
                id_estado = 1,
                fecha_ini_rep = NULL,
                fecha_fin_rep = NULL,
                horas = NULL

                 WHERE
                id_incidencia = $incidenciaId";


        $this->connection->prepare($sql)->execute($row);
    }

    public function reproIncidencia($incidenciaId)
    {


         $sql = "UPDATE man_incidencias SET 
                id_estado = 2,
                fecha_ini_rep = CURDATE(),
                fecha_fin_rep = NULL,
                horas = NULL

                 WHERE
                id_incidencia = $incidenciaId";


        $this->connection->prepare($sql)->execute($row);
    }

    public function cierraIncidencia($incidenciaId,$observaciones,$horas)
    {


         $sql = "UPDATE man_incidencias SET 
                id_estado = 3,
                fecha_fin_rep = CURDATE(),
                observaciones = $observaciones,
                horas = $horas
                
                 WHERE
                id_incidencia = $incidenciaId";


        $this->connection->prepare($sql)->execute($row);
    }

    public function getIncidenciaById(int $incidenciaId)
    {
        $row = [
            'id_incidencia' => $incidenciaId,
        ];

       $sql = "SELECT *
                    FROM man_incidencias 
                    WHERE id_incidencia = $incidenciaId;";

        $statement = $this->connection->prepare($sql);
        $statement->execute($row);

        $incidencia= $statement->fetch();

        if (!$incidencia) {
            throw new DomainException(sprintf('Incidencia not found: %s', $incidenciaId));
        }
        return $incidencia;
    }

    public function getIncidenciaByProf($id_profesor)
    {

       $sql = "SELECT i.id_incidencia, (SELECT p.nombre_completo FROM cpifp_profesor p WHERE p.id_profesor=id_profesor_crea) AS ProfCrea,
            (SELECT p.nombre_completo FROM cpifp_profesor p WHERE p.id_profesor=id_prof_modifica)  AS PofMod,
            (SELECT p.nombre_completo FROM cpifp_profesor p WHERE p.id_profesor=id_tec_atiende) AS TecAtiende,
            i.id_profesor_crea, i.descripcion, i.desc_tecnica,i.id_estado, es.estado, i.id_ubicacion, e.id_edificio, e.edificio,ub.ubicacion,
            CONCAT(e.edificio,' - ',ub.ubicacion) AS ubi_completa, i.observaciones, 
            DATE_FORMAT(i.fecha, '%d/%m/%y') AS fecha,i.nivel_urgencia,u.urgencia, DATE_FORMAT(i.fecha_ini_rep, '%d/%m/%y') AS fecha_ini_rep,
            DATE_FORMAT(i.fecha_fin_rep, '%d/%m/%y') AS fecha_fin_rep,i.horas, i.id_departamento,d.departamento, i.id_prof_modifica, i.id_tec_atiende
            FROM man_incidencias i
            LEFT JOIN man_urgencia u ON (nivel_urgencia = id_urgencia) 
            LEFT JOIN man_estado es USING (id_estado) 
            LEFT JOIN man_ubicacion ub USING (id_ubicacion)
            LEFT JOIN man_edificio e USING (id_edificio)
            LEFT JOIN cpifp_departamento d USING (id_departamento) 
       
            WHERE id_departamento = (SELECT id_departamento FROM cpifp_profesor_departamento WHERE id_profesor = $id_profesor AND id_rol= 30)
            ORDER BY i.fecha DESC";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();

        return $row;
    }

    public function getUrgenciaById(int $urgenciaId)
    {
        $row = [
            'id_urgencia' => $urgenciaId,
        ];

       $sql = "SELECT *
                    FROM man_urgencia 
                    WHERE id_urgencia = $urgenciaId;";

        $statement = $this->connection->prepare($sql);
        $statement->execute($row);

        $urgencia= $statement->fetch();

        if (!$urgencia) {
            throw new DomainException(sprintf('Urgencia not found: %s', $urgenciaId));
        }
        return $urgencia;
    }

    public function listEstados()
    {

        $sql = "SELECT * FROM man_estado";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

    public function listUrgencias()
    {

        $sql = "SELECT * FROM man_urgencia";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

    public function listEdificios()
    {

        $sql = "SELECT * FROM man_edificio";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

    public function listUbicaciones()
    {

       /* $sql = "SELECT ub.id_ubicacion,  CONCAT(e.edificio,' - ',ub.ubicacion) AS ubicacion 
        FROM man_ubicacion ub JOIN man_edificio e USING (id_edificio);";*/

        $sql = "SELECT * FROM man_ubicacion;";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

    public function addEdificio($edificio)
    {

        $row = [
            'edificio' => $edificio['edificio'],
        ];

        $sql = "INSERT INTO man_edificio SET 
                    edificio=:edificio";
                    

        $this->connection->prepare($sql)->execute($row);
        
        $idUltimoRegistroInsertado = (int)$this->connection->lastInsertId();

        return $idUltimoRegistroInsertado;
    }

    public function updateEdificio($edificio) 
    {
        $id = $edificio['id_edificio'];

        $row = [
            'edificio' => $edificio['edificio'],
        ];

            $sql = "UPDATE man_edificio SET 
                edificio=:edificio
                 WHERE
                id_edificio = $id";


        $this->connection->prepare($sql)->execute($row);
        
    }

    public function delEdificio($edificio)
    {

        $sql = "DELETE  FROM man_edificio
                    WHERE id_edificio = $edificio[id_edificio]";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

    }

    public function addUbicacion($ubicacion)
    {

        $row = [
            'ubicacion' => $ubicacion['ubicacion'],
            'id_edificio' => $ubicacion['id_edificio'],
        ];

        $sql = "INSERT INTO man_ubicacion SET 
                    ubicacion=:ubicacion,
                    id_edificio=:id_edificio";
                    

        $this->connection->prepare($sql)->execute($row);
        
        $idUltimoRegistroInsertado = (int)$this->connection->lastInsertId();

        return $idUltimoRegistroInsertado;
    }


    public function updateUbicacion($ubicacion) 
    {

        $row = [
            'ubicacion' => $ubicacion['ubicacion'],
        ];

            $sql = "UPDATE man_ubicacion SET 
                ubicacion=:ubicacion
                
                 WHERE id_ubicacion = $ubicacion[id_ubicacion]";


        $this->connection->prepare($sql)->execute($row);
        
    }

    public function delUbicacion($ubicacion)
    {

        $sql = "DELETE  FROM man_ubicacion
                    WHERE id_ubicacion = $ubicacion[id_ubicacion]";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

    }

    public function listAulas($edificioID)
    {

        $sql = "SELECT ub.id_ubicacion,ub.ubicacion, ub.id_edificio, e.edificio FROM man_ubicacion ub
                
        LEFT JOIN man_edificio e USING (id_edificio)
        WHERE id_edificio=$edificioID";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }
}