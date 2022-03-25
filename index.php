<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$view = new \Twig\Environment($loader);


$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) use ($view){
    $body = $view->render('index.twig');
    $response->getBody()->write($body);
    return $response;
});

$app->get('/about', function (Request $request, Response $response, $args)  use ($view) {
    $body = $view->render('about.twig',[
        'name'=>'USER'
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/{url_key}', function (Request $request, Response $response, $args) use ($view){
    $body = $view->render('post.twig',[
        'url'=>$args['url_key']
    ]);
    $response->getBody()->write($body);
    return $response;
});


$app->run();