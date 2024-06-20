<?php

namespace App\Controller\Permisos;

use App\Model\PermisosService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use App\Email\EnviarEmail;


final class EnviarEmailPermiso
{
    private $service;
    private $serviceEmail;

    public function __construct(PermisosService $service, EnviarEmail $serviceEmail)
    {
        $this->service = $service;
        $this->serviceEmail = $serviceEmail;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $datosPermiso = (array)$request->getParsedBody();
        // $equipoDirectivo = $this->service->getEquipoDirectivo();

        // emisor y receptor
        $from = $datosPermiso['profesor']['email'];
        $nombreFrom = $datosPermiso['profesor']['nombre_completo']." - CPIFP Bajo Aragón";

        $nombreTo = 'Jefatura de Estudios';
        $to = 'jsegurana@cpifpbajoaragon.com';        // Cambiar en produccion y poner el de jefatura

        // for($i=0;$i < count($equipoDirectivo);$i++){
        //     $to = $equipoDirectivo[$i]['email'];
        //     $nombreTo = $equipoDirectivo[$i]['nombre_completo'];
        //     $respuesta = $this->serviceEmail->sendEmail($to,$nombreTo,$asunto,$cuerpo,false,$from,$nombreFrom);
        // }


        // Asunto
        if($datosPermiso['accion'] == 'eliminar'){
            $asunto = 'Permiso eliminado de: '.$datosPermiso['profesor']['nombre_completo'];
        } else if ($datosPermiso['accion'] == 'crear') {
            $asunto = 'Permiso solicitado de: '.$datosPermiso['profesor']['nombre_completo'];
        } else {
            $asunto = 'Su permiso ha cambiado de estado';
        }

        ////////////////////////////////// Creamos el cuerpo ///////////////////////////////////////

        if($datosPermiso['accion'] == 'eliminar'){      // cuerpo de mensaje eliminar
            $cuerpo = 'Eliminado el permiso de: <strong>'.$datosPermiso['profesor']['nombre_completo'].'</strong>';
            $cuerpo .= '<br><br>Permiso: <strong>'.$datosPermiso['tipo'].'.- '.$datosPermiso['descripcion'].'</strong>';                                        
        } else if ($datosPermiso['accion'] == 'crear') {        // cuerpo de mensaje crear permiso
            $diasPermiso = '';
            if ($datosPermiso['rango']){
                $diasPermiso .= 'De ' .$datosPermiso['fechasPermiso'][0].' a '.$datosPermiso['fechasPermiso'][1];
            } else {
                for($i=0;$i < count($datosPermiso['fechasPermiso']);$i++){
                    if($i == count($datosPermiso['fechasPermiso']) - 1){        // para no añadir la coma final
                        $diasPermiso .= $datosPermiso['fechasPermiso'][$i];
                    } else {
                        $diasPermiso .= $datosPermiso['fechasPermiso'][$i].', ';
                    }
                }
            }


            $cuerpo = 'Solicitud de permiso de: <strong>'.$datosPermiso['profesor']['nombre_completo'].'</strong> para los dias: '.$diasPermiso;
            
            $horasPermiso = '';

            if ($datosPermiso['conHora']){
                $cuerpo .= '<br><br> Las horas: '.$datosPermiso['horaInicio'].' - '.$datosPermiso['horaFin'];
            }

            $cuerpo .= '<br><br>Permiso: <strong>'.$datosPermiso['tipo_permiso']['tipo'].'.- '.$datosPermiso['tipo_permiso']['descripcion'].'</strong>';

            if ($datosPermiso['observaciones']){
                $cuerpo .= '<br><br> Observaciones: '.$datosPermiso['observaciones'];
            }
        } else {
            $cuerpo = 'Cambiado estado del permiso de: <strong>'.$datosPermiso['profesor']['nombre_completo'].'</strong>';
            $cuerpo .= '<br><br>Permiso: <strong>'.$datosPermiso['tipo'].'.- '.$datosPermiso['descripcion'].'</strong>';
            
            // Cambiamos el orden de emisosr y receptor
            $To = $datosPermiso['profesor']['email'];
            $nombreTo = $datosPermiso['profesor']['nombre_completo']." - CPIFP Bajo Aragón";

            $nombreFrom = 'Jefatura de Estudios';
            $from = 'jefatura@cpifpbajoaragon.com';        // Cambiar en produccion y poner el de jefatura
        }

        
        $respuesta = $this->serviceEmail->sendEmail($to,$nombreTo,$asunto,$cuerpo,false,$from,$nombreFrom);


        return $response->withJson($respuesta)->withStatus(200);
    }

}