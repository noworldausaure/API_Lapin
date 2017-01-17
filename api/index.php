<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'sql/connect.php';
require 'lib/loader.php';

$app = new \Slim\App;
// *******************
// * SETTINGS NEW DB *
// *******************

$app->post('/newDomaine',function($request, $response, $args){
  newDomaine($request->getParsedBody());
});

// **********
// * GETTER *
// **********

// INFO
$app->get('/infoGeneral',function($request, $response, $args){
  getAllInfo();
});//OK
$app->get('/info/{dom}',function($request, $response, $args){
  getInfoByDomaine($args['dom']);
});//OK

// STRIPS
$app->get('/strips/{domaine}[/{id}]',function($request, $response, $args){
  getStripsByDomaine($args['domaine'],$args['id']);
});//OK
// STORIES
$app->get('/stories/{domaine}[/{id}]',function($request, $response, $args){
  getStoriesByDomaine($args['domaine'],$args['id']);
});//OK

// USER
$app->get('/user/getUser',function($request, $response, $args){
  getUser($args['domaine'],$args['id']);
});
$app->get('/user/getAdmin',function($request, $response, $args){
  getAdmin($args['domaine'],$args['id']);
});
$app->get('/user/getSadmin',function($request, $response, $args){
  getSadmin($args['domaine'],$args['id']);
});


// **********
// * SETTER *
// **********


// USER
$app->post('/user/newUser',function($request, $response, $args){
  addUser($request->getParsedBody());
});
$app->post('/user/login',function($request, $response, $args){
  login($request->getParsedBody());
});

// STRIPS
$app->post('/strips/newStrip',function($request, $response, $args){
    addStrip($request->getParsedBody());
});//OK NEED TO ADD RESPONSE OBJECT

// STORIES
$app->post('/stories/newStories',function($request, $response, $args){
    addStories($request->getParsedBody());
});//OK NEED TO ADD RESPONSE OBJECT

//**********
//* DELETE *
//**********

// DOMAINE
$app->post('/delete/domaine', function($request, $response, $args){
  dropTheBase($request->getParsedBody());
});

//STORIES
$app->post('/delete/stories', function($request, $response, $args){
  deleteStories($request->getParsedBody());
});//OK

//STRIPS
$app->post('/delete/strips',function($request, $response, $args){
  deleteStrips($request->getParsedBody());
});//OK

//**********
//* UPDATE *
//**********

//INFO
$app->post('/update/info', function($request,$response, $args){
  updateInfo($request->getParsedBody());
});//Ok need to add update name db in case of change short_name

//STRIPS
$app->post('/update/strips', function($request,$response,$args){
  updateStrips($request->getParsedBody());
});//OK

//STORIES
$app->post('/update/stories', function($request,$response,$args){
  updateStories($request->getParsedBody());
});//OK

$app->run();

?>
