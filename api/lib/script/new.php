<?php
// ******************************************************
// * stripeuse4.0 for lapin.org                         *
// * this file is under GLPv3 or higher                 *
// * 2017 Quentin Pourriot <quentinpourriot@outlook.fr> *
// ******************************************************


function addStrip($data){
  $db = connectDb(e($data['domain']));

  $query = $db->insert(array('title','file','story_id','date'))
              ->into('strips')
              ->values(array(e($data['title']),e($data['file']),e($data['story_id']),e($data['date'])));
  if($exe = $query->execute()){
    return 'Strips correctement Enregistrer';
  }
  else{
    return 'Probleme d\'enregistrement du strips';
  }
}

function addStories($data){
  $db = connectDb(e($data['domain']));

  $query = $db->insert(array('title'))
              ->into('stories')
              ->values(array(e($data['title'])));
  if($exe = $query->execute()){
    return 'Stories Enregistrer';
  }
  else{
    return 'Probleme d\'enregistrement de la storie';
  }
}

function addAdmin($data){
  $db = connectDb();

  $query = $db->insert(array('name','login','pwd'))
              ->into('admin')
              ->values(array(e($data['name']),e($data['newLogin']),e($data['newPwd'])));

  if($exe = $query->execute()){
    if($data['sAdmin']){
      $query = $db->select(array('id'))
                  ->from('admin')
                  ->where('name','=',$data['name'])->orWhere('login','=',$data['newLogin']);

      $exe = $query->execute();

      $data = $exe->fetch();

      $query = $db->insert(array('id_admin'))
                  ->into('s_admin')
                  ->values(array($data['id']));
      if($exe = $query->execute()){
      echo 'S Admin enregistré';
      }
    }
    else{

      echo 'Admin enregistré';
    }
  }
}
 ?>
