<?php

require __DIR__ . '/vendor/autoload.php';
use \Symfony\Component\HttpFoundation as Http;

$request = Http\Request::createFromGlobals();

$response = Http\Response::create();
$response->headers->set('Content-Type', 'text/plain');
$response->setStatusCode(200);
$response->setContent(print_r($request->headers, 1));

$response->headers->setCookie(new Http\Cookie('foo' ,'bar'));
$response->send();
