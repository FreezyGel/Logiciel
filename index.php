<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <title>Logiciel PHP</title>
    </head>
    <body>
      <h1>Page HTML et PHP</h1>
      <form method="post" action="./script.php">
        <select style="width:150px" id="Personne">
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
          <option value=" <?php echo $donnees['Nom_Personne']; ?>"> <?php echo $donnees['Nom_Personne']; ?></option>
          <?php
          }
          $reponse->closeCursor();
          ?>
        </select></br></br>
        <select style="width:150px" id="Tea">
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
          <option value=" <?php echo $donnees['Nom_Tea']; ?>"> <?php echo $donnees['Nom_Tea']; ?></option>
          <?php
          }
          $reponse->closeCursor();
          ?>
        </select></br></br>
        <select style="width:150px" id="Type">
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
          $reponse = $bdd->query('SELECT * FROM T_Type');

          while ($donnees = $reponse->fetch())
          {
          ?>
          <option value=" <?php echo $donnees['Nom_Type']; ?>"> <?php echo $donnees['Nom_Type']; ?></option>
          <?php
          }
          $reponse->closeCursor();
          ?>
        </select></br></br>
        <button style="width:80px" type="submit">Valider</button>
      </form>
      <div id="Info_Tea">
      </div>
    </body>
  </html>
