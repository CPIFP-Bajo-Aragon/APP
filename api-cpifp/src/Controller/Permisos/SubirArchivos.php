<?php

namespace App\Controller\Permisos;

use App\Model\PermisosService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class SubirArchivos
{
    private $service;

    public function __construct(PermisosService $service)
    {
        $this->service = $service;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {     
        $datosPost = (array)$request->getParsedBody();   //Cogemos los valores pasados por POST

        $id_profesor = $datosPost['id_profesor'];
        $id_permiso = $datosPost['id_permiso'];
        $archivos = $_FILES['archivosSubidos'];

        $rutaBase = './documentos';
        $ruta = './documentos/prof_'.$id_profesor;
        $rutaPermiso = './documentos/prof_'.$id_profesor.'/perm_'.$id_permiso;

        if(!file_exists($rutaBase)){
            mkdir($rutaBase,0755,true);
        }

        if(!file_exists($ruta)){
            mkdir($ruta,0755,true);
        }

        if(!file_exists($rutaPermiso)){
            mkdir($rutaPermiso,0755,true);
        }

        $result = 'OK';
        for ($i=0; $i < count($archivos['name']) ;$i++){
            if(move_uploaded_file($archivos['tmp_name'][$i], $rutaPermiso.'/'.$archivos['name'][$i])){
            } else {
                $result = 'KO';
            }
        }
        // $numArchivos = count($archivos['name']);

        // Obtenemos todos los archivos 
        $rutaPermiso = './documentos/prof_'.$id_profesor.'/perm_'.$id_permiso;
        $archivosPermiso = array_merge(array_diff(scandir($rutaPermiso), array('..', '.')));

        return $response->withJson($archivosPermiso)->withStatus(200);
    }
}