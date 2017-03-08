<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>TeaTime - Login</title>



      <link rel="stylesheet" href="css/style.css">


</head>

<body>
  <div class="login-page">
    <h1 style="color:white">TeaTime - Login</h1>
  <div class="form">
    <form class="register-form" method="post" action="./Create.php">
      <input type="text" name="name" placeholder="Name or Pseudo"/>
      <input type="text" name="email" placeholder="E-mail address"/>
      <input type="password" name="pwd" placeholder="Password"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" method="post" action="./Connexion.php">
      <input type="text" name="name" value="<?php $nom_personne = $_GET['value'];echo $nom_personne ?>" placeholder="Username"/>
      <input type="password" name="pwd" placeholder="Password"/>
      <button type="submit">login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p></br>
      <a href="./MDPO.php"style="color:darkgreen;font-size:12px;">Mot de passe oublié ?</a>
      <p style="color:red; font-size:12px;"><?php
      $error = $_GET['error'];
      if($error == "true")
      {
        echo "Votre login ou votre mot de passe est incorrecte";
      }?></p>
    </form>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
