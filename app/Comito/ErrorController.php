<?php

namespace Comito;

class ErrorController extends AbstractController
{
    public function error_404() 
    {
        return $this->render('errors/error_404');
    }

    public function error_405() 
    {
        return $this->render('errors/error_405');
    }
}