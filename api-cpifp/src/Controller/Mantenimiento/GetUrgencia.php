<?php

namespace App\Controller\Mantenimiento;

use App\Model\MantenimientoService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class GetUrgencia
{
    private $mantenimientoService;

    public function __construct(MantenimientoService $mantenimientoService)
    {
        $this->mantenimientoService = $mantenimientoService;
    }

    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {

        $urgenciaId = (int)$args['id_urgencia'];

        $urgencia = $this->mantenimientoService->getUrgencia($urgenciaId);

        return $response->withJson($urgencia)->withStatus(200);
    }
}