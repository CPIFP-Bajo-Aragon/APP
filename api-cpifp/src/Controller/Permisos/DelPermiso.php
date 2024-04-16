<?php

namespace App\Controller\Permisos;

use App\Model\PermisosService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class DelPermiso
{
    private $service;

    public function __construct(PermisosService $service)
    {
        $this->service = $service;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {     
        $permiso = (array)$request->getParsedBody();   //Cogemos los valores pasados por POST

        $result = $this->service->delPermiso($permiso['id_permiso']);

        if ($result){
            $rutaPermiso = './documentos/prof_'.$permiso["id_profesor"].'/perm_'.$permiso["id_permiso"];
              foreach(glob($rutaPermiso . "/*") as $archivos_carpeta){             
                unlink($archivos_carpeta);
              }
              rmdir($rutaPermiso);
        }
        return $response->withJson($result)->withStatus(200);
    }
}