<?php

  //Connexion à la base de données
  $username="root";$password='tw$world&2016';$database="DB_TeaTime";
  mysql_connect(localhost,$username,$password);
  @mysql_select_db($database) or die( "# Unable to select database");
?>
