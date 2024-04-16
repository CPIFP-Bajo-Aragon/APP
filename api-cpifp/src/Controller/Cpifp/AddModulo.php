<?php

namespace App\Controller\Cpifp;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class AddModulo
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {     
        $modulo = (array)$request->getParsedBody();   //Cogemos los valores pasados por POST

        $result = $this->cpifpService->crearModulo($modulo);

        return $response->withJson($result)->withStatus(201);
    }
}