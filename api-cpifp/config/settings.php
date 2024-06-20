<?php

// Error reporting
error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('Europe/Madrid');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

// Error Handling Middleware settings
$settings['error_handler_middleware'] = [

    // Should be set to false in production
    'display_error_details' => true,

    // Parameter is passed to the default ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'log_errors' => true,

    // Display error details in error log
    'log_error_details' => true,
];


$settings['db'] = [
    'driver' => 'mysql',
    'host' => '192.168.200.18',
    'username' => 'root',
    // 'username' => 'soporte',
    'database' => 'cpifp_bajoaragon',
    'password' => 'root',
    // 'password' => 'AppCPIFP.21',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'flags' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ],
];


$settings['jwt'] = [

    // The issuer name
    'issuer' => 'www.cpifpbajoaragon.com',

    // Max lifetime in seconds
    'lifetime' => 311040000,        //10 años de caducidad

    // The private key
    'private_key' => '-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEApl85mnZKNrT+eKXmWVpdlZTBNcfkUnnxk6vHo/Y86Yydztw1STIF2ftWahadJJ4569Vp03bTVA2D4iueLo5HTG/wJBy+fg69XMOv4cjA/q72uuhyXbsV8lT1R5sY6Lq1Yzi6QAauPj5jQWLrYOU/3WNEUHJBUXelzAWfr4gGGF7AXfJ6qqESycyQg9v7tJbmoqURYJYlq1bT+yZ/VGQF+16YJBkdAX+ztfNhzqRbdkGHB1gmxXfjMsuJesjAXzs4MiWIu3nMbE1CWu6WgBQ5ydJjQc6LCglYXQzwMQwyT6OGfdDbRPT0JhY4FTQNnmtz4DGg1kmHa+vI19SF3GUy3QIDAQABAoIBABigfeFcYy3n6scnH4rYcoPiyhrQ5P5EaLsIMXwWxft4Qh/NvuF/0xfqOWdow4gZF8/N/mU78Jo/iecft8GCdBFffHeL/bKhMeyaVt2gHtlUQtd18v/m4p/Fba1UywIgKRtv2ToDAyXZjE2we9ES/joiKImT8BFEGbmyl2mfQ++1UZ9OcunBgEPhCV4ULNrw+qWs0RqR5YV3jb7rzZwXk4SwuWu6jljMUVMVV+Ul6bBOWCp2ahBgvyXWnAXdwt1VPzYz8RzmRoj6Z7mrwJ5O0C3kwx5nz+I9eMoC2lwnGTEsxmKPq6UBMQLbPGJ0ychmtBQEytNepguuPy6xd+H7Ig0CgYEA3G4/lMTtHleLmaK2tvpDSDvVR793cFhEMa/6sHnT4YxirLszVCUtj+EqMidlYr0iyUN1FbQhRe0EUWLctt6L+/QnkU2eMUw+uPWIQl5Lc/ff41+Pz0fTFMGWXwtXOrNEyuRZXJ6W/IzKeRwkeSMCOo5+o1eM4fqzGgt1AsmSWgsCgYEAwTfe9kDJdhyqiladf6bG2BjfY62nnLhnmdzt/auw9EQ6OJyzKx/A8bv2auI7BHyis0s4lGKRmzmlSVbdlUGqILugTbL14MJZ1RquBR8iTEDqKQh1TF6BPAwZ2j6oqSznVYSQsNmys7LVfYlFuVexn2z2ZFQvbXZizaYQwH7On7cCgYEA06mBoAbgcaw6vlICBP2WsbvSdsyhkd0Pzm5e2CqDjCbTcW1oQjpY37mkXPh7YC6hQoVl3mtTL+QBq2y051wXKt4tSFcxucCu0cfjCWemKDsyXxCZ9L3RMDMbgzROlG0jd3eBX3BhJyzCFz0wwKkfML83Vv1wqGWkqTOrLfwEbjUCgYEAvrWUvl5n+sqEkZK4VfyZG0ZBh7MpUwi4SSfFR7IlMJP/G02fkpr+6BpsOEcflWgnduxx5hP8P8gAGolAoEd10mUe7lILWlK6NBrnVGrMgZM5DFMq47wLtucCxWU/N+v4UXJNFiFpvvBuxD+vsCacTQ1RjOmC/nnxP6X/tt/ytbUCgYB0uxZSkHq4516RE+vbmv5lYUntMrwtYFUq0Ko4ePA/eE2DNooR47Aj0bJVyHUNEZAkNWXtJHDjYJ8K1SsizDe2zhwp2roV9UJgD71dpKnz2kc1cSqyK4a7x5i4AaR2jIJ196+ZZGotMfbuOXL4r2Thi7Px87TNGEFzfN4ZiY830A==
-----END RSA PRIVATE KEY-----',

    'public_key' => '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApl85mnZKNrT+eKXmWVpdlZTBNcfkUnnxk6vHo/Y86Yydztw1STIF2ftWahadJJ4569Vp03bTVA2D4iueLo5HTG/wJBy+fg69XMOv4cjA/q72uuhyXbsV8lT1R5sY6Lq1Yzi6QAauPj5jQWLrYOU/3WNEUHJBUXelzAWfr4gGGF7AXfJ6qqESycyQg9v7tJbmoqURYJYlq1bT+yZ/VGQF+16YJBkdAX+ztfNhzqRbdkGHB1gmxXfjMsuJesjAXzs4MiWIu3nMbE1CWu6WgBQ5ydJjQc6LCglYXQzwMQwyT6OGfdDbRPT0JhY4FTQNnmtz4DGg1kmHa+vI19SF3GUy3QIDAQAB
-----END PUBLIC KEY-----',
];

return $settings;
