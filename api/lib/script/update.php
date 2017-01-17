<?php

// Update general INFO
  function updateGenInfo($data){
    $db = connectDb('lapin');

    $query = $db->update(array('short_name' => e($data['short_name'])))
                ->set(array('large_name' => e($data['large_name'])))
                ->set(array('author' => e($data['author'])))
                ->set(array('favicon' => e($data['favicon'])))
                ->table('info')
                ->where('id','=', $data['id_GenInfo']);
    if($exe = $query->execute()){
      echo 'info general mise à jour';
    }
  }

  function updateInfo($data){
    $db = connectDb($data['domaine']);

    $query = $db->update(array('short_name' => e($data['short_name'])))
                ->set(array('large_name' => e($data['large_name'])))
                ->set(array('author' => e($data['author'])))
                ->set(array('favicon' => e($data['favicon'])))
                ->set(array('description' => e($data['description'])))
                ->set(array('profil_picture' => e($data['profil_picture'])))
                ->set(array('ban_picture' => e($data['ban_picture'])))
                ->set(array('first_pub' => e($data['first_pub'])))
                ->table('info')
                ->where('id','=', $data['id_Info']) ;
    if($exe = $query->execute()){
      echo 'info mise à jour';
      updateGenInfo($data);
    }
  }



 ?>
