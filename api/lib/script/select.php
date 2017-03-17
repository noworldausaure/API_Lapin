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
function getStripsByDomain($dom,$id,$number,$offset){
  $db = connectDb($dom);
  $number=(!is_integer($number))?9:$number;
  $offset=(!is_integer($offset))?0:$offset;
  $query = $db->select()
              ->from('strips')
              ->orderby('date','DESC');
              ->limit($number,$offset);
  if($id>0) {
    $db->where('id','=',$id);
  }
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo ifEmpty($data);
}

function getStripsByStories($dom,$id){
  $db = connectDb($dom);
  $query = $db->select()
              ->from('strips')
              ->where('story_id','=',$id)
              ->orderby('id');
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo ifEmpty($data);
}
// END STRIPS

//STORIES GETTER
function getStoriesByDomain($dom,$id=0,$number,$offset){
  $db = connectDb($dom);
  $number=(!is_integer($number))?20:$number;
  $offset=(!is_integer($offset))?0:$offset;
  $query = $db->select()
              ->from('stories')
              ->limit($number,$offset);
  if($id>0) {
    $db->where('id','=',$id);
  }
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo ifEmpty($data);
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

function getStripsByStories($dom,$id){
  $db = connectDb($dom);
  $query = $db->select()
              ->from('strips')
              ->where('story_id','=',$id)
              ->orderby('date','DESC');
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo ifEmpty($data);
}

function getLapinPub($id){
  $db = connectDb();
  $query = $db->select()
              ->from('pub')
  if(isset($id)){
    $db->where('id','=',$id);
  }
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo json_encode($data);
}

function getDomainPub($dom){
    $db = connectDb($dom);
    $query = $db->select()
                ->from('pub')
                ->orderby('id');

    $exe = $query->execute();
    $data = $exe->fetchAll();
    echo json_encode($data);
}
?>
