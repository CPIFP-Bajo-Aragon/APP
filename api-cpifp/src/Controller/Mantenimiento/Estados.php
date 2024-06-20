<?php

namespace App\Controller\Mantenimiento;

use App\Model\MantenimientoService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class Estados
{
    private $mantenimientoService;

    public function __construct(MantenimientoService $mantenimientoService)
    {
        $this->mantenimientoService = $mantenimientoService;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {     
        $result = $this->mantenimientoService->estados();

        return $response->withJson($result)->withStatus(200);
    }
}