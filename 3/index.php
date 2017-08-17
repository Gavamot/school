<?php
use \Symfony\Component\HttpFoundation as Http;
use  \Silex\Application as Application;

require __DIR__ . '/vendor/autoload.php';

$app = new Application();

$app->get('/', function (Http\Request $request) {
    return 'GET Method invoked';
});

$app
    ->match('/custom', function (Http\Request $request) {
        $response = new Http\Response();
        $response->headers->set('Custom-header', 'custom-value');
        $response->setStatusCode(306, 'Custom status code');
        return $response;
    })
    ->method('PATCH');


$app->run();

