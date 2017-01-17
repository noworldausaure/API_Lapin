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
  getGenInfo();
});//OK
$app->get('/info/{dom}',function($request, $response, $args){
  getInfoByDomaine($args['dom']);
});
$app->get('/info/author/{author}', function($request, $response, $args){
  getInfoByAuthor($args['author']);
});

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
  getStoriesByDomaine($args['domaine'],$args['id']);
});
$app->get('/user/getAdmin',function($request, $response, $args){
  getStoriesByDomaine($args['domaine'],$args['id']);
});
$app->get('/user/getSadmin',function($request, $response, $args){
  getStoriesByDomaine($args['domaine'],$args['id']);
});


// **********
// * SETTER *
// **********

// INFO
//COMPLETE INFO FROM DB CREATION
$app->post('/info/newAuthor',function($request, $response, $args){
  addInfo($request->getParsedBody());
});//OK NEED TO ADD RESPONSE OBJECT

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

// STORIES
$app->post('/delete/stories[/withStrips]',function($request, $response, $args){
    deleteStories($request->getParsedBody(), $args['withStrips']);
});//OK NEED TO ADD RESPONSE OBJECT

// STRIPS
$app->post('/delete/strips[/withStrips]',function($request, $response, $args){
    deleteStrips($request->getParsedBody(), $args['withStrips']);
});
// INFO
$app->post('/delete/info',function($request, $response, $args){
    deleteInfo($request->getParsedBody(), $args['withStrips']);
});
//**********
//* UPDATE *
//**********

$app->post('/update/info/{domaine}', function($request,$response, $args){
  updateInfo();
});

$app->run();

?>
