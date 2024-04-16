<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Expose-Headers: Content-Length, X-JSON");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type,X-Auth-Token, Accept,client-security-token, X-API-KEY, Access-Control-Request-Method");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('content-type: application/json; charset=utf-8');

// *****************************************************************************
//          CABECERAS NECESARIAS PARA REALIZAR API-REST
// *****************************************************************************


(require __DIR__ . '/../config/bootstrap.php')->run();
