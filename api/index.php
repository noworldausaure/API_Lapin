<?php
// ******************************************************
// * stripeuse4.0 for lapin.org                         *
// * this file is under GLPv3 or higher                 *
// * 2017 Quentin Pourriot <quentinpourriot@outlook.fr> *
// ******************************************************

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



// **********
// * SETTER *
// **********


// USER
$app->post('/user/newUser',function($request, $response, $args){
  addUser($request->getParsedBody());
});
$app->post('/user/login',function($request, $response, $args){
  $response = login($request->getParsedBody());
  return $response;
});
$app->post('/{domaine}/admin', function($request, $response, $args){
    $response = loginDomaine($args['domaine'],$request->getParsedBody());
    if(count($response) == 1){
      return $response;
    }
});//OK

// STRIPS
$app->post('/strips/newStrip',function($request, $response, $args){
  $response = addStrip($request->getParsedBody());
  return $response;
});//OK

// STORIES
$app->post('/stories/newStories',function($request, $response, $args){
  $response = addStories($request->getParsedBody());
  return $response;
});//OK

//**********
//* DELETE *
//**********

// DOMAINE
$app->post('/delete/domaine', function($request, $response, $args){
  dropTheBase($request->getParsedBody());
});//OK

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
