<?php

namespace App\Controller\Cpifp;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class Profesores
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {     
        $result = $this->cpifpService->profesores();

        return $response->withJson($result)->withStatus(200);
    }
}
