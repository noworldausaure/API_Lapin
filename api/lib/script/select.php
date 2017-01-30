<?php
// ******************************************************
// * stripeuse4.0 for lapin.org                         *
// * this file is under GLPv3 or higher                 *
// * 2017 Quentin Pourriot <quentinpourriot@outlook.fr> *
// ******************************************************

// GETTER INFO

// GET GENERAL INFO
function getAllInfo(){
  $db = connectDb();
  $query = $db->select()
              ->from('info')
              ->orderby('id');
  $exe = $query->execute();

  $data = $exe->fetchAll();

  echo ifEmpty($data);
}

// GET INFO ON DOMAINE
function getInfoByDomain($dom){
  $db = connectDb($dom);
  $query = $db->select()
              ->from('info');
  $exe = $query->execute();

  $data = $exe->fetchAll();

  echo ifEmpty($data);
}
// END INFO

// STRIPS GETTER
function getStripsByDomain($dom,$id){
  if(isset($id)){
    $db = connectDb($dom);
    $query = $db->select()
                ->from('strips')
                ->where('id','=',$id);

    $exe = $query->execute();
    $data = $exe->fetchAll();

    echo ifEmpty($data);

  }
  else{
  $db = connectDb($dom);
  $query = $db->select()
              ->from('strips')
              ->orderby('date');

  $exe = $query->execute();

  $data = $exe->fetchAll();

  echo ifEmpty($data);

  }
}
// END STRIPS

//STORIES GETTER
function getStoriesByDomain($dom,$id){
  if(isset($id)){
    $db = connectDb($dom);
    $query = $db->select()
                ->from('stories')
                ->where('id','=',$id);

    $exe = $query->execute();

    $data = $exe->fetchAll();

    echo ifEmpty($data);
  }
  else{
  $db = connectDb($dom);
  $query = $db->select()
              ->from('stories')
              ->orderby('id');

  $exe = $query->execute();

  $data = $exe->fetchAll();

  echo ifEmpty($data);
 }
}
//END STORIES

function getAdmin(){
  $db = connectDb();

  $query = $db->select()
              ->from('admin')
              ->orderby('id');

  $exe = $query->execute();

  $data = $exe->fetchAll();

  echo json_encode($data);
}
 ?>
