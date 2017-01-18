<?php

  function loginDomaine($domaine,$data){
    $pwd = $data['pwd'];

    $db = connectDb($domaine);

    $query = $db->select()
                ->from('info')
                ->where('pwd','=',$pwd);
    $exec = $query->execute();

    $data = $exec->fetchAll();

    return $data;
  }




 ?>
