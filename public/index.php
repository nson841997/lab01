<?php

$app = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'app.php';

$app->get('/', 'index');
$app->get('/about', 'about');
$app->get('/contact','contact');
$app->get('/product','product');

$app->start();
