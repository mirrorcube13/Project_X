<?php
    
$url = ltrim($_SERVER['REQUEST_URI'], '/');

$path = __DIR__ . "/pages/$url.php";
if (file_exists($path)) {
  include_once $path;
} else {
  include_once __DIR__. '/pages/index.php';
}