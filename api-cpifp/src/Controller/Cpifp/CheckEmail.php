<?php

namespace App\Controller\Cpifp;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class CheckEmail
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }
    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {

        $email = (String)$args['email'];

        $profesor = $this->cpifpService->checkEmail($email);

        return $response->withJson($profesor)->withStatus(200);
    }
   
}