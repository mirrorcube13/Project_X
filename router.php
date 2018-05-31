<?php

$parsed = parse_url($_SERVER['REQUEST_URI']);
$url = ltrim($parsed['path'], '/');

$path = __DIR__ . "/pages/$url.php";
if (file_exists($path)) {
  include_once $path;
} else {
  include_once __DIR__. '/pages/index.php';
}