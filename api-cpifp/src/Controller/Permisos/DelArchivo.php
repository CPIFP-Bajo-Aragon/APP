<?php

namespace App\Controller\Permisos;

use App\Model\PermisosService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;


final class DelArchivo
{
    private $service;

    public function __construct(PermisosService $service)
    {
        $this->service = $service;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {     
        $datos = (array)$request->getParsedBody();   //Cogemos los valores pasados por POST

        // Eliminamos el archivo
        $rutaArchivoPermiso = './documentos/prof_'.$datos["permiso"]["id_profesor"].'/perm_'.$datos["permiso"]["id_permiso"].'/'.$datos["archivo"];
        unlink($rutaArchivoPermiso);

        // Obtenemos todos los archivos que quedan
        $rutaPermiso = './documentos/prof_'.$datos["permiso"]["id_profesor"].'/perm_'.$datos["permiso"]["id_permiso"];
        $archivosPermiso = array_merge(array_diff(scandir($rutaPermiso), array('..', '.')));


        return $response->withJson($archivosPermiso)->withStatus(200);
    }
}