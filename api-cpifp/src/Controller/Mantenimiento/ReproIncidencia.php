<?php

namespace App\Controller\Mantenimiento;

use App\Model\MantenimientoService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class ReproIncidencia
{
    private $mantenimientoService;

    public function __construct(MantenimientoService $mantenimientoService)
    {
        $this->mantenimientoService = $mantenimientoService;
    }

    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {     
        $incidenciaId = (int)$args['id_incidencia'];

        $incidencia = $this->mantenimientoService->reproIncidencia($incidenciaId);

        return $response->withJson($incidencia)->withStatus(201);
    }
}