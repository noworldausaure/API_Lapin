<?php

function newDb($data){
  $name = $data['name'];

  $conn = connectSql();

  $sql['database'] = "CREATE DATABASE ".$name;
  $sql['stories'] = "CREATE TABLE ".$name. ".stories (title varchar(255),id int primary key AUTO_INCREMENT)";
  $sql['strips'] = "CREATE TABLE " .$name. ".strips (title varchar(255),file varchar(255), story_id int, date datetime, id int primary key AUTO_INCREMENT)";


  foreach ($sql as $key => $value) {
    if ($conn->query($sql[$key]) === TRUE) {
      echo $key. " created successfully";
    } else {
      echo "Error creating ".$key. " : ". $conn->error;
    }
  }
  $conn->close();
}

 ?>
