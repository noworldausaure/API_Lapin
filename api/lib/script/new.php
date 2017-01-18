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
  echo $data;
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
 ?>
