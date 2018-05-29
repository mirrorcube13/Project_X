<?php

spl_autoload_register(function($className)
{
  require_once __DIR__ . '/core/' . $className . '.php';
});
require_once 'config.php';
DB::setConfig($config['db']);