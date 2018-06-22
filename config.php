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
  ],
  'page_titles' => [
    'index' => 'Главная',
    'registration' => 'Регистрация',
    'login' => 'Войти',
    'searchresults' => 'Результаты поиска',
    'registration-hotel' => 'Добавить отель',
  ]
];