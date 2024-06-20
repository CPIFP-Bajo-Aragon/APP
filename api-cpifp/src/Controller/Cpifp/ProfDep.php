<?php

namespace App\Controller\Cpifp;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class ProfDep
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }

    public function __invoke(ServerRequest $request, Response $response,array $args = []): Response
    {     
        $departamentoId = (int)$args['id_departamento'];
        $result = $this->cpifpService->profDep($departamentoId);

        return $response->withJson($result)->withStatus(200);
    }
}