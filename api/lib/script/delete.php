<?php
// ******************************************************
// * stripeuse4.0 for lapin.org                         *
// * this file is under GLPv3 or higher                 *
// * 2017 Quentin Pourriot <quentinpourriot@outlook.fr> *
// ******************************************************


  //NUKE THE DATABASE
  function dropThebase($data){
    $db = connectSql();

    $sql = "DROP DATABASE " . $data['domain'];

    if($db->query($sql) == TRUE){
      echo 'Domain supprimer';
    }
    else {
      echo "Erreur de suppression";
    }
  }

  //DELETE STRIP
  function deleteStrips($data){
    if($data['all']){
      $db = connectSql();

      $sql = "TRUNCATE Table " .$data['domain'].".strips";

      if ($db->query($sql) === TRUE) {
        echo "Tout les Strips sont supprimer";
      } else {
        echo "Erreur de suppression";
      }
    }
    else{
      $db = connectDb($data['domain']);

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
      $db = connectDb($data['domain']);

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

  function deleteAdmin($data){
    $db = connectDb();

    $query = $db->delete()
                ->from('admin')
                ->where('id','=',$data['id']);
    if($exe = $query->execute()){

      $query = $db->delete()
                  ->from('s_admin')
                  ->where('id_admin','=',$data['id']);
      $exe = $query->execute();

      echo 'Admin supprimer';
    }
  }
 ?>
