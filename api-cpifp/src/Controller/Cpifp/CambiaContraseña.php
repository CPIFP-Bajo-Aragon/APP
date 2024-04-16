<?php

namespace App\Controller\Cpifp;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class CambiaContraseña
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }
    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {

        $password = (String)$args['password'];
        $profesorId = (int)$args['id_profesor'];

        $profesor = $this->cpifpService->updatePassword($password,$profesorId);

        return $response->withJson($profesor)->withStatus(201);
    }
   
}