<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'sql/connect.php';
require 'lib/new.php';
require 'lib/select.php';


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
});
$app->get('/info/{dom}',function($request, $response, $args){
  getInfoByDomaine($args['dom']);
});
$app->get('/info/author/{author}', function($request, $response, $args){
  getInfoByAuthor($args['author']);
});
// STRIPS

$app->get('/strips/{domaine}',function($request, $response, $args){
  getStripsByDomaine($args['domaine']);
});
$app->get('/strips', function($request,$responde,$args){
  getStripById();
})
// STORIES
$app->get('/stories/{domaine}',function($request, $response, $args){
  getStoriesByDomaine($args['domaine']);
});
$app->get('/stories', function($request, $reponse, $args){
  getStoriesById();
});


// SETTER

$app->run();

?>
