<?php

namespace App\Controller\Mantenimiento;

use App\Model\MantenimientoService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class CerrarIncidencia
{
    private $mantenimientoService;

    public function __construct(MantenimientoService $mantenimientoService)
    {
        $this->mantenimientoService = $mantenimientoService;
    }

    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {     
        //$incidenciaAtendida = (array)$request->getParsedBody();   
        $incidenciaId = (int)$args['id_incidencia'];
        $observaciones = (String)$args['observaciones'];
        $horas = (int)$args['horas'];

        $incidencia = $this->mantenimientoService->cierraIncidencia($incidenciaId,$observaciones,$horas);

        return $response->withJson($incidencia)->withStatus(201);
    }
}