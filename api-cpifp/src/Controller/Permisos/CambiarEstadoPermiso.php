<?php

namespace App\Controller\Permisos;

use App\Model\PermisosService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class CambiarEstadoPermiso
{
    private $service;

    public function __construct(PermisosService $service)
    {
        $this->service = $service;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {     
        $permiso = (array)$request->getParsedBody();   //Cogemos los valores pasados por POST

        $result = $this->service->cambiarEstadoPermiso($permiso);

        return $response->withJson($result)->withStatus(200);
    }
}