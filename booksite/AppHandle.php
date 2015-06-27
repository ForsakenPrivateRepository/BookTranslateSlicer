<?php

namespace ReenExe\BookSite;

use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

class AppHandle extends HttpKernel
{
    public function __construct()
    {
        $routes = new RouteCollection();
        $routes->add('index', new Route('/', [
            '_controller' => 'ReenExe\\BookSite\\MainController::indexAction'
        ]));
        $routes->add('form', new Route('/form', [
            '_controller' => 'ReenExe\\BookSite\\MainController::formAction'
        ]));

        $matcher = new UrlMatcher($routes, new RequestContext());

        $dispatcher = new EventDispatcher();
        $dispatcher->addSubscriber(new RouterListener($matcher));

        $resolver = new ControllerResolver();

        parent::__construct($dispatcher, $resolver);
    }
}