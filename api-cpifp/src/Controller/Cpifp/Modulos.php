<?php

namespace App\Controller\Cpifp;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class Modulos
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }

    public function __invoke(ServerRequest $request, Response $response,array $args = []): Response
    {     
        $cicloID = (int)$args['id_ciclo'];
        $result = $this->cpifpService->modulos($cicloID);

        return $response->withJson($result)->withStatus(200);
    }
}