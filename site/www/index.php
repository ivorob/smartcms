<?php

error_reporting(E_ALL);
set_time_limit(0);
date_default_timezone_set('UTC');

if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
    header('X-UA-Compatible', '"IE=Edge, chrome=1" env=ie');
}

ob_start();

//definitions
define('MAIN_BODY',         1); //start from index.php*/

include_once '../config/config.php';
include_once '../common/php/autoload.php';

try {
    $controller = new FrontController;
    echo $controller->doRequest(new ServerContext,
        new HttpRequest($_SERVER['QUERY_STRING']),
        new HttpResponse);
} catch (Exception $e) {
    echo "<pre>" . $e . "</pre>";
}
