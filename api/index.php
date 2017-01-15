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
//ADD NEW AUTHOR AND NEW DB CREATE
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

// STORIES
$app->post('/stories/deleteStories[/withStrips]',function($request, $response, $args){
  DeleteStories($request->getParsedBody(),$args['withStrips']);
});

// STRIPS
$app->post('/strips/deleteStrips',function($request, $response, $args){
  DeleteStories($request->getParsedBody());
});

// INFO
$app->post('/info/deleteInfo',function($request, $response, $args){
  DeleteStories($request->getParsedBody());
});
//**********
//* UPDATE *
//**********
$app->run();

?>
