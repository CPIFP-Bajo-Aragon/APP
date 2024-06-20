<?php

namespace App\Controller\Mantenimiento;

use App\Model\MantenimientoService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class Edificios
{
    private $mantenimientoService;

    public function __construct(MantenimientoService $mantenimientoService)
    {
        $this->mantenimientoService = $mantenimientoService;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {     
        $result = $this->mantenimientoService->edificios();

        return $response->withJson($result)->withStatus(200);
    }
}