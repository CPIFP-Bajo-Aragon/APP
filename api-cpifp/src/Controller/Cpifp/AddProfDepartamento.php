<?php

namespace App\Controller\Cpifp;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class AddProfDepartamento
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {     
        $profDepartamento = (array)$request->getParsedBody();   //Cogemos los valores pasados por POST

        $result = $this->cpifpService->crearProfDepartamento($profDepartamento);

        return $response->withJson($result)->withStatus(201);
    }
}