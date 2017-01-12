<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'sql/connect.php';
require 'lib/new.php';

$app = new \Slim\App;

// SETTINGS NEW DB
$app->post('/newDomaine',function($request, $response, $args){
    newDb($request->getParsedBody());
  });
$app->get('/info/{domaine}',function($request, $response, $args){
  getInfo($args['domaine']);
});
$app->get('/strips/{domaine}',function($request, $response, $args){
  getAllStrips($args['domaine']);
});
$app->get('/stories/{domaine}',function($request, $response, $args){
  getAllStories($args['domaine']);
});

$app->run();

?>
