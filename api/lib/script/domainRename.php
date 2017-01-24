<?php
  function renameDomain($data){

    $infoForDump = mySqlDump();
    shell_exec('mysqldump ' .$infoForDump.' '.$data['domain'].' > '. __DIR__.'/dumpSqlDomain/renameDump.sql');
    //
    $db = connectSql();
    //
    $sql = 'CREATE DATABASE '.$data['short_name'];
    //
    if ($db->query($sql) === TRUE) {
      echo "db created successfully";
    } else {
      echo "Error creating ";
    }
    system('cat ' . __DIR__. '/dumpSqlDomain/renameDump.sql | mysql '.$infoForDump.' --database='.$data['short_name']);
    //
    $sql = 'DROP DATABASE '.$data['domain'];
    //
    if ($db->query($sql) === TRUE) {
      echo "db erase successfully";
    } else {
      echo "Error erase ";
    }
  }





 ?>
