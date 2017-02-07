<?php
// ******************************************************
// * stripeuse4.0 for lapin.org                         *
// * this file is under GLPv3 or higher                 *
// * 2017 Quentin Pourriot <quentinpourriot@outlook.fr> *
// ******************************************************


function newDomain($data){

    $db = connectDb();

  $query = $db->insert(array('short_name','large_name','author','favicon','favicon_name'))
								->into('info')
								->values(array($data['short_name'],e($data['large_name']),e($data['author']),e($data['favicon']),e($data['favicon_name'])));
  if($exe = $query->execute()){
    newDb($data);
    addDomInfo($data);
    }
  }

// CREATING NEW DOMAINE DB
function newDb($data){
  $name = e($data['short_name']);

  $conn = connectSql();

  $sql['database'] = "CREATE DATABASE ".$name;
  $sql['info'] = "CREATE TABLE " .$name. ".info (short_name varchar(255),"
                                                ."large_name varchar(255),"
                                                ."author varchar(255),"
                                                ."description varchar(255),"
                                                ."favicon MEDIUMTEXT,"
                                                ."favicon_name varchar(250),"
                                                ."profil_picture MEDIUMTEXT,"
                                                ."profil_picture_name varchar(250),"
                                                ."ban_picture MEDIUMTEXT,"
                                                ."ban_picture_name varchar(255),"
                                                ."first_pub MEDIUMTEXT,"
                                                ."first_pub_name varchar(255),"
                                                ."pwd varchar(255),"
                                                ."id int primary key AUTO_INCREMENT)";

  $sql['stories'] = "CREATE TABLE ".$name. ".stories (title varchar(255),"
                                            ."id int primary key AUTO_INCREMENT)";

  $sql['strips'] = "CREATE TABLE " .$name. ".strips (title varchar(255),"
                                          ."file MEDIUMTEXT,"
                                          ."file_name varchar(255),"
                                          ."story_id int,"
                                          ."date datetime,"
                                          ." id int primary key AUTO_INCREMENT)";


  foreach ($sql as $key => $value) {
    if ($conn->query($sql[$key]) === TRUE) {
      echo $key. " created successfully ";
    } else {
      echo " Error creating ".$key. " : ". $conn->error;
    }
  }
  $conn->close();
}

// COMPLETE INFO ON DOMAINE INFO TABLE
function addDomInfo($data){
  $db = connectDb($data['short_name']);

  $query = $db->insert(array('short_name','large_name','author','favicon','favicon_name','pwd'))
              ->into('info')
              ->values(array(e($data['short_name']),e($data['large_name']),e($data['author']),e($data['favicon']),e($data['favicon_name']),e($data['pwd'])));
  if($exe = $query->execute()){
    echo ' Ok Domain Info Enregistrer ';
  }
}

 ?>
