<?php

namespace App\Controller;

use Comito\AbstractController;

class HomeController extends AbstractController
{
    public function print() 
    {
        return $this->render('home');
    }
}