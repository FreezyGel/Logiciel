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

  $pwd_ = $_GET['v2'];
  $nom_personne_ = $_GET['v1'];
  $title = $_GET['v3'];
  $note = $_POST['note'];


  $reponse = $bdd->query("SELECT * FROM T_Tea WHERE Nom_Tea='$title'");
  while ($donnees = $reponse->fetch())
  {
    $point = $donnees['Point_Tea'];
    $id_tea = $donnees['ID_Tea'];
    $note = $note + $point;
  }

  $reponse1 = $bdd->query("SELECT * FROM T_Personne WHERE Nom_Personne='$nom_personne_'");
  while ($donnees1 = $reponse1->fetch())
  {
    $i_v = $donnees1['Info_Vote'];
  }

  $verif = preg_match("#$title#i", "'.$i_v.'");
  if($verif == false)
  {
      $bdd->exec("UPDATE T_Tea SET Point_Tea='$note' WHERE Nom_Tea='$title' ");
      $i_v_mod = $i_v . "!" . $title . "!";
      $bdd->exec("UPDATE T_Personne SET Info_Vote='$i_v_mod' WHERE Nom_Personne='$nom_personne_' ");
  }
  else {
    header('Location: ./Vote.php?v1=' . $nom_personne_ . '&v2=' . $pwd_ . '&v3=NoVote&variable=' . $title);
    exit();
  }


  header('Location: ./home.php?v1=' . $nom_personne_ . '&v2=' . $pwd_);
?>
