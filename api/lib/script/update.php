<?php
// ******************************************************
// * stripeuse4.0 for lapin.org                         *
// * this file is under GLPv3 or higher                 *
// * 2017 Quentin Pourriot <quentinpourriot@outlook.fr> *
// ******************************************************


// Update general INFO
  function updateGenInfo($data){
    $db = connectDb();

    $query = $db->update(array('short_name' => e($data['short_name'])))
                ->set(array('large_name' => e($data['large_name'])))
                ->set(array('author' => e($data['author'])))
                ->set(array('favicon' => e($data['favicon'])))
                ->table('info')
                ->where('short_name','=', $data['domain']);
    if($exe = $query->execute()){
      echo 'info general mise à jour';
    }
  }

// UPDATE DOMAINE INFO
  function updateInfo($data){

    updateGenInfo($data);

    $domain = $data['domain'];
    $db = connectDb($domain);

    unset($data['domain']);
    unset($data['login']);
    unset($data['pwd']);

      foreach ($data as $key => $value) {
        $query = $db->update(array($key => e($value)))
                    ->table('info')
                    ->where('short_name','=',$domain);
        if($exe = $query->execute()){
          echo $key . ' mise à jour ';
        }
      }
      if($data['short_name'] != $domain){
        renameDomain($data, $domain);
      }
  }

//UPDATE STRIPS
function updateStrips($data){
  $db = connectDb($data['domain']);

if(storyIdExist($db,$data)){
    $query = $db->update(array('title' => e($data['title'])))
                ->set(array('file' => e($data['file'])))
                ->set(array('story_id' => e($data['story_id'])))
                ->table('strips')
                ->where('id', '=',$data['id']);
    if($exe = $query->execute()){
      echo 'strip mise à jour';
    }
  }
}

//UPDATE STORIES
function updateStories($data){
  $db = connectDb($data['domain']);

  $query = $db->update(array('title' => e($data['title'])))
              ->table('stories')
              ->where('id', '=', $data['id']);
  if($exe = $query->execute()){
    echo 'stories mise à jour';
  }
}

function updateAdmin($data){
  $db = connectDb();

  $query = $db->update(array('name' => e($data['newName'])))
              ->set(array('login' => e($data['newLogin'])))
              ->set(array('pwd' => e($data['newPwd'])))
              ->table('admin')
              ->where('id', '=', $data['id']);

  if($exe = $query->execute()){
    echo 'Admin mise à jour';
  }
}
 ?>
