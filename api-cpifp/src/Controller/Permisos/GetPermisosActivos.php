<?php

namespace App\Controller\Permisos;

use App\Model\PermisosService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class GetPermisosActivos
{
    private $service;

    public function __construct(PermisosService $service)
    {
        $this->service = $service;
    }
    
    public function __invoke(ServerRequest $request, Response $response): Response
    {

        $permisosActivos = $this->service->getPermisosActivos();


        $rutaBase = './documentos';
        for($i = 0 ; $i < count($permisosActivos) ; $i++){
            $ruta = './documentos/prof_'.$permisosActivos[$i]['id_profesor'];
            $rutaPermiso = './documentos/prof_'.$permisosActivos[$i]['id_profesor'].'/perm_'.$permisosActivos[$i]['id_permiso'];
            $permisosActivos[$i]['ruta'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/documentos/prof_'.$permisosActivos[$i]['id_profesor'].'/perm_'.$permisosActivos[$i]['id_permiso'].'/';

            if(file_exists($rutaPermiso)){
                $permisosActivos[$i]['archivos'] = array_merge(array_diff(scandir($rutaPermiso), array('..', '.'))); // buscamos los archivos del directorio y le quitamos el .. y . // y con merge indexamos desde 0
            } else {
                $permisosActivos[$i]['archivos'] = [];
            }
        }

        return $response->withJson($permisosActivos)->withStatus(200);
    }
   
}