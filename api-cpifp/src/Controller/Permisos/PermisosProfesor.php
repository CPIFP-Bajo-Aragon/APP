<?php

namespace App\Controller\Permisos;

use App\Model\PermisosService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class PermisosProfesor
{
    private $service;

    public function __construct(PermisosService $service)
    {
        $this->service = $service;
    }
    

    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {

        $id_profesor = (int)$args['id_profesor'];
        $permisosProfesor = $this->service->getPermisosProfesor($id_profesor);

        // Buscamos los archivos que tenga el permiso
        $rutaBase = './documentos';
        $ruta = './documentos/prof_'.$id_profesor;
        for($i = 0 ; $i < count($permisosProfesor) ; $i++){
            $rutaPermiso = './documentos/prof_'.$id_profesor.'/perm_'.$permisosProfesor[$i]['id_permiso'];
            $permisosProfesor[$i]['ruta'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/documentos/prof_'.$id_profesor.'/perm_'.$permisosProfesor[$i]['id_permiso'].'/';
            // $permisosProfesor[$i]['archivos'] = array();

            if(file_exists($rutaPermiso)){
                // $permisosProfesor[$i]['archivos'] = scandir($rutaPermiso);
                $permisosProfesor[$i]['archivos'] = array_merge(array_diff(scandir($rutaPermiso), array('..', '.'))); // buscamos los archivos del directorio y le quitamos el .. y . // y con merge indexamos desde 0
                // for($j = 0 ; $j < count($permisosProfesor[$i]['archivos']) ; $j++){
                //     $permisosProfesor[$i]['archivos'][$j] = $_SERVER['HTTP_HOST'].'/'.$permisosProfesor[$i]['archivos'][$j];
                // }
                // $permisosProfesor[$i]['archivos']['ruta'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/documentos/prof_'.$id_profesor.'/perm_'.$permisosProfesor[$i]['id_permiso'].'/';
            } else {
                $permisosProfesor[$i]['archivos'] = [];
            }
        }

        return $response->withJson($permisosProfesor)->withStatus(200);
    }
   
}