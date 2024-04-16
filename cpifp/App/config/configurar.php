<?php
// Ruta de la aplicacion
define('RUTA_APP', dirname(dirname(__FILE__)));

//ruta app seguimiento
//define('RUTA_SEGUIMIENTO', dirname(dirname(dirname(dirname(__FILE__)))).'/seguimiento' );


// Ruta url, Ejemplo: http://localhost/daw2_mvc
//define('RUTA_URL', "https://{$_SERVER['HTTP_HOST']}/tragamillas");

// Ruta local
//define('RUTA_URL', "http://localhost/cpifp");
define('RUTA_URL', "/cpifp");
define('NOMBRE_SITIO', 'cpifp');

// define('RUTA_SEGUIMIENTO', "/APP_CPIFP/seguimiento/profeSegui");
define('RUTA_LOGOUT', "/cpifp/login/logout");
// define('RUTA_REPARTO', "http://localhost/seguimiento/jefeDep");
// define('RUTA_CURSO', "http://localhost/seguimiento/direccion");

// Conf DDBB

define('DB_HOST', 'localhost');
define('DB_USUARIO', 'root');
define('DB_PASSWORD', 'root');
// define('DB_USUARIO', 'app_cpifp');
// define('DB_PASSWORD', 'app_cpifp!');

define('DB_NOMBRE', 'cpifp_bajoaragon');


define('RUTA_Icon', RUTA_URL . '/public/img/icons/');

// Configuracion de correo
define('EmailEmisor','noreply@cpifpbajoaragon.com');
define('EmailPass','kvAPuHCKX9NSDZts$$py');
define('Emisor','CPIFP Bajo Aragón');
define('Host','smtp.ionos.es');
define('SMTPSecure','TLS');
define('Puerto',587);

