<?php

function newDb($data){
  $name = e($data['short_name']);

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

function addInfo($data){
  $db = connectDb('lapin');

  $query = $db->insert(array('short_name','large_name','author','description','favicon','profil_picture','ban_picture','first_pub'))
								->into('info')
								->values(array(e($data['short_name']),e($data['large_name']),e($data['author']),e($data['description']),e($data['favicon']),e($data['profil_picture']),e($data['ban_picture']),e($data['first_pub'])));
  if($exe = $query->execute()){
    newDb($data);
  }
}

function addStrip($data){
  echo $data;
  $db = connectDb(e($data['domaine']));

  $query = $db->insert(array('title','file','story_id','date'))
              ->into('strips')
              ->values(array(e($data['title']),e($data['file']),e($data['story_id']),e($data['date'])));
  if($exe = $query->execute()){
    echo 'OK';
  }
}

function addStories($data){
  echo $data;
  $db = connectDb(e($data['domaine']));

  $query = $db->insert(array('title'))
              ->into('stories')
              ->values(array(e($data['title'])));
  if($exe = $query->execute()){
    echo 'OK';
  }
}
 ?>
