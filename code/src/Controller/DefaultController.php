<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class DefaultController {

    public function indeX(){
        return new Response('<p>Hello Wordl');
    }
}