<?php

namespace App\Core;
use App\Core\View;

class Controller
{
    public function view($view, $data = [])
    {
        echo View::render($view, $data);
    }
}
