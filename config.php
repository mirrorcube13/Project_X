<?php

$config = [
  'db' => [
    'type'    => 'mysql',
    'host'    => 'localhost',
    'dbname'  => 'diplom',
    'login'   => 'root',
    'password'=> '123456',
    'options' => [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
  ]
];