<?php

namespace App\Controller\Mantenimiento;

use App\Model\MantenimientoService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class AtenderIncidencia
{
    private $mantenimientoService;

    public function __construct(MantenimientoService $mantenimientoService)
    {
        $this->mantenimientoService = $mantenimientoService;
    }

    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {     
        $incidenciaId = (int)$args['id_incidencia'];
        $observaciones = (String)$args['observaciones'];
        $id_tec_atiende = (int)$args['id_tec_atiende'];

        $incidencia = $this->mantenimientoService->atiendeIncidencia($incidenciaId,$observaciones,$id_tec_atiende);

        return $response->withJson($incidencia)->withStatus(201);
    }
}