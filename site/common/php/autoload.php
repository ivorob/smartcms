<?php

if (!defined('_APP_STARTED')) {
	die('Hacking attempt');
}

error_reporting(E_ALL ^ E_NOTICE);


/**
 * Автозагрузчик классов и контроллеров
 */

function __autoload($classname)
{
    static $_except_replacement = array('PgSql' => 'pgsql');

    if ( (!defined('_PHP_CLASS_PATH')) || (!defined('_PHP_MODULE_PATH')) || (!preg_match('/^[a-zA-Z]+$/', $classname)) ) {
        return false;
    }

    preg_match_all('/([A-Z]+[a-z]+)/', $classname, $_matches);

    if (strpos($classname, 'Module')) {
        $_module = strtolower(implode('.', array_reverse($_matches[1])) . '.php');
        
        if (include_once(_PHP_MODULE_PATH . $_module)) {
            return true;
        }
                
        throw new Exception("Unable to load $_module.");
    }

 
    $_exception_class = $_except_replacement[$classname];

    $_class = 'class.' . ( strlen($_exception_class) ? $_exception_class : strtolower(implode('_', $_matches[1])) ) . '.php';

    if (include_once(_PHP_CLASS_PATH . $_class)) {
	    return true;
    } 

    throw new Exception("Unable to load $_class.");
}

spl_autoload_register('__autoload');
