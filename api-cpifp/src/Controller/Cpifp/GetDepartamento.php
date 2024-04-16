<?php

namespace App\Controller\Cpifp;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class GetDepartamento
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }
    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {

        $id_departamento = (int)$args['id_departamento'];

        $departamento = $this->cpifpService->getDepartamento($id_departamento);

        return $response->withJson($departamento)->withStatus(200);
    }
   
}