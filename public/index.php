<?php

require '../vendor/autoload.php';

$client = new \MongoDB\Client();


$kernel = new Comito\Kernel();
$kernel->run(dirname(__DIR__).'/app/routes.php');