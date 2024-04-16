<?php

namespace App\Controller\Permisos;

use App\Model\PermisosService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class GetTiposPermiso
{
    private $service;

    public function __construct(PermisosService $service)
    {
        $this->service = $service;
    }
    
    public function __invoke(ServerRequest $request, Response $response,array $args = []): Response
    {
        $id_profesor = (int)$args['id_profesor'];

        $numTiposPermisos = $this->service->getNumTiposPermisoProfesor($id_profesor);

        // $tiposPermisos = $this->service->getTiposPermiso();

        return $response->withJson($numTiposPermisos)->withStatus(200);
    }
   
}