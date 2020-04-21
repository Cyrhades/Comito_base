<?php

namespace Comito;

use FastRoute;

class Router
{
    public function setRoutes() 
    {
        $routes = include dirname(__DIR__).'/routes.php';
        return FastRoute\simpleDispatcher($routes);
    }
 
    public function dispatching($dispatcher) 
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        
        $routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], rawurldecode($uri));
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                // chargement d'un template error 405
                exit;
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                
                header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
                // chargement d'un template error 405
                exit;
                break;
            case FastRoute\Dispatcher::FOUND:
                // Je vérifie si mon parametre est une chaine de caractere
                if(is_string($routeInfo[1])) {
                    // si dans la chaine reçu on trouve les ::
                    if(strpos($routeInfo[1], '::') !== false) {
                        //on coupe sur l'operateur de resolution de portée (::)
                        // qui est symbolique ici dans notre chaine de caractere.
                        $route = explode('::', $routeInfo[1]);
                        $method = [new $route[0], $route[1]];
                    } else {
                        // sinon c'est directement la chaine qui nous interesse
                        $method = $routeInfo[1];
                    }
                }
                // dans le cas ou c'est appelable (closure (fonction anonyme) par exemple)
                elseif(is_callable($routeInfo[1])) {
                    $method = $routeInfo[1];
                }
                // on execute avec call_user_func_array
                echo call_user_func_array($method, $routeInfo[2]); 
                break;
        }
    }
}