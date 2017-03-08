<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <title>TeaTime</title>
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

        if($pwd_ == "" || $nom_personne_ == "")
        {
          header('Location: ./index.php');
          exit();
        }
        $reponse_ = $bdd->query("SELECT * FROM T_Personne WHERE Nom_Personne='$nom_personne_'");
        $userPass = $reponse_->rowCount();
        if($userPass == 0)
        {
          header('Location: ./index.php');
          exit();
        }
        while ($donnees = $reponse_->fetch())
        {
          $password_ = $donnees['Password'];
          if($password_ != $pwd_)
          {
            header('Location: ./index.php');
            exit();
          }
        }
      ?>
      <script>
        function refresh()
        {
          var select = document.getElementById("Tea");
          choice = select.selectedIndex;
          valeur_cherchee = select.options[choice].value;
          var i = 0;
          var text = "ing_" + valeur_cherchee;
          var box = "Box_ing_" + valeur_cherchee;
          for (;select[i];)
          {
            var box_all = "Box_ing_" + select[i].value;
            document.getElementById(box_all).className = "hidden";
            i++;
          }
          document.getElementById(box).className = "form";
          document.getElementById(box).style.padding = "20px";
        }
      </script>
      <h1 id="Title">Tea Time</h1></br></br>
      <form method="post" action="<?php echo './script.php?v1=' . $nom_personne_ . '&v2=' . $pwd_ ?>" >
        <select name="Personne" readonly><option value="<?php $nom_personne = $_GET['v1'];echo $nom_personne ?>"><?php $nom_personne = $_GET['v1'];echo $nom_personne ?></option></select>
        </select></br></br></br>
        <select onclick="refresh();" name="Tea" id="Tea">
          <?php
          $reponse = $bdd->query('SELECT * FROM T_Tea');
          while ($donnees = $reponse->fetch())
          {
          ?>
            <option value="<?php echo $donnees['ID_Tea']; ?>"> <?php echo $donnees['Nom_Tea']; ?></option>
          <?php
          }
          $reponse->closeCursor();
          ?>
        </select>
        </br></br></br></br>
        <button id="btValider" type="submit">Valider</button></br></br></br>
        <a href="<?php echo './add.php?v1=' . $nom_personne_ . '&v2=' . $pwd_?>">Ajouter un thé<a/>
      </form>
    </div>
    <div id="Info_Supp">
      <?php
      $reponse = $bdd->query('SELECT * FROM T_Ingredient');
      while ($donnees = $reponse->fetch())
      {
      ?>
        <div class="hidden" id="Box_ing_<?php echo $donnees['ID_Ingredient']; ?>">
          <p id="ing_<?php echo $donnees['ID_Ingredient']; ?>"><?php echo $donnees['Nom_Ingredient']; ?></p>
        </div>
      <?php
      }
      $reponse->closeCursor();
      ?>
    </div>
    <div class="form" id="top">
      <h2 style="color:black;">Top 5</h2>
      <table>
      <?php
        $reponse = $bdd->query("SELECT * FROM T_Tea ORDER BY Point_Tea DESC");
        $count = 0;
        while ($donnees = $reponse->fetch())
        {
          $point_tea_top = $donnees['Point_Tea'];
          $nom_tea_top = $donnees['Nom_Tea'];
          if($count < 5)
          {
            $count++;
            if($point_tea_top != 0)
            {
          ?>
          <tr><td><p style="text-align:left;"><?php echo $count . ". " . $nom_tea_top;?></p></td></tr>
          <?php
            }
          }
        }
      ?>
    </table>
    </div>
    <div id="footer">
      <table id="table_d">
        <tr id="tr_Eti">
          <td>Nom</td>
          <?php
            //Création du tableau et affichage de la liste des thés utilisés
            $reponse = $bdd->query('SELECT * FROM T_Choix');
            $list = "";
            while ($donnees = $reponse->fetch())
            {
              $nom_tea = "";
              $id_tea = $donnees['FK_Tea'];
              $reponse1 = $bdd->query("SELECT * FROM T_Tea WHERE ID_Tea='$id_tea'");
              while ($donnees2 = $reponse1->fetch())
              {
                $nom_tea = $donnees2['Nom_Tea'];
              }
              $verif = preg_match("#$nom_tea#i", "'.$list.'");
              if($verif == false)
              {
                $list = $list . $nom_tea;
                //Modification du la chaîne de carractères pour avoir que les initials
                $str = explode(' ',$nom_tea);
                $val = "";
                foreach ($str as $item)
                {
                  $val = $val . $item[0] . $item[1] . " ";
                }
                $lien = "window.location.href='./Vote.php?variable=$nom_tea&v1=$nom_personne_&v2=$pwd_'";
                //Affichage
          ?>
            <td><button onclick="<?php echo $lien; ?>" TITLE="<?php echo $nom_tea; ?>" type="submit" class="buttonTable"><?php echo $val; ?></button></td>
          <?php
              }
            }
          $reponse->closeCursor();
          ?>
          <td><?php echo "Total"; ?></td>
          </tr>
          <?php
            $reponse = $bdd->query('SELECT * FROM T_Choix');
            $list = "";
            while ($donnees = $reponse->fetch())
            {
              $nom_personne = "";
              $id_personne = $donnees['FK_Personne'];
              $reponse1 = $bdd->query("SELECT * FROM T_Personne WHERE ID_Personne='$id_personne'");
              while ($donnees2 = $reponse1->fetch())
              {
                $nom_personne = $donnees2['Nom_Personne'];
              }
              $verif = preg_match("#$nom_personne#i", "'.$list.'");
              if($verif == false)
              {
                $list = $list . $nom_personne;
                //Affichage
                ?>
                <tr>
                  <td><?php echo $nom_personne; ?></td>
                  <?php
                    // Boucle qui ajoute dans le tableau les thés par personnes
                    $reponseTea = $bdd->query('SELECT * FROM T_Choix');
                    $listTea = "";
                    // Compteur de thés Total par personnes
                    $TotalTea = 0;
                    while ($donneesTea = $reponseTea->fetch())
                    {
                      $nom_tea00 = "";
                      $id_tea00 = $donneesTea['FK_Tea'];
                      $reponse10 = $bdd->query("SELECT * FROM T_Tea WHERE ID_Tea='$id_tea00'");
                      while ($donnees20 = $reponse10->fetch())
                      {
                        $nom_tea00 = $donnees20['Nom_Tea'];
                      }
                      $verif = preg_match("#$nom_tea00#i", "'.$listTea.'");
                      if($verif == false)
                      {
                        $listTea = $listTea . $nom_tea00;
                        $reponseTeaT = $bdd->query("SELECT * FROM T_Choix WHERE FK_Personne='$id_personne' AND FK_Tea='$id_tea00'");
                        $TotalTea = $TotalTea + $reponseTeaT->rowCount();
                        //Affichage
                  ?>
                    <td style="text-align:center;"><?php echo $reponseTeaT->rowCount(); ?></td>
                  <?php
                      }
                    }
                  ?>
                  <td><?php echo $TotalTea ?></td>
                </tr>
              <?php
              }
            }
            $reponse->closeCursor();
            ?>
          </table>
    </div>
    </body>
  </html>
