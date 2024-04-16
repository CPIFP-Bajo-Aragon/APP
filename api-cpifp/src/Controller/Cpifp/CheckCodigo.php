<?php

namespace App\Controller\Cpifp;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class CheckCodigo
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }
    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {

        $email = (String)$args['email'];
        $codigo = (String)$args['codigo'];

        $profesor = $this->cpifpService->checkCodigo($email,$codigo);

        return $response->withJson($profesor)->withStatus(200);
    }
   
}