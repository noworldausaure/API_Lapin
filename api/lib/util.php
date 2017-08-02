<?php

  function e($char){
    return htmlspecialchars($char);
  }

  function isMd5($pwd){
    if(strlen($pwd) == 32){
      return true;
    }
    else{
      return false;
    }
  }

  function storyIdExist($db, $data){

    $query = $db->select(array('id'))
                ->from('stories')
                ->where('id','=',$data['story_id']);
    $exe = $query->execute();
    $id = $exe->fetch();

    if(!empty($id['id'])){
      return true;
    }
    else{
      echo 'L\'id story n\'est pas valide';
    }

  }

 ?>
