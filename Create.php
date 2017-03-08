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
  $email = $_POST['email'];
  $pass = true;
  $reponse = $bdd->query("SELECT * FROM T_Personne");

  while ($donnees = $reponse->fetch())
  {
    $nom_personne = $donnees['Nom_Personne'];
    if($nom_personne == $name)
    {
      $pass = false;
    }
  }

  if($pass == false)
  {
    $name = $name . "#1";
  }

  $pwd_hash = md5($pwd);

  $bdd->exec("INSERT INTO T_Personne(Nom_Personne, Password, Email_Personne) VALUES('$name', '$pwd_hash', '$email')");

  header('Location: ./index.php?value=' . $name);
?>
