<?php
//session_start();
echo "Mon profil"


?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>profil</title>
  <!-- <link rel="stylesheet" href="style.css">-->
  <!-- <script src="script.js"></script> -->
</head>
<body>

<h2>Votre profil </h2>

<form action="verificationProfil.php" method="post">
  <!--
  <div class="imgcontainer">
    <img src="barPic.png" alt="Avatar" class="avatar">
  </div>
  -->

  <div class="container">
    <label for="nom"><b>Nom</b></label>
    <input type="text" placeholder="Entrez votre Nom" name="nom" id="nom2" value="<?= $_SESSION['nom'] ?>" pattern="^[a-zA-Z0-9 \-']*$" > <br>

    <div class="alert" id="warnNom2" style="background-color:FF6868;">
      <p>Le nom doit etre composé de lettres minuscules et/ou de lettres MAJUSCULES, ainsi que les 
          caractères « - », « » (espace) et « ' »   </p>
    </div>

      <label for="prenom"><b>Prenom</b></label>
      <input type="text" placeholder="Entrez votre Prenom" name="prenom" id="prenom2" value="<?= $_SESSION['prenom'] ?>" pattern="^[a-zA-Z0-9\-']*$" >

      <div class="alert" id="warnPrenom2">
      <p>Le Prenom doit etre composé de lettres minuscules et/ou de lettres MAJUSCULES, ainsi que les 
          caractères « - », « » (espace) et « ' »   </p>
    </div>


    <br> <br>

    <label for="naissance"><b>Date de Naissance</b></label>
    <input type="date" placeholder="jj/mm/aaaa" name="naissance" value="<?= $_SESSION['naissance'] ?>" id="naissance2" onchange="majeur()"> <br> <br>

    <label for="adresse"><b>Adresse</b></label>
    <input type="text" placeholder="Adresse" name="adresse" value="<?= $_SESSION['adresse'] ?> "  pattern="^[^%]*$"> <br>

    <label for="poste"><b>Code Postale</b></label>
    <input type="number" placeholder="XXXXX" name="poste" value="<?= $_SESSION['poste'] ?> " pattern="^[^%]*$"> <br>

    <label for="ville"><b>Ville</b></label>
    <input type="text" placeholder="Ville" name="ville" value="<?= $_SESSION['ville'] ?> " pattern="^[^%]*$"> <br>


    <label for="tel"><b>Telephone</b></label>
    <input type="number" placeholder="0XXXXXXXXX" name="tel" id="tel2" value="<?= $_SESSION['tel']?>" pattern="^0([0-9]{9})" > <br>

    <div class="alert" id="warnTel2">
      <p>Le numéro de téléphone est limité aux numéros français standards ; il commence par 0 et est suivi de 9 chiffres.
     </p>
  </div>
     <label for="Email"><b>Email</b></label>
     <input type="text" placeholder="Entrez votre Email" name="email" value="<?= $_SESSION['email'] ?> " required pattern="^[^%]*$"> <br>

    <label for="psw"><b>Mot de Passe</b></label>
    <input type="password" placeholder="Entrez votre mot de passe " name="pass" value="<?= $_SESSION['pass'] ?>" required pattern="^[^%]*$"> <br>

    <button type="submit" id="submit2">Appuyez pour enregistrer les modifications </button>

  </div>

  <div class="container" style="background-color:#f1f1f1">
         <a href="index.php">   <button type="button" class="cancelbtn"> Annuler </button> </a>
  </div>
</form>

<br> <br>


</body>

<script>

  btn = document.getElementById("submit2");
  nom= document.getElementById('nom2');
  prenom  =document.getElementById('prenom2');
  tel = document.getElementById('tel2');


  warnNom = document.getElementById('warnNom2');
  warnNom.style.display = "none";
  
  warnPrenom = document.getElementById('warnPrenom2');
  warnPrenom.style.display = "none";
  
  warnTel = document.getElementById('warnTel2');
  warnTel.style.display = "none";
  

  



  tel.addEventListener('keyup',function(e){

if(/^0([0-9]{9}$)/.test(tel.value) == false)
{
  btn.disabled=true ; 
  btn.innerHTML="Pas de Modification de compte";
  warnTel.style.display = "block";
}
  
else
  {
    btn.disabled=false; 
    btn.innerHTML="Appuyez pour enregistrer les modifications";
    warnTel.style.display = "none";
     
  }
  
} );


nom.addEventListener('keyup',function(e){

if(/^([a-zA-Z]|[a-zA-Z]\-[a-zA-Z]|[a-zA-Z]'[a-zA-Z]|[a-zA-Z]'[a-zA-Z]-[a-zA-Z]'[a-zA-Z]|[a-zA-Z] [a-zA-Z])*$/.test(nom.value) == false)
{
  btn.disabled=true ; 
  btn.innerHTML="Pas de modification de compte";
  warnNom.style.display = "block";
}
  
else
  {
    
    btn.disabled=false; 
    btn.innerHTML="Appuyez pour enregistrer les modifications";
    warnNom.style.display = "none";
     
  }
} );


prenom.addEventListener('keyup',function(e){

if(/^([a-zA-Z]|[a-zA-Z]\-[a-zA-Z]|[a-zA-Z]'[a-zA-Z]|[a-zA-Z]'[a-zA-Z]-[a-zA-Z]'[a-zA-Z]|[a-zA-Z] [a-zA-Z])*$/.test(prenom.value) == false)
{
  console.log("non");
  btn.disabled=true ; 
  btn.innerHTML="Pas de modification de compte";
  warnPrenom.style.display = "block";
}
  
else
  {
    btn.disabled=false; 
    btn.innerHTML="Appuyez pour enregistrer les modifications";
    warnPrenom.style.display = "none";
     
  }
} );



naissance = document.getElementById("naissance2");  // verification de la date

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