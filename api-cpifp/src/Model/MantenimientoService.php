<?php

namespace App\Model;

use App\Model\MantenimientoDataBase;
use UnexpectedValueException;

final class MantenimientoService
{
    private $dataBase;

    public function __construct(MantenimientoDataBase $dataBase)
    {
        $this->dataBase = $dataBase;
    }


    public function incidencias()
    {
        $incidencias = $this->dataBase->listIncidencias();

        return $incidencias;
    }

    public function crearIncidencia($incidencia)
    {
        $id_incidencia = $this->dataBase->addIncidencia($incidencia);

        return $id_incidencia;
    }

    public function modificarIncidencia($incidencia)
    {
        $id_incidencia = $this->dataBase->updateIncidencia($incidencia);

        return $id_incidencia;
    }
    public function borrarIncidencia($incidencia)
    {
        $id_incidencia = $this->dataBase->delIncidencia($incidencia);

        return $id_incidencia;
    }

    public function atiendeIncidencia($incidenciaId,$observaciones,$id_tec_atiende)
    {
        $incidenciaId = $this->dataBase->atiendeIncidencia($incidenciaId,$observaciones,$id_tec_atiende);

        return $incidenciaId;
    }

    public function reabrirIncidencia($incidenciaId)
    {
        $incidenciaId = $this->dataBase->reabrirIncidencia($incidenciaId);

        return $incidenciaId;
    }

    public function reproIncidencia($incidenciaId)
    {
        $incidenciaId = $this->dataBase->reproIncidencia($incidenciaId);

        return $incidenciaId;
    }

    public function cierraIncidencia($incidenciaId,$observaciones,$horas)
    {
        $incidenciaId = $this->dataBase->cierraIncidencia($incidenciaId,$observaciones,$horas);

        return $incidenciaId;
    }

    public function getIncidencia(int $incidenciaId)
    {
        // Validation
        if (empty($incidenciaId)) {
            throw new UnexpectedValueException('Incidencia ID required');
        }

        $incidencia = $this->dataBase->getIncidenciaById($incidenciaId);

        return $incidencia;
    }

    public function getIncidenciaByProf($id_profesor)
    {
        // Validation
        if (empty($id_profesor)) {
            throw new UnexpectedValueException('Profesor ID required');
        }

        $incidencia = $this->dataBase->getIncidenciaByProf($id_profesor);

        return $incidencia;
    }

    public function getUrgencia(int $urgenciaId)
    {
        // Validation
        if (empty($urgenciaId)) {
            throw new UnexpectedValueException('Urgencia ID required');
        }

        $urgencia = $this->dataBase->getUrgenciaById($urgenciaId);

        return $urgencia;
    }

    public function estados()
    {
        $estados = $this->dataBase->listEstados();

        return $estados;
    }

    public function urgencias()
    {
        $urgencias = $this->dataBase->listUrgencias();

        return $urgencias;
    }

    public function ubicaciones()
    {
        $ubicaciones = $this->dataBase->listUbicaciones();

        return $ubicaciones;
    }

    public function edificios()
    {
        $edificios = $this->dataBase->listEdificios();

        return $edificios;
    }

    public function crearEdificio($edificio)
    {
        $id_edificio = $this->dataBase->addEdificio($edificio);

        return $id_edificio;
    }

    public function modificarEdificio($edificio)
    {
        $id_edificio = $this->dataBase->updateEdificio($edificio);

        return $id_edificio;
    }

    public function borrarEdificio($edificio)
    {
        $id_edificio = $this->dataBase->delEdificio($edificio);

        return $id_edificio;
    }

    public function crearUbicacion($ubicacion)
    {
        $id_ubicacion = $this->dataBase->addUbicacion($ubicacion);

        return $id_ubicacion;
    }

    public function modificarUbicacion($ubicacion)
    {
        $id_ubicacion = $this->dataBase->updateUbicacion($ubicacion);

        return $id_ubicacion;
    }

    public function borrarUbicacion($ubicacion)
    {
        $id_ubicacion = $this->dataBase->delUbicacion($ubicacion);

        return $id_ubicacion;
    }

    public function getAulas($edificioID)
    {
        $id_ubicacion = $this->dataBase->listAulas($edificioID);

        return $id_ubicacion;
    }
}