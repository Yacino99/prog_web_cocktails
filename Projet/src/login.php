<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Conntectez vous</title>
  <link rel="stylesheet" href="style.css">
 <!-- <script src="script.js"></script> -->
</head>
<body>

<h2>Connectez vous </h2>

<form action="verificationLogin.php" method="post">
  <div class="imgcontainer">
    <img src="img_mendrink.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Login</b></label>
    <input type="text" placeholder="Entrez votre Login" name="login" required>

    <label for="psw"><b>Mot de Passe</b></label>
    <input type="password" placeholder="Entrez votre mot de passe " name="pass" required>

    <button type="submit">Se connecter</button>

     <label for="noAccount"><b>Pas de Compte ? </b> </br> </br> <b>Facile , il suffit den creer un </b>  </label>
      <a href="creerCompte.php"> <button type="button" name="button"> Cree ton compte </button> </a>
  </div>

  <div class="container" style="background-color:#f1f1f1">
         <a href="index.php">   <button type="button" class="cancelbtn"> Annuler </button> </a>
  </div>
</form>


</body>
</html>