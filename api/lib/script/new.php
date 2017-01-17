<?php

function addStrip($data){
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
