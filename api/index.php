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
$mw = function ($request, $response, $next) {
    $dataLog = $request->getParsedBody();
    if(login($dataLog)){
      $response = $next($request, $response);
      return $response;
    }
    else{
      echo 'get Logged';
    }
};

$app->post('/newDomaine',function($request, $response, $args){
  newDomaine($request->getParsedBody());
})->add($mw);

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
})->add($mw);
$app->post('/user/login',function($request, $response, $args){
  $response = login($request->getParsedBody());
  return $response;
})->add($mw);
$app->post('/{domaine}/admin', function($request, $response, $args){
    $response = loginDomaine($args['domaine'],$request->getParsedBody());
    if(count($response) == 1){
      return $response;
    }
})->add($mw);//OK

// STRIPS
$app->post('/strips/newStrip',function($request, $response, $args){
  $response = addStrip($request->getParsedBody());
  return $response;
})->add($mw);//OK

// STORIES
$app->post('/stories/newStories',function($request, $response, $args){
  $response = addStories($request->getParsedBody());
  return $response;
})->add($mw);//OK

//**********
//* DELETE *
//**********

// DOMAINE
$app->post('/delete/domaine', function($request, $response, $args){
  dropTheBase($request->getParsedBody());
})->add($mw);//OK

//STORIES
$app->post('/delete/stories', function($request, $response, $args){
  deleteStories($request->getParsedBody());
})->add($mw);//OK

//STRIPS
$app->post('/delete/strips',function($request, $response, $args){
  deleteStrips($request->getParsedBody());
})->add($mw);//OK

//**********
//* UPDATE *
//**********

//INFO
$app->post('/update/info', function($request,$response, $args){
  updateInfo($request->getParsedBody());
})->add($mw);//Ok need to add update name db in case of change short_name

//STRIPS
$app->post('/update/strips', function($request,$response,$args){
  updateStrips($request->getParsedBody());
})->add($mw);//OK

//STORIES
$app->post('/update/stories', function($request,$response,$args){
  updateStories($request->getParsedBody());
})->add($mw);//OK


$app->run();

?>
