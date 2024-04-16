<?php

namespace App\Controller\Cpifp;

use Slim\Http\Response;
use Slim\Http\ServerRequest;

use App\Email\EnviarEmail;


final class EnviarCodigo
{
    private $serviceEmail;

    public function __construct(EnviarEmail $serviceEmail)
    {
        $this->serviceEmail = $serviceEmail;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $datosPOST = (array)$request->getParsedBody();
        $user = $datosPOST['user'];
        $asunto = $datosPOST['asunto'];
        $email = $datosPOST['email'];
        $textoEmail = $datosPOST['textoEmail'];
        $remitente = $datosPOST['remitente'];
        
        

        $to = $email;
        $nombreTo = $user;
        $asunto = $asunto;
        $cuerpo = $textoEmail;
        $from="cpifpbajoaragon.root@gmail.com";
        $nombreFrom= "$remitente - CPIFP Bajo Aragón";
        $respuesta = $this->serviceEmail->sendEmail($to,$nombreTo,$asunto,$cuerpo,true,$from,$nombreFrom);
        

        return $response->withJson($respuesta)->withStatus(200);

    }

}