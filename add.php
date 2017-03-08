<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <title>TeaTime - Ajout de Tea</title>
      <link rel="stylesheet" href="css/style.css">
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
      <h1 id="Title">Ajouter un Thé</h1></br>
      <form method="post" action="<?php echo './scriptAdd.php?v1=' . $nom_personne_ . '&v2=' . $pwd_?>" >
        <label>Nom du thé</label></br></br>
        <input type="text" name="Nom_Tea" /></br></br>
        <label>Ingrédients</label></br></br>
        <input type="text" name="Nom_Ing"/></br></br></br>
        <button id="btValider" type="submit">Valider</button>
      </form>
    </div>
    </body>
  </html>
