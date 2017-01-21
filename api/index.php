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

$app = new \Slim\App([
  'settings' => [
      'addContentLengthHeader' => false,
    ],
  ]);
// *******************
// * SETTINGS NEW DB *
// *******************
$mwLoginAdmin = function ($request, $response, $next) {
    $dataLog = $request->getParsedBody();
    if(login($dataLog)){
      $response = $next($request, $response);
      return $response;
    }
};

$mwLoginSadmin = function ($request, $response, $next) {
    $dataLog = $request->getParsedBody();
    if(isSadmin($dataLog)){
      $response = $next($request, $response);
      return $response;
    }
};

$app->post('/newDomain',function($request, $response, $args){
  newDomain($request->getParsedBody());
})->add($mwLoginSadmin);

// **********
// * GETTER *
// **********

// INFO
$app->get('/infoGeneral',function($request, $response, $args){
  getAllInfo();
});//OK
$app->get('/info/{domain}',function($request, $response, $args){
  getInfoByDomain($args['domain']);
});//OK

// STRIPS
$app->get('/strips/{domain}[/{id}]',function($request, $response, $args){
  getStripsByDomain($args['domain'],$args['id']);
});//OK
// STORIES
$app->get('/stories/{domain}[/{id}]',function($request, $response, $args){
  getStoriesByDomain($args['domain'],$args['id']);
});//OK




// **********
// * SETTER *
// **********


// USER
$app->post('/user/getAdmin',function($request, $response, $args){
  $response = getUser();
  return $response;
})->add($mwLoginSadmin);

$app->post('/user/login',function($request, $response, $args){
  $response = isSadmin($request->getParsedBody());
  return $response;
});

$app->post('/{domain}/admin', function($request, $response, $args){
    $response = loginDomain($args['domain'],$request->getParsedBody());
    if(count($response) == 1){
      return $response;
    }
})->add($mwLoginAdmin);//OK

// STRIPS
$app->post('/strips/newStrip',function($request, $response, $args){
  $response = addStrip($request->getParsedBody());
  return $response;
})->add($mwLoginAdmin);//OK

// STORIES
$app->post('/stories/newStories',function($request, $response, $args){
  $response = addStories($request->getParsedBody());
  return $response;
})->add ($mwLoginAdmin);//OK

//**********
//* DELETE *
//**********

// DOMAINE
$app->post('/delete/domain', function($request, $response, $args){
  dropTheBase($request->getParsedBody());
})->add($mwLoginAdmin);//OK

//STORIES
$app->post('/delete/stories', function($request, $response, $args){
  deleteStories($request->getParsedBody());
})->add($mwLoginAdmin);//OK

//STRIPS
$app->post('/delete/strips',function($request, $response, $args){
  deleteStrips($request->getParsedBody());
})->add($mwLoginAdmin);//OK

//**********
//* UPDATE *
//**********

//INFO
$app->post('/update/info', function($request,$response, $args){
  updateInfo($request->getParsedBody());
})->add($mwLoginAdmin);//Ok

//STRIPS
$app->post('/update/strips', function($request,$response,$args){
  updateStrips($request->getParsedBody());
})->add($mwLoginAdmin);//OK

//STORIES
$app->post('/update/stories', function($request,$response,$args){
  updateStories($request->getParsedBody());
})->add($mwLoginAdmin);//OK


$app->run();

?>
