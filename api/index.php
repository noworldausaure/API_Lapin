<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'sql/connect.php';
require 'lib/new.php';
$app = new \Slim\App;

$app->post('/newDb',function($request, $response, $args){
    newDb($request->getParsedBody());
  });

$app->run();

?>
