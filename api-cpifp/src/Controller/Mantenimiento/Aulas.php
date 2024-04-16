<?php

namespace App\Controller\Mantenimiento;

use App\Model\MantenimientoService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class Aulas
{
    private $mantenimientoService;

    public function __construct(MantenimientoService $mantenimientoService)
    {
        $this->mantenimientoService = $mantenimientoService;
    }
    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {

        $edificioID = (int)$args['id_edificio'];

        $aulas = $this->mantenimientoService->getAulas($edificioID);

        return $response->withJson($aulas)->withStatus(200);
    }
   
}