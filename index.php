<?php

require 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use ReenExe\BookSite\AppHandle;

$request = Request::createFromGlobals();
$kernel = new AppHandle();
$response = $kernel->handle($request);
$response->send();

/**
 *  For http://bts.try/
 * sudo php -S 192.168.50.4:80
 *  For Locust
 * sudo php -S 0.0.0.0:80
 */

/**
 * wget http://code.jquery.com/jquery-2.1.4.js
 */