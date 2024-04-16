<?php

namespace App\Model;

use DomainException;
use PDO;

class PermisosDataBase
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }



    public function getTiposPermiso()
    {

        $sql = "SELECT * FROM per_tipo_permiso
                        ORDER BY id_tipo_permiso";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }


    public function addPermiso($permiso)
    {
        $rowPermiso = [
            'id_profesor' => $permiso['id_profesor'],
            'id_tipo_permiso' => $permiso['tipo_permiso']['id_tipo_permiso'],
            'observaciones' => $permiso['observaciones'],
            'rango' => (int) $permiso['rango'],                // indicamos si las fechas son con rango inicio - fin
            'con_hora' => (int) $permiso['conHora']
        ];

        $sql = "INSERT INTO per_permisos SET 
                    fecha_solicitud=CURRENT_TIMESTAMP(), observaciones=:observaciones, id_profesor=:id_profesor,
                    id_tipo_permiso=:id_tipo_permiso, id_resolucion=3, rango=:rango, 
                    con_hora=:con_hora";

        $this->connection->prepare($sql)->execute($rowPermiso);
        
        $idUltimoRegistroInsertado = (int)$this->connection->lastInsertId();

        // Insertamos las fechas del permiso
        if ($rowPermiso['rango']){          // si las fechas estan indicadas como rango
            $rowHoraFechaPermiso = [
                'hora_inicio' => $permiso['horaInicio'],
                'hora_fin' => $permiso['horaFin'],
                'dia_inicio' => $permiso['fechasPermiso'][0],
                'dia_fin' => $permiso['fechasPermiso'][1],
                'id_permiso' => $idUltimoRegistroInsertado
            ];

            $sql = "INSERT INTO per_hora_fecha_permiso SET 
                    hora_inicio=:hora_inicio, hora_fin=:hora_fin, dia_inicio=:dia_inicio,
                    dia_fin=:dia_fin, id_permiso=:id_permiso";
            $this->connection->prepare($sql)->execute($rowHoraFechaPermiso);

        } else {
            for($i=0;$i<count($permiso['fechasPermiso']);$i++){
                $rowHoraFechaPermiso = [
                    'hora_inicio' => $permiso['horaInicio'],
                    'hora_fin' => $permiso['horaFin'],
                    'dia_inicio' => $permiso['fechasPermiso'][$i],
                    'id_permiso' => $idUltimoRegistroInsertado
                ];
    
                $sql = "INSERT INTO per_hora_fecha_permiso SET 
                        hora_inicio=:hora_inicio, hora_fin=:hora_fin, dia_inicio=:dia_inicio,
                        id_permiso=:id_permiso";
                $this->connection->prepare($sql)->execute($rowHoraFechaPermiso);
            }
        }
        

        return $idUltimoRegistroInsertado;
        // return $rowPermiso;
    }


    public function getEquipoDirectivo()
    {

        $sql = "SELECT * FROM cpifp_profesor p INNER JOIN cpifp_profesor_departamento pd 
                                                ON (p.id_profesor = pd.id_profesor)
                        WHERE id_rol = 50";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }


    public function getPermisosProfesor($id_profesor)
    {

        $sql = "SELECT p.*,r.*,tp.*,pr.nombre_completo FROM per_permisos p INNER JOIN per_resolucion r 
                                                    ON (p.id_resolucion = r.id_resolucion)
                                             INNER JOIN per_tipo_permiso tp 
                                                    ON (p.id_tipo_permiso = tp.id_tipo_permiso)
                                             LEFT JOIN cpifp_profesor pr 
                                                    ON (p.aprobado_por = pr.id_profesor)
                        WHERE p.id_profesor = $id_profesor
                        ORDER BY p.fecha_solicitud DESC";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }


    public function getFechasPermiso($id_permiso)
    {

        $sql = "SELECT * FROM per_hora_fecha_permiso 
                        WHERE id_permiso = $id_permiso";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }


    public function delPermiso($id_permiso)
    {

        $sql = "DELETE  FROM per_permisos
                    WHERE id_permiso = $id_permiso";

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return true;
    }


    public function getPermisosActivos()
    {

        $sql = "SELECT p.*,r.*,tp.*,pr_solicita.login,pr_solicita.nombre_completo,pr.nombre_completo validado_por FROM per_permisos p INNER JOIN per_resolucion r 
                                                    ON (p.id_resolucion = r.id_resolucion)
                                             INNER JOIN per_tipo_permiso tp 
                                                    ON (p.id_tipo_permiso = tp.id_tipo_permiso)
                                             INNER JOIN cpifp_profesor pr_solicita 
                                                    ON (p.id_profesor = pr_solicita.id_profesor)
                                             LEFT JOIN cpifp_profesor pr 
                                                    ON (p.aprobado_por = pr.id_profesor)
                        WHERE p.id_resolucion = 1 || p.id_resolucion = 3
                        ORDER BY p.fecha_solicitud DESC";   // obtenemos los Pendientes y los Aceptados

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }


    public function cambiarEstadoPermiso($permiso) 
    {
        $id_permiso = $permiso['id_permiso'];

        $row = [
            'id_resolucion' => $permiso['nuevoEstado'],
            'jefatura' => $permiso['observaciones_jefatura'],
        ];

            $sql = "UPDATE per_permisos SET 
                id_resolucion=:id_resolucion, jefatura=:jefatura
                 WHERE
                id_permiso = $id_permiso";


        return $this->connection->prepare($sql)->execute($row);
        
    }


    // Lista de todos los permisos con la cantidad que ha pedido dicho profesor
    public function getNumTiposPermisoProfesor($id_profesor)
    {

        $ahora = getdate();
        $numMes = $ahora['mon'];
        $anyo = $ahora['year'];

        // Establecemos la fecha inicio y fin del curso actual
        if($numMes >= 8){
            $fechaIni = "{$anyo}-08-01";
            $fechaFin = ($anyo+1)."-07-31";
        } else {
            $fechaIni = ($anyo-1)."-08-01";
            $fechaFin = "{$anyo}-07-31";
        }
        

        $sql = "SELECT tp.*, COUNT(p.id_profesor) count_tipo_permiso 
                FROM per_tipo_permiso tp 
                        LEFT JOIN (SELECT * 
                                    FROM per_permisos 
                                    WHERE id_profesor = $id_profesor
                                        AND fecha_solicitud BETWEEN CAST('$fechaIni'AS DATE) AND CAST('$fechaFin' AS DATE)
                                        AND id_resolucion IN (1,3,5)) p
                            ON (tp.id_tipo_permiso = p.id_tipo_permiso)
                GROUP BY tp.id_tipo_permiso
                ORDER BY tp.id_tipo_permiso";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }



    public function numCoincidentesEnFechaAceptadoCerrado($id_tipo_permiso,$dia_inicio)
    {

        $sql = "SELECT COUNT(*) num_coincidentes_aceptado_cerrado
                FROM per_permisos p INNER JOIN per_hora_fecha_permiso f
                        ON (p.id_permiso = f.id_permiso)
                WHERE p.id_tipo_permiso = $id_tipo_permiso
                        AND f.dia_inicio = '$dia_inicio'
                        AND p.id_resolucion IN (1,5)";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row[0]['num_coincidentes_aceptado_cerrado'];
    }


    public function numCoincidentesEnFechaPendiente($id_tipo_permiso,$dia_inicio)
    {

        $sql = "SELECT COUNT(*) num_coincidentes_pendiente
                FROM per_permisos p INNER JOIN per_hora_fecha_permiso f
                        ON (p.id_permiso = f.id_permiso)
                WHERE p.id_tipo_permiso = $id_tipo_permiso
                        AND f.dia_inicio = '$dia_inicio'
                        AND p.id_resolucion IN (3)";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row[0]['num_coincidentes_pendiente'];
    }



    public function getTodosPermisos()
    {

        $sql = "SELECT p.*,r.*,tp.*,pr_solicita.login,pr_solicita.nombre_completo,pr.nombre_completo validado_por FROM per_permisos p INNER JOIN per_resolucion r 
                                                    ON (p.id_resolucion = r.id_resolucion)
                                             INNER JOIN per_tipo_permiso tp 
                                                    ON (p.id_tipo_permiso = tp.id_tipo_permiso)
                                             INNER JOIN cpifp_profesor pr_solicita 
                                                    ON (p.id_profesor = pr_solicita.id_profesor)
                                             LEFT JOIN cpifp_profesor pr 
                                                    ON (p.aprobado_por = pr.id_profesor)
                        ORDER BY p.fecha_solicitud DESC";   // obtenemos los Pendientes y los Aceptados

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $row = $statement->fetchAll();
 
        return $row;
    }

}