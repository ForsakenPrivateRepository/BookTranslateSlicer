<?php

namespace ReenExe\BookSite;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController
{
    public function indexAction(Request $request)
    {
        return new Response('index');
    }
}