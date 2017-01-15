<?php

function deleteStories($data,$withStrips){
  if(isset($data['domaine'])){
    $db = connectDb('langues');

    if($withStrips){
      $query = $db->delete()
                  ->from('strips')
                  ->where('id_story','=',$data['id']);

      if($query->execute()){
        echo 'strips supprimer';
      }
    }
      $query = $db->delete()
                  ->from('stories')
                  ->where('id','=',$data['id']);
  }
  else {
    $db = connectDb('lapin');

    $query = $db->delete()
                ->from('info')
                ->where('id','=',$data['id'])->orWhere('short_name','=',$data['name'])->orWhere('large_name','=',$data['name']);
  }
  if($query->execute()){
    echo $data['domaine'].' Supprimer de ' .$table;
     }
}


 ?>
