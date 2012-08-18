<?php

$file = __DIR__ . '/../vendor/autoload.php';
if(!file_exists($file)){
    throw new RuntimeException('Install dependencies with composer to run the tests');
}

$autoload = require_once($file);