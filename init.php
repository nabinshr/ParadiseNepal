<?php

/**
 * Settings file created to automatically toggle between development and production phase
 * and to define global variable for database, session and cookies
 */

$serverName = $_SERVER['SERVER_NAME'];
$serverPort = $_SERVER['SERVER_PORT'];

define('VIRTUALHOST', 'virtualhost.name');

if ($serverName == 'localhost' || $serverName == 'VIRTUALHOST') {
    define('ENVIRONMENT', 'development');
} else {
    define('ENVIRONMENT', 'production');
}

switch (ENVIRONMENT) {
    case 'development':
        ini_set('display_errors', 'on');
        ini_set('allow_url_fopen', 1);
        error_reporting(-1);
        define('HTTP', 'http://' . $serverName . ':' . $_SERVER['SERVER_PORT'] . '/paradisenepal/');
        define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/paradisenepal/');
        define('ASSET', HTTP . 'assets/');
        define('URL', 'http://' . $serverName . ':' . $_SERVER['SERVER_PORT'] . '/paradisenepal/');

        break;

    case 'production':
        define('ROOT', $_SERVER['DOCUMENT_ROOT']);
        define('HTTP', 'http://' . $serverName);
        define('URL', 'http://' . $serverName);
        define('ASSET', HTTP);
        ini_set('display_errors', 'on');
        error_reporting(-1);
        break;

    default:
        die('Unknown Place');
}