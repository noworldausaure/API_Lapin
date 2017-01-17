<?php

  //NUKE THE DATABASE
  function dropThebase($data){
    $db = connectSql();

    $sql = "DROP DATABASE " . $data['domaine'];

    if($db->query($sql) == TRUE){
      echo 'Domaine supprimer';
    }
    else {
      echo "Erreur de suppression";
    }
  }

  //DELETE STRIP
  function deleteStrips($data){
    if($data['all']){
      $db = connectSql();

      $sql = "TRUNCATE Table " .$data['domaine'].".strips";

      if ($db->query($sql) === TRUE) {
        echo "Tout les Strips sont supprimer";
      } else {
        echo "Erreur de suppression";
      }
    }
    else{
      $db = connectDb($data['domaine']);

      $query = $db->delete()
      ->from('strips')
      ->where('id','=',$data['id']);
      if($exe = $query->execute()){
        echo 'strips supprimer';
      }
    }
  }

  //DELETE STORIES (WITH STRIPS)
  function deleteStories($data){
      $db = connectDb($data['domaine']);

      $query = $db->delete()
                  ->from('stories')
                  ->where('id','=',$data['id']);
        if($exe = $query->execute()){
          echo 'stories supprimer';
        }
      if($data['withStrip']){
      $query = $db->delete()
                  ->from('strips')
                  ->where('story_id','=',$data['id']);

        if($exe = $query->execute()){
            echo 'strips supprimer';
        }
      }
  }
 ?>
