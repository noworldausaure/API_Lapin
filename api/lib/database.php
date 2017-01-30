<?php

//PDO CONNECTION
function connectDb($db){
  global $usr, $pwd;
  $dsn = makeDsn($db);

$pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);

return $pdo;
}

//MYSQLI CONNECTION
function connectSql(){
global $host, $usr, $pwd;

$conn = new mysqli($host, $usr, $pwd);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
return $conn;
}

//GENERATE DSN FOR DATABASE CONNECTION
function makeDsn($db){
  global $dbAdmin, $host;

  if(!empty($db)){
    return 'mysql:host='.$host.';dbname='.$db.';charset=utf8';
  }
  else{
    return 'mysql:host='.$host.';dbname='.$dbAdmin.';charset=utf8';
  }
}

function mySqlDump(){
  global $usr, $pwd, $host;
  return "--host=$host --user=$usr --password=$pwd";
}
 ?>
