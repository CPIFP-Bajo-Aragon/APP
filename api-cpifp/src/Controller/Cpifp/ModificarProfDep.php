<?php

namespace App\Controller\Cpifp;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class ModificarProfDep
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {     
        $profDep = (array)$request->getParsedBody();   //Cogemos los valores pasados por POST

        $result = $this->cpifpService->modificarProfDep($profDep);

        return $response->withJson($result)->withStatus(201);
    }
}