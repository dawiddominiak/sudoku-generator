<?php

require_once './vendor/autoload.php';

$loader = new \Symfony\Component\ClassLoader\Psr4ClassLoader();
$loader->addPrefix('DawidDominiak\\Sudoku\\App', __DIR__.'/App');
$loader->addPrefix('DawidDominiak\\Sudoku\\Tests', __DIR__.'/Tests');

$loader->register(true);
var_dump(new \DawidDominiak\Sudoku\App\Values\Grid());