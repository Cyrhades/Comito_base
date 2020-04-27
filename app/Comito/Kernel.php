<?php

namespace Comito;

class Kernel 
{
    private $router;

    private $templateEngine;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function run(string $RoutingFile)
    {
        $dispatcher = $this->router->setRoutes($RoutingFile);
        $this->router->dispatching($dispatcher);
    }
}