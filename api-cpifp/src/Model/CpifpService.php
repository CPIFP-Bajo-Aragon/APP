<?php

namespace App\Model;

use App\Model\CpifpDataBase;
use UnexpectedValueException;

final class CpifpService
{
    private $dataBase;

    public function __construct(CpifpDataBase $dataBase)
    {
        $this->dataBase = $dataBase;
    }


    public function crearProfesor($profesor)
    {
        $id_profesor = $this->dataBase->addProfesor($profesor);

        return $id_profesor;
    }

    public function borrarProfesor($profesor)
    {
        $id_profesor = $this->dataBase->delProfesor($profesor);

        return $id_profesor;
    }

    public function modificarProfesor($profesor)
    {
        $id_profesor = $this->dataBase->updateProfesor($profesor);

        return $id_profesor;
    }

    public function updatePassword($password,$profesorId)
    {
        $id_profesor = $this->dataBase->updatePassword($password,$profesorId);

        return $profesorId;
    }

    public function Profesores()
    {
        $id_profesor = $this->dataBase->listProfesor();

        return $id_profesor;
    }

    public function tecnicos()
    {
        $id_profesor = $this->dataBase->listTecnicos();

        return $id_profesor;
    }


    public function checkLogin(string $login,string $password)
    {
        if (empty($login) || empty($password)) {
            throw new UnexpectedValueException('Login y Contraseña Obligatorio');
        }

        $profesor = $this->dataBase->checkLogin($login,$password);

        return $profesor;
    }

    public function checkEmail($email)
    {
        if (empty($email)) {
            throw new UnexpectedValueException('Email obligatorio');
        }

        $profesor = $this->dataBase->checkEmail($email);

        return $profesor;
    }

    public function insertCodigo($email,$codigo)
    {
        if (empty($email)) {
            throw new UnexpectedValueException('Email obligatorio');
        }

        $profesor = $this->dataBase->insertCodigo($email,$codigo);

        return $profesor;
    }

    public function checkCodigo($email,$codigo)
    {
        if (empty($email)) {
            throw new UnexpectedValueException('Email obligatorio');
        }

        $profesor = $this->dataBase->checkCodigo($email,$codigo);

        return $profesor;
    }

    public function recoveryPass($recovery)
    {

        $recovery = $this->dataBase->recoveryPass($recovery);

        return $recovery;
    }

    public function getProfesor(int $profesorId)
    {
        // Validation
        if (empty($profesorId)) {
            throw new UnexpectedValueException('Profesor ID required');
        }

        $profesor = $this->dataBase->getProfesorById($profesorId);

        return $profesor;
    }

    public function departamentos()
    {
        $id_departamento = $this->dataBase->listDepartamentos();

        return $id_departamento;
    }

    public function getDepartamentos($profesorId)
    {
        $id_departamento = $this->dataBase->getDepartamentos($profesorId);

        return $id_departamento;
    }

    public function getDepartamento($id_departamento)
    {
        $departamento = $this->dataBase->getDepartamento($id_departamento);

        return $departamento;
    }

    public function crearProfModulo($profesorModulo)
    {
        $profesorModulo = $this->dataBase->addProfModulo($profesorModulo);

        return $profesorModulo;
    }

    public function crearProfDepartamento($profDepartamento)
    {
        $profDepartamento = $this->dataBase->addProfDepartamento($profDepartamento);

        return $profDepartamento;
    }

    public function roles()
    {
        $id_rol = $this->dataBase->listRoles();

        return $id_rol;
    }

    public function ciclos()
    {
        $id_ciclo = $this->dataBase->listCiclos();

        return $id_ciclo;
    }

    public function profDep($departamentoId)
    {
        if (empty($departamentoId)) {
            throw new UnexpectedValueException('Departamento ID required');
        }
        $id_profDep = $this->dataBase->listProfDep($departamentoId);

        return $id_profDep;
    }

    public function modificarProfDep($profDep)
    {
        $id_prof_dep = $this->dataBase->updateProfDep($profDep);

        return $id_prof_dep;
    }

    public function borrarProfDep($profDep)
    {
        $id_profDep = $this->dataBase->delprofDep($profDep);

        return $id_profDep;
    }

    public function getRol(int $profesorId)
    {
        if (empty($profesorId)) {
            throw new UnexpectedValueException('Profesor ID required');
        }

        $rol = $this->dataBase->getRolById($profesorId);

        return $rol;
    }

    public function crearDepartamento($departamento)
    {
        $id_departamento = $this->dataBase->addDepartamento($departamento);

        return $id_departamento;
    }

    public function modificarDepartamento($departamento)
    {
        $id_departamento = $this->dataBase->updateDepartamento($departamento);

        return $id_departamento;
    }

    public function borrarDepartamento($departamento)
    {
        $id_departamento = $this->dataBase->delDepartamento($departamento);

        return $id_departamento;
    }

    public function crearCiclo($ciclo)
    {
        $id_ciclo = $this->dataBase->addCiclo($ciclo);

        return $id_ciclo;
    }

    public function modificarCiclo($ciclo)
    {
        $id_ciclo = $this->dataBase->updateCiclo($ciclo);

        return $id_ciclo;
    }

    public function borrarCiclo($ciclo)
    {
        $id_ciclo = $this->dataBase->delCiclo($ciclo);

        return $id_ciclo;
    }

    public function modulos($cicloID)
    {
        if (empty($cicloID)) {
            throw new UnexpectedValueException('Ciclo ID required');
        }
        $id_modulo = $this->dataBase->listModulos($cicloID);

        return $id_modulo;
    }
    
    public function crearModulo($modulo)
    {
        $modulo = $this->dataBase->addModulo($modulo);

        return $modulo;
    }

    public function modificarModulo($modulo)
    {
        $id_modulo = $this->dataBase->updateModulo($modulo);

        return $id_modulo;
    }

    public function borrarModulo($modulo)
    {
        $id_modulo = $this->dataBase->delModulo($modulo);

        return $id_modulo;
    }

    public function comunicacion()
    {
        $id_profDep = $this->dataBase->listComunicacion();

        return $id_profDep;
    }

    public function cursos($cicloID)
    {
        if (empty($cicloID)) {
            throw new UnexpectedValueException('Departamento ID required');
        }
        $id_curso = $this->dataBase->listCursos($cicloID);

        return $id_curso;
    }

}