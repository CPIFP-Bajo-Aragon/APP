<?php

namespace App\Controller\Mantenimiento;

use App\Model\MantenimientoService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class IncidenciaJefe
{
    private $mantenimientoService;

    public function __construct(MantenimientoService $mantenimientoService)
    {
        $this->mantenimientoService = $mantenimientoService;
    }
    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {

        $id_profesor = (int)$args['id_profesor'];

        $incidencia = $this->mantenimientoService->getIncidenciaByProf($id_profesor);

        return $response->withJson($incidencia)->withStatus(200);
    }
   
}