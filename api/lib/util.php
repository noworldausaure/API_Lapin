<?php

  function e($char){
    return htmlspecialchars($char);
  }

  function ifEmpty($data){
    if(!empty($data)){
      return json_encode($data);
    }
    else{
      return 'Y\'a rien ici';
    }
  }

 ?>
