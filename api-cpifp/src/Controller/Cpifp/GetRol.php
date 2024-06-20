<?php

namespace App\Controller\Cpifp;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class GetRol
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }
    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {

        $profesorId = (int)$args['id_profesor'];

        $rol = $this->cpifpService->getRol($profesorId);

        return $response->withJson($rol)->withStatus(200);
    }
   
}