<?php
//session_start();
echo "Mon profil"

//--TODO : stocker la session dans des variables pour eviter les ;

/*
if(!isset($_SESSION['naissance']) || strcmp($_SESSION['naissance'],";") === 0 )
{

  $date_naissance="";
}
  else
    $date_naissance=$_SESSION['naissance'];
*/
   

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

      <label for="prenom"><b>Prenom</b></label>
      <input type="text" placeholder="Entrez votre Prenom" name="prenom" id="prenom2" value="<?= $_SESSION['prenom'] ?>" pattern="^[a-zA-Z0-9\-']*$" >

   

    <br> <br>

    <label for="naissance"><b>Date de Naissance</b></label>
    <input type="date" placeholder="jj/mm/aaaa" name="naissance" value="<?= $_SESSION['naissance'] ?>" id="naissance" onchange="majeur()"> <br> <br>

    <label for="adresse"><b>Adresse</b></label>
    <input type="text" placeholder="Adresse" name="adresse" value="<?= $_SESSION['adresse'] ?>" > <br>

    <label for="poste"><b>Code Postale</b></label>
    <input type="number" placeholder="XXXXX" name="poste" value="<?= $_SESSION['poste'] ?>"> <br>

    <label for="ville"><b>Ville</b></label>
    <input type="text" placeholder="Ville" name="ville" > <br>


    <label for="tel"><b>Telephone</b></label>
    <input type="number" placeholder="0XXXXXXXXX" name="tel" id="tel2" value="<?= $_SESSION['tel'] ?>" pattern="^0([0-9]{9})" > <br>


     <label for="Email"><b>Email</b></label>
     <input type="text" placeholder="Entrez votre Email" name="email" value="<?= $_SESSION['email'] ?>" required> <br>

    <label for="psw"><b>Mot de Passe</b></label>
    <input type="password" placeholder="Entrez votre mot de passe " name="pass" value="<?= $_SESSION['pass'] ?>" required> <br>

    <button type="submit" id="submit2">Appuyez pour enregistrer les modifications </button>

  </div>

  <div class="container" style="background-color:#f1f1f1">
         <a href="index.php">   <button type="button" class="cancelbtn"> Annuler </button> </a>
  </div>
</form>

<br> <br>
<form action="supprimerCompte.php">

  
<button type="submit" id="submit3">Supprimer le compte </button>


</form>

</body>
