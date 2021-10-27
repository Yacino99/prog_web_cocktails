<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Creer votre compte</title>
  <link rel="stylesheet" href="style.css">
 <!-- <script src="script.js"></script> -->
</head>
<body>

<h2>Inscrivez vous </h2>

<form action="verificationSignup.php" method="post">
  <div class="imgcontainer">
    <img src="barPic.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="nom"><b>Nom</b></label>
    <input type="text" placeholder="Entrez votre Nom" name="nom" required>

      <label for="prenom"><b>Prenom</b></label>
      <input type="text" placeholder="Entrez votre Prenom" name="prenom" required>

    <label for="uname"><b>Login</b></label>
    <input type="text" placeholder="Entrez votre Login" name="login" required>

     <label for="Email"><b>Email</b></label>
     <input type="text" placeholder="Entrez votre Email" name="email" required>

    <label for="psw"><b>Mot de Passe</b></label>
    <input type="password" placeholder="Entrez votre mot de passe " name="pass" required>

    <button type="submit">Creer le Compte ! </button>

  </div>

  <div class="container" style="background-color:#f1f1f1">
         <a href="index.php">   <button type="button" class="cancelbtn"> Annuler </button> </a>
  </div>
</form>


</body>
</html>