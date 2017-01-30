<?php
function connectDb($db){
$pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);

return $pdo;
}

function connectSql(){

$conn = new mysqli($dsn, $usr, $pwd);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
return $conn;
}

function mySqlDump(){

  return "--host=$host --user=$usr --password=$pwd";
}
 ?>
