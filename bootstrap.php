<?php

session_start();
ob_start();

date_default_timezone_set('UTC');

spl_autoload_register(function($className)
{
  require_once __DIR__ . '/core/' . $className . '.php';
});

require_once 'config.php';
require_once 'core/functions.inc';

DB::setConfig($config['db']);

