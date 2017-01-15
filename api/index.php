<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'sql/connect.php';
require 'lib/script/new.php';
require 'lib/script/select.php';


$app = new \Slim\App;
// *******************
// * SETTINGS NEW DB *
// *******************
$app->post('/newDomaine',function($request, $response, $args){
    newDb($request->getParsedBody());
  });


// **********
// * GETTER *
// **********

// INFO
$app->get('/info',function($request, $response, $args){
  getAllInfo();
});//OK
$app->get('/info/{dom}',function($request, $response, $args){
  getInfoByDomaine($args['dom']);
});//OK
$app->get('/info/author/{author}', function($request, $response, $args){
  getInfoByAuthor($args['author']);
});//OK

// STRIPS
$app->get('/strips/{domaine}[/{id}]',function($request, $response, $args){
  getStripsByDomaine($args['domaine'],$args['id']);
});

// STORIES
$app->get('/stories/{domaine}[/{id}]',function($request, $response, $args){
  getStoriesByDomaine($args['domaine'],$args['id']);
});//OK

// **********
// * SETTER *
// **********
$app->run();

?>
