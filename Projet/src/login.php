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

<form action="verificationLogin.php" method="post" id="signup">
  <div class="imgcontainer">
    <img src="img_mendrink.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Login</b></label>
    <input type="text" placeholder="Entrez votre Login" name="login" id="login" required>

      <!--
      <div class="alert" id="warnLogin">
          <p> Le login ne doit pas etre vide </p>
      </div>

    -->

      <label for="psw"><b>Mot de Passe</b></label>
    <input type="password" placeholder="Entrez votre mot de passe "  id="pass" name="pass" required>
     <!--
      <div class="alert" id="warnPass">
          <p>le mot de pass ne doit pas etre vide </p>
      </div>
    -->
      <button type="submit" id="submit">Se connecter</button>

     <label for="noAccount"><b>Pas de Compte ? </b> </br> </br> <b>Facile , il suffit den creer un </b>  </label>
      <a href="creerCompte.php"> <button type="button" name="button"> Cree ton compte </button> </a>
  </div>

  <div class="container" style="background-color:#f1f1f1">
         <a href="index.php">   <button type="button" class="cancelbtn"> Annuler </button> </a>
  </div>
</form>


</body>

<script>
 /*
  function estVide(text){
      return text.trim() === '';
  }

  var login = document.getElementById('login');
  var pass = document.getElementById('pass');
  var warn1 = document.getElementById('warnLogin');
  var warn2 = document.getElementById('warnPass');
  btn = document.getElementById("submit");

  warn1.style.display = "none";
  warn2.style.display = "none";

  login.addEventListener('keyup',function(e){
      if(estVide(e.value))
      {
          btn.disabled=true ; btn.className = "redButton" ;btn.innerHTML="Pas de creation de compte";
          warn1.style.display = "block";
          return;
      }
      else
      {
          btn.disabled=true ; btn.className = "" ;btn.innerHTML="Creer le compte !";
          warn1.style.display = "none";
          return;
      }
  });
*/
</script>

</html>