<?php
  //Connexion à la base de données
  try
  {
    $bdd = new PDO('mysql:host=localhost;dbname=DB_TeaTime;charset=utf8', 'root', 'tw$world&2016');
  }
  catch (Exception $e)
  {
        die('Erreur : ' . $e->getMessage());
  }

  $name = $_POST['name'];
  $pwd = $_POST['pwd']; 
  $reponse = $bdd->query("SELECT * FROM T_Personne WHERE Nom_Personne='$name'");
  $userPass = $reponse->rowCount();
  if($userPass == 0)
  {
    header('Location: ./index.php?value=' . $name . '&error=true');
    exit();
  }
  while ($donnees = $reponse->fetch())
  {
    $password = $donnees['Password'];
    $pwd_hash = md5($pwd);
    if($password == $pwd_hash)
    {
      header('Location: ./home.php?v1=' . $name . '&v2=' . $pwd_hash);
      exit();
    }
    else
    {
      header('Location: ./index.php?value=' . $name . '&error=true');
      exit();
    }
  }
  header('Location: ./index.php');
?>
