<?php

namespace App\Controller\Cpifp;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class RecoveryPass
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {     
        $recovery = (array)$request->getParsedBody();   //Cogemos los valores pasados por POST

        $result = $this->cpifpService->recoveryPass($recovery);

        return $response->withJson($result)->withStatus(201);
    }
  /*  public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {

        $email = (String)$args['email'];
        $codigo = (String)$args['codigo'];
        $password = (String)$args['password'];

        $profesor = $this->cpifpService->recoveryPass($email,$codigo,$password);

        return $response->withJson($profesor)->withStatus(200);
    }*/
   
}