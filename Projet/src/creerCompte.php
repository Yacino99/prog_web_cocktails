<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Creer votre compte</title>
  <!-- <link rel="stylesheet" href="style.css">-->
  <!-- <script src="script.js"></script> -->
</head>
<body>

<h2>Inscrivez vous </h2>

<form action="verificationSignup.php" method="post">
  <!--
  <div class="imgcontainer">
    <img src="barPic.png" alt="Avatar" class="avatar">
  </div>
  -->

  <div class="container">
    <label for="nom"><b>Nom</b></label>
    <input type="text" placeholder="Entrez votre Nom" name="nom"  id="nom" >

    <div class="alert" id="warnNom">
      <p>Le nom doit etre composé de lettres minuscules et/ou de lettres MAJUSCULES, ainsi que les 
          caractères « - », « » (espace) et « ' »   </p>
    </div>

      <label for="prenom"><b>Prenom</b></label>
      <input type="text" placeholder="Entrez votre Prenom" name="prenom"  id="prenom">
        
      <div class="alert" id="warnPrenom">
      <p>Le Prenom doit etre composé de lettres minuscules et/ou de lettres MAJUSCULES, ainsi que les 
          caractères « - », « » (espace) et « ' »   </p>
    </div>

      <p> <strong >Sexe : </strong> </p>


    <input type="radio" 
     name="sexe" value="homme">
    <label for="Homme">Homme</label>

    <input type="radio"
     name="sexe" value="femme">
    <label for="Femme">Femme</label>

    <br> <br>

    <label for="naissance"><b>Date de Naissance</b></label>
    <input type="date" placeholder="jj/mm/aaaa" name="naissance" id="naissance" onchange="majeur()" > <br> <br>

    <label for="adresse" ><b>Adresse</b></label>
    <input type="text" placeholder="Adresse" name="adresse" pattern="^[^%]*$"> <br>

    <label for="poste"><b>Code Postale</b></label>
    <input type="number" placeholder="XXXXX" name="poste" pattern="^[^%]*$"> <br>

    <label for="ville"><b>Ville</b></label>
    <input type="text" placeholder="Ville" name="ville" pattern="^[^%]*$"> <br>


    <label for="uname"><b>Login</b></label>
    <input type="text" placeholder="Entrez votre Login" name="login" id="login" required pattern="^[a-zA-Z0-9_]*$">
    <br>
    <div class="alert" id="warn">
      <p>Login deja existant ! choisissez un autre </p>
    </div>

    <label for="tel"><b>Telephone</b></label>
    <input type="number" placeholder="0XXXXXXXXX" name="tel" pattern="^0([0-9]{9}$)" id="numTel"> <br>

    <div class="alert" id="warnTel">
      <p>Le numéro de téléphone est limité aux numéros français standards ; il commence par 0 et est suivi de 9 chiffres.
     </p>

    </div>


     <label for="Email"><b>Email</b></label>
     <input type="text" placeholder="Entrez votre Email" name="email" required pattern="^[^%]*$">

    <label for="psw"><b>Mot de Passe</b></label>
    <input type="password" placeholder="Entrez votre mot de passe " name="pass" required pattern="^[^%]*$">

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
  nom= document.getElementById('nom');
  prenom  =document.getElementById('prenom');
  tel = document.getElementById('numTel');


  warn = document.getElementById('warn');
  warn.style.display = "none";

  warnNom = document.getElementById('warnNom');
  warnNom.style.display = "none";
  
  warnPrenom = document.getElementById('warnPrenom');
  warnPrenom.style.display = "none";
  
  warnTel = document.getElementById('warnTel');
  warnTel.style.display = "none";
  

 
  var utilisateurs = "";

  function verifierRegex(texte , regex , id) // texte : texte  tester la regex | regex : la regex | id : id du warn
  {
    if(/regex/.test(texte) == false)
    {
      btn.disabled=true ; 
      btn.innerHTML="Pas de creation de compte";
      id.style.display = "block";
      
    }
    else
    {
      btn.disabled=false; 
      btn.innerHTML="Creer le compte";
      id.style.display = "none";
       
    }
  }



tel.addEventListener('keyup',function(e){

  if(/^0([0-9]{9}$)/.test(tel.value) == false)
  {
    btn.disabled=true ; 
    btn.innerHTML="Pas de creation de compte";
    warnTel.style.display = "block";
  }
    
  else
    {
      btn.disabled=false; 
      btn.innerHTML="Creer le compte";
      warnTel.style.display = "none";
       
    }
} );


nom.addEventListener('keyup',function(e){

if(/^([a-zA-Z]|[a-zA-Z]\-[a-zA-Z]|[a-zA-Z]'[a-zA-Z]|[a-zA-Z]'[a-zA-Z]-[a-zA-Z]'[a-zA-Z]|[a-zA-Z] [a-zA-Z])*$/.test(nom.value) == false)
{
  console.log("non");
  btn.disabled=true ; 
  btn.innerHTML="Pas de creation de compte";
  warnNom.style.display = "block";
}
  
else
  {
    console.log("oui");
    btn.disabled=false; 
    btn.innerHTML="Creer le compte";
    warnNom.style.display = "none";
     
  }
} );

prenom.addEventListener('keyup',function(e){

if(/^([a-zA-Z]|[a-zA-Z]\-[a-zA-Z]|[a-zA-Z]'[a-zA-Z]|[a-zA-Z]'[a-zA-Z]-[a-zA-Z]'[a-zA-Z]|[a-zA-Z] [a-zA-Z])*$/.test(prenom.value) == false)
{
  console.log("non");
  btn.disabled=true ; 
  btn.innerHTML="Pas de creation de compte";
  warnPrenom.style.display = "block";
}
  
else
  {
    console.log("oui");
    btn.disabled=false; 
    btn.innerHTML="Creer le compte";
    warnPrenom.style.display = "none";
     
  }
} );


function checkFileExist(fileurl)
{
  var xhr = new XMLHttpRequest();
  xhr.open('HEAD',fileurl,false);
  xhr.send();

  if(xhr.status == 404)
    return false;
  else
    return true;
}

function ilExiste(){
  btn.disabled=true ; 
  btn.className = "redButton" ;
  btn.innerHTML="Pas de creation de compte";
   warn.style.display = "block";
  return;
}

function ilExistePas(){
  btn.disabled=false; 
  btn.className = "";
  btn.innerHTML="Creer le compte !"; 
  warn.style.display = "none"; 
  return;
}

login.addEventListener("keyup", function( event ) {

  console.log("okay");

  fichier = "./users/"+login.value+".txt"

  console.log(fichier);

  if(checkFileExist(fichier)) ilExiste();
  else ilExistePas();
});
 

naissance = document.getElementById("naissance");  // verification de la date

var aujourdhui = new Date();
var cetteAnnee = aujourdhui.getFullYear();


function majeur(){
var ladate = naissance.value.split('-');

  var age =  cetteAnnee -  ladate[0];
  if(age < 18){
    alert("Tu dois avoir plus de 18 pour boire , gamin");
    btn.disabled=true;
  }
  else
    btn.disabled=false;

}




  </script>


</html>
