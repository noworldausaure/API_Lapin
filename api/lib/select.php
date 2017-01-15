<?php

function getAllInfo(){
  $db = connectDb();
  $query = $db->select()
              ->from('info')
              ->orderby('id');
  $exe = $query->execute();

  $data = $exe->fetchAll();

  echo json_encode($data);
}

function getInfoByDomaine($dom){
  $db = connectDb();
  $query = $db->select()
              ->from('info')
              ->where('short_name','=', $dom)->orWhere('large_name','=',$dom);
  $exe = $query->execute();

  $data = $exe->fetch();

  echo json_encode($data);
}

function getInfoByAuthor($author){
  $db = connectDb();
  $query = $db->select()
              ->from('info')
              ->where('author','=',$author);

  $exe = $query->execute();

  $data = $exe->fetch();

  echo json_encode($data);
}
 ?>
