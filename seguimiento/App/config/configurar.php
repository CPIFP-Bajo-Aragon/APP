<?php
// Ruta de la aplicacion
define('RUTA_APP', dirname(dirname(__FILE__)));

// Ruta url, Ejemplo: http://localhost/daw2_mvc
//define('RUTA_URL', "https://{$_SERVER['HTTP_HOST']}/tragamillas");

// Ruta local
//define('RUTA_URL', "http://localhost/cpifp");
// define('RUTA_URL', "/seguimiento");
define('RUTA_URL', "/seguimiento");
define('NOMBRE_SITIO', 'seguimiento');
define('RUTA_CPIFP', "http://192.168.1.7/cpifp");

define('RUTA_SEGUIMIENTO', "http://192.168.1.7/seguimiento/profeSegui");
define('RUTA_REPARTO', "http://192.168.1.7/seguimiento/jefeDep");
define('RUTA_CURSO', "http://192.168.1.7/seguimiento/direccion");
define('RUTA_LOGOUT', "http://192.168.1.7/cpifp/login/logout");

// Ruta host
define('DB_HOST', 'localhost');

// Ruta bridge
//define('DB_HOST', '172.17.0.2');

// Ruta dinámica
//define('DB_HOST', 'mysql');
define('DB_USUARIO', 'root');
define('DB_PASSWORD', 'root');
// define('DB_USUARIO', 'app_cpifp');
// define('DB_PASSWORD', 'app_cpifp!');
define('DB_NOMBRE', 'cpifp_bajoaragon');
//define('DB_PASSWORD', 'Admin1234');

define('RUTA_Icon', RUTA_URL . '/public/img/icons/');



