<?php

namespace App\Model;

use App\Model\PermisosDataBase;
use UnexpectedValueException;

final class PermisosService
{
    private $dataBase;

    public function __construct(PermisosDataBase $dataBase)
    {
        $this->dataBase = $dataBase;
    }


    public function getTiposPermiso()
    {
        $tiposPermisos = $this->dataBase->getTiposPermiso();

        return $tiposPermisos;
    }


    public function addPermiso($permiso)
    {
        $result = $this->dataBase->addPermiso($permiso);

        return $result;
    }

    public function getEquipoDirectivo()
    {
        $result = $this->dataBase->getEquipoDirectivo();

        return $result;
    }


    public function getPermisosProfesor($id_profesor)
    {
        $result = $this->dataBase->getPermisosProfesor($id_profesor);
        
        for($i=0;$i < count($result);$i++){
            $result[$i]['fechasPermiso'] = $this->dataBase->getFechasPermiso($result[$i]['id_permiso']);
        }
        return $result;
    }

    public function delPermiso($id_permiso)
    {
        $result = $this->dataBase->delPermiso($id_permiso);

        return $result;
    }


    public function getPermisosActivos()
    {
        $result = $this->dataBase->getPermisosActivos();
        
        for($i=0;$i < count($result);$i++){
            $result[$i]['fechasPermiso'] = $this->dataBase->getFechasPermiso($result[$i]['id_permiso']);
            if($result[$i]['num_coincidentes'] > 0){
                $result[$i]['coincidentesAceptCerrado'] = $this->dataBase->numCoincidentesEnFechaAceptadoCerrado($result[$i]['id_tipo_permiso'],$result[$i]['fechasPermiso']['0']['dia_inicio']);
                $result[$i]['coincidentesPendiente'] = $this->dataBase->numCoincidentesEnFechaPendiente($result[$i]['id_tipo_permiso'],$result[$i]['fechasPermiso']['0']['dia_inicio']);
            } else {
                $result[$i]['coincidentesAceptCerrado'] = -1;
                $result[$i]['coincidentesPendiente'] = -1;
            }
        }
        return $result;
    }


    public function cambiarEstadoPermiso($permiso)
    {
        $result = $this->dataBase->cambiarEstadoPermiso($permiso);

        return $result;
    }


    public function getNumTiposPermisoProfesor($id_profesor)
    {
        $result = $this->dataBase->getNumTiposPermisoProfesor($id_profesor);

        return $result;
    }


    public function getTodosPermisos()
    {
        $result = $this->dataBase->getTodosPermisos();
        
        for($i=0;$i < count($result);$i++){
            $result[$i]['fechasPermiso'] = $this->dataBase->getFechasPermiso($result[$i]['id_permiso']);
            $result[$i]['fecha_primer_dia'] = $result[$i]['fechasPermiso'][0]['dia_inicio'];
            if($result[$i]['num_coincidentes'] > 0){
                $result[$i]['coincidentesAceptCerrado'] = $this->dataBase->numCoincidentesEnFechaAceptadoCerrado($result[$i]['id_tipo_permiso'],$result[$i]['fechasPermiso']['0']['dia_inicio']);
                $result[$i]['coincidentesPendiente'] = $this->dataBase->numCoincidentesEnFechaPendiente($result[$i]['id_tipo_permiso'],$result[$i]['fechasPermiso']['0']['dia_inicio']);
            } else {
                $result[$i]['coincidentesAceptCerrado'] = -1;
                $result[$i]['coincidentesPendiente'] = -1;
            }
        }
        return $result;
    }
}