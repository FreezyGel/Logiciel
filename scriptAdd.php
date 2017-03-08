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

  $nom = $_POST['Nom_Tea'];
  $ing = $_POST['Nom_Ing'];
  $pwd_ = $_GET['v2'];
  $nom_personne_ = $_GET['v1'];

  $bdd->exec("INSERT INTO T_Tea(Nom_Tea) VALUES('$nom')");
  $bdd->exec("INSERT INTO T_Ingredient(Nom_Ingredient) VALUES('$ing')");

  header('Location: ./home.php?v1=' . $nom_personne_ . '&v2=' . $pwd_);
?>
