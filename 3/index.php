<?php
use \Symfony\Component\HttpFoundation as Http;
use  \Silex\Application as Application;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Model/Rep.php';


$app = new Application();

$rep = new \AppModel\Rep();

$app->match('/', function (Http\Request $request, Silex\Application $app) use ($rep) {
    $res = $rep->getRows();
    return $app->json($res);
})->method("GET");

$app->match('/', function (Http\Request $request) use ($rep) {
    $data = $request->getContent();
    $response = new Http\Response();
    try{
        $data = $rep->strToArray($data);
        $rep->addRow( $data );
        $rep->save();
        $response->setStatusCode(200, 'OK');
    }catch (Exception $e){
       $response->setStatusCode(500, $e->getMessage());
    }
    return $response;
})->method("POST");

$app->match('/{offset}', function (Http\Request $request, Silex\Application $app, $offset) use ($rep) {
    $response = new Http\Response();
    try{
        $res = $rep->getRow( $offset );
        if($res) return $app->json($res);
        $response->setStatusCode(404, 'NOT FOUND');
    }catch (Exception $e){
        $response->setStatusCode(500, $e->getMessage());
    }
    return $response;
})->method("GET");

$app->run();

