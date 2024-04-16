<?php

namespace App\Controller\Cpifp;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class GetDepartamentos
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }
    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {

        $profesorId = (int)$args['id_profesor'];

        $profesor = $this->cpifpService->getDepartamentos($profesorId);

        return $response->withJson($profesor)->withStatus(200);
    }
   
}