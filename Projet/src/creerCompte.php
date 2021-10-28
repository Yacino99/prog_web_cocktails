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
    <input type="text" placeholder="Entrez votre Login" name="login" id="login" required>

    <div class="alert" id="warn">
      <p>Login deja existant ! choisissez un autre </p>
    </div>

     <label for="Email"><b>Email</b></label>
     <input type="text" placeholder="Entrez votre Email" name="email" required>

    <label for="psw"><b>Mot de Passe</b></label>
    <input type="password" placeholder="Entrez votre mot de passe " name="pass" required>

    <button type="submit" id="submit">Creer le Compte ! </button>

  </div>

  <div class="container" style="background-color:#f1f1f1">
         <a href="index.php">   <button type="button" class="cancelbtn"> Annuler </button> </a>
  </div>
</form>


</body>

<script type="text/javascript">


  btn = document.getElementById("submit");
  login = document.getElementById('login');
  warn = document.getElementById('warn');
  warn.style.display = "none";
  var utilisateurs = "";


  const loginExsistant = function(text) // savoir si le login exist
  {

    lineArray = text.split("\n");


    let existe = false;

    login.addEventListener("keyup", function( event ) {


      for(i = 0 ; i < lineArray.length-1 ; i++){


        mots = lineArray[i].split(" ");

        if(login.value == mots[1] ) {existe = true; break; } else { existe=false; }
    }
        console.log(existe);
        if(login.value === mots[1])
        {
          btn.disabled=true ; btn.className = "redButton" ;btn.innerHTML="Pas de creation de compte"; warn.style.display = "block"; return;
        }else {
           btn.disabled=false; btn.className = "";btn.innerHTML="Creer le compte !"; warn.style.display = "none"; return;
        }

    } )


}

fetch('users.txt')
.then(response => response.text())
.then(text => loginExsistant(text)

)


  </script>


</html>
