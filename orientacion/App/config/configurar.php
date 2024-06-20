<?php
//** Desarrollo */
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
//** Desarrollo */


// Ruta de la aplicacion	
define('RUTA_APP', dirname(dirname(__FILE__)));

// Ruta url, Ejemplo: http://localhost/atletismo
define('RUTA_URL', '/orientacion');

define('NOMBRE_SITIO', 'Web de Asesoria de Orientación');


// Configuracion de la Base de Datos
define('DB_HOST', 'localhost');
define('DB_USUARIO', 'root');
define('DB_PASSWORD', 'root');
// define('DB_USUARIO', 'app_cpifp');
// define('DB_PASSWORD', 'app_cpifp!');
define('DB_NOMBRE', 'cpifp_bajoaragon');


// Configuracion de correo
define('EmailEmisor','noreply@cpifpbajoaragon.com');
define('EmailPass','kvAPuHCKX9NSDZts$$py');
define('Emisor','CPIFP Bajo Aragón');
define('Host','smtp.ionos.es');
define('SMTPSecure','TLS');
define('Puerto',587);

// Configuracion Tamaño de pagina en la paginacion
define('TAM_PAGINA', 20);
