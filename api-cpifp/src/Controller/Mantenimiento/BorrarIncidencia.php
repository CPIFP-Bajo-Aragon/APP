<?php

namespace App\Controller\Mantenimiento;

use App\Model\MantenimientoService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class BorrarIncidencia
{
    private $mantenimientoService;

    public function __construct(MantenimientoService $mantenimientoService)
    {
        $this->mantenimientoService = $mantenimientoService;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {     
        $incidencia = (array)$request->getParsedBody();   //Cogemos los valores pasados por POST

        $result = $this->mantenimientoService->borrarIncidencia($incidencia);

        return $response->withJson($result)->withStatus(201);
    }
}