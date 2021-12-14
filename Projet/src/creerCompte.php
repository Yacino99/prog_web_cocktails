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


//--on recupere les id des input du nom , prenom et telephone ainsi que le bouton submit et le input du login

  btn = document.getElementById("submit");
  login = document.getElementById('login');
  nom= document.getElementById('nom');
  prenom  =document.getElementById('prenom');
  tel = document.getElementById('numTel');

  //---on recupere les id des div de warning , puis on les cache toutes

  warn = document.getElementById('warn');
  warn.style.display = "none";

  warnNom = document.getElementById('warnNom');
  warnNom.style.display = "none";
  
  warnPrenom = document.getElementById('warnPrenom');
  warnPrenom.style.display = "none";
  
  warnTel = document.getElementById('warnTel');
  warnTel.style.display = "none";
  

 
  var utilisateurs = "";


//---on fait un ecouteur d'evenement de chaque touche frappe pour verifier si le numero est valide
//--si le numero n'est pas valide , on affiche la div eton desactive le bouton submit

  

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


//---on fait un ecouteur d'evenement de chaque touche frappe pour verifier si le nom est valide
//--si le nom n'est pas valide , on affiche la div eton desactive le bouton submit


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



//---on fait un ecouteur d'evenement de chaque touche frappe pour verifier si le prenom est valide
//--si le prenom n'est pas valide , on affiche la div eton desactive le bouton submit



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


// fonction qui verifie si un fichier existe , renvoie true si oui , sinon false
// on utilise du AJAX pour faire une requete XMLhttp
// si on trouve pas le fichier ( status == 404 ) on revoie false ,sinon on renvoie true

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

// dans le cas ou le login est deja existant 
// cette fonction affiche la div de warning , met le bouton submit en rouge
// et on desactive le bouton de submit

function ilExiste(){
  btn.disabled=true ; 
  btn.className = "redButton" ;
  btn.innerHTML="Pas de creation de compte";
   warn.style.display = "block";
  return;
}

// dans le cas ou le login est pas deja existant 
// cette fonction cache la div de warning , met le bouton submit en blanc
// et on active le bouton de submit

function ilExistePas(){
  btn.disabled=false; 
  btn.className = "";
  btn.innerHTML="Creer le compte !"; 
  warn.style.display = "none"; 
  return;
}

// on ecoute chaque touche frappe par le user quand il tape le login et on recupere la valeur tapé
// on cree une variable fichier et on la met sous la forme de "valeurRecupere".txt
// si le le fichier existe deja , on appelle la fonction ilExiste() qui bloque le submit et affiche le warning
// sinon on appelle la fonction IlExsitePas() qui remet les choses a la normale

login.addEventListener("keyup", function( event ) {

  fichier = "../users/"+login.value.trim()+".txt";

  console.log(fichier);

  if(checkFileExist(fichier)) ilExiste();
  else ilExistePas();

  if(login.value.trim() === "user")
  {
    btn.disabled=true ; 
    btn.className = "redButton" ;
    btn.innerHTML="Pas de creation de compte";
    alert("le login ne doit pas etre au nom de 'user' (il est sacré)");
  }
  else
  {
    btn.disabled=false; 
    btn.className = "";
    btn.innerHTML="Creer le compte !"; 
  }

});
 

naissance = document.getElementById("naissance");    // on recupere la date de naissance saisie par l'utilisateur

var aujourdhui = new Date();
var cetteAnnee = aujourdhui.getFullYear();  //recuperation de la date d'aujourd'hui


//--- fonction qui verifie si l'utilisateur est majeur , si oui on fait rien (le bouton reste active)
// sinon on affiche une popup qui lui dit qu'il faut etre majeur
// et on desactive le bouton submit


function majeur(){
var ladate = naissance.value.split('-');

  var age =  cetteAnnee -  ladate[0];  // on verifie l'age
  if(age < 18){
    alert("Tu dois avoir plus de 18 pour boire , gamin");
    btn.disabled=true;
  }
  else
    btn.disabled=false;

}




  </script>


</html>
