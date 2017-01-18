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

  function login($data){
    $db = connectDb('lapin');

    $query = $db->select()
                ->from('admin')
                ->where('name','=',$data['login'])->orWhere('login','=',$data['login']);

    $exec = $query->execute();
    $donnee = $exec->fetchAll();

    if($donnee[0]['pwd'] == $data['pwd']){
      if(isSadmin($donnee[0]['id'])){
        $donnee['sAdmin'] = true;
      }
      return $donnee;
    }
  }

  function isSadmin($id){
    $db = connectDb('lapin');

    $query = $db->select()
                ->from('s_admin')
                ->where('id_admin','=',$id);
    $exe = $query->execute();

    if(count($exe->fetchAll()) == 1){
      return true;
      }
    else{
      return false;
    }
  }
 ?>
