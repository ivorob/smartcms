<?php

if (!defined('MAIN_BODY')) {
	die('Hacking attempt');
}

error_reporting(E_ALL ^ E_NOTICE);


/**
 * Автозагрузчик классов и контроллеров
 */

function __autoload($classname)
{
    if (!preg_match('/^[a-zA-Z]+$/', $classname)) {
        return false;
    }

    preg_match_all('/([A-Z]+[a-z]+)/', $classname, $matches);

    $path = '';
    if (strpos($classname, 'Http') === 0) {
        $path = 'http';
    } else if (strpos($classname, 'Command') !== FALSE) {
        $path = 'commands';
    } else {
        $path = 'classes';
    }

    $class = $path . '/' . $classname . ".class.php";
    if (include_once($class)) {
        return true;
    }

    return false;
}

spl_autoload_register('__autoload');
