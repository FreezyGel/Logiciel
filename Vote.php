<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <title>Logiciel PHP</title>
      <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
    </br></br></br>
    <div id="Content" class="form">
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
      ?>
      <a href="<?php echo './home.php?v1=' . $nom_personne_ . '&v2=' . $pwd_ ?>"><img id="tea" src="tea.png" style="width:60px"/></a>
      <h1 id="Title"><?php
      $title = $_GET["variable"];
      echo $title;
       ?></h1></br>
      <form class="form" method="post" action="<?php echo './scriptVote.php?v1=' . $nom_personne_ . '&v2=' . $pwd_ . '&v3=' . $title?>" >
        <h3>Comment était-il ?</h3></br>
        <table style="width:100%">
          <tr>
            <td style="width:40%"><input type="radio" name="note" value="4" /></td> <td><label>J'ai adoré</label></td>
          </tr>
          <tr>
            <td><input type="radio" name="note" value="2" /></td> <td><label>Il est bon</label></td>
          </tr>
          <tr>
            <td><input type="radio" name="note" value="1" /></td> <td><label>C'est un thé</label></td>
          </tr>
          <tr>
            <td><input type="radio" name="note" value="0" /></td> <td><label>Bof...</label></td>
          </tr>
        </table></br></br>
        <button id="btValider" type="submit">Valider</button>
      </form>
    <p style="color:red; font-size:12px;"><?php
    $error = $_GET['v3'];
    if($error == "NoVote")
    {
      echo "Vous ne pouvez pas voter deux fois pour le même thé !";
    }?></p>
    </div>
    </body>
  </html>
