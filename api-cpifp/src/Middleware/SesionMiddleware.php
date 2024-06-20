<?php

namespace App\Middleware;

use App\Auth\Sesion;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;


final class SesionMiddleware implements MiddlewareInterface
{

    private $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }


    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // $authorization = explode(' ', (string)$request->getHeaderLine('Authorization'));
        // $token = $authorization[1] ?? '';

        // if (!Sesion::sesionCreada()){
        //     return $this->responseFactory->createResponse()
        //         ->withHeader('Content-Type', 'application/json')
        //         ->withStatus(401, 'Unauthorized');
        // }

        // Append valid token
        // $parsedToken = $this->jwtAuth->createParsedToken($token);
        // $request = $request->withAttribute('token', $parsedToken);

        // Append the user id as request attribute
        // $request = $request->withAttribute('uid', $parsedToken->getClaim('uid'));
            
/////////////////////////////////////////////// IMPORTANTE ////////////////////////////////////////////////////
//////// No se esta validando el login con el Middleware, esta en fase de modificación /////////////////////// 
        return $handler->handle($request);
    }
}
