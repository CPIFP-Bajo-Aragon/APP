<?php

namespace App\Controller\Cpifp;

use App\Auth\Sesion;

use App\Model\CpifpService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class LoginToken
{
    private $cpifpService;

    public function __construct(CpifpService $cpifpService)
    {
        $this->cpifpService = $cpifpService;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $data = (array)$request->getParsedBody();

        $login = (string)($data['login'] ?? '');
        $password = (string)($data['password'] ?? '');
        
        // Validamos login
        $userLogin = $this->cpifpService->checkLogin($login, $password);   //si no logea, devolvera un profesor vacio

        if (!$userLogin) {
            // Invalid authentication credentials
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401, 'Unauthorized');
        }
        
        Sesion::crearSesion($userLogin);    //Creamos la sesion

        $result = [
            'id_profesor' => $userLogin['id_profesor'],
            'login' => $userLogin['login'],
            'email' => $userLogin['email'],
            'nombre_completo' => $userLogin['nombre_completo'],
            'access_token' => session_id(),
            'expires_in' => session_get_cookie_params()['lifetime'],
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(200);
    }
}
