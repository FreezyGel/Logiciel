<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <title>Logiciel PHP</title>
      <link rel="stylesheet" href="Style.css">
    </head>
    <body>
    <div id="Content">
      <script>
        function refresh() {
          document.getElementById("Info_TeaBox").innerHTML = "Hello JavaScript!";
        }
      </script>
      <img id="tea" src="tea.png" style="width:40px"/>
      <h1>Tea Time</h1></br></br>
      <form method="post" action="./script.php" >
        <select id="Personne">
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
          $reponse = $bdd->query('SELECT * FROM T_Personne');
          while ($donnees = $reponse->fetch())
          {
          ?>
          <option value="<?php echo $donnees['Nom_Personne']; ?>"> <?php echo $donnees['Nom_Personne']; ?></option>
          <?php
          }
          $reponse->closeCursor();
          ?>
        </select></br></br>
        <select onclick="refresh();" id="Tea">
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
          $reponse = $bdd->query('SELECT * FROM T_Tea');
          while ($donnees = $reponse->fetch())
          {
          ?>
            <option value="<?php echo $donnees['Nom_Tea']; ?>"> <?php echo $donnees['Nom_Tea']; ?></option>
          <?php
          }
          $reponse->closeCursor();
          ?>
        </select></br></br></br></br>
        <button id="btValider" type="button">Valider</button>
      </form>
    </div>
    <div id="Info_Tea">
      <p id="Info_TeaBox" />
    </div>
    </body>
  </html>
