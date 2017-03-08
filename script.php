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

  $id_personne = 0;
  $personne = $_POST['Personne'];
  $tea = $_POST['Tea'];
  $pwd_ = $_GET['v2'];
  $name_ = $_GET['v1'];

  $reponse_ = $bdd->query("SELECT * FROM T_Personne WHERE Nom_Personne='$name_'");
  $userPass = $reponse_->rowCount();
  if($userPass == 0)
  {
    header('Location: ./index.php');
    exit();
  }

  while ($donnees_ = $reponse_->fetch())
  {
    $password_ = $donnees_['Password'];
    if($password_ != $pwd_)
    {
      header('Location: ./index.php');
      exit();
    }
  }

  $reponse = $bdd->query("SELECT * FROM T_Personne WHERE Nom_Personne='$personne'");
  while ($donnees = $reponse->fetch())
  {
    $id_personne = $donnees['ID_Personne'];
  }

  $bdd->exec("INSERT INTO T_Choix(FK_Personne, FK_Tea) VALUES('$id_personne', '$tea')");
  header('Location: ./home.php?v1=' . $name_ . '&v2=' . $pwd_);
?>
