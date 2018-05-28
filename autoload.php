<?php

spl_autoload_register(function($className)
{
  require_once __DIR__ . 'core/' . $className . '.php';
});

DB::setConfig(require_once 'config.php');