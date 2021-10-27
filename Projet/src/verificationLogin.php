<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<style>
.center {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  border: 5px solid #FFFF00;
  padding: 10px;
}

</style>
</head>
<body>

<?php
$titre= "<h2 style='color:red'>Erreur Login ou mot de passe incorrect</h2>";

$box="
<div class='center'>
  <p>reassyez ici   <a href='Login.php'> PAGE DE LOGIN </a>
  ou creer un compte ici -->   <a href='creerCompte.php'> CREER COMPTE </a>

  </p>
</div>
";

 ?>

<?php


include_once 'fonctions.php';

if (! file_exists("users.txt") )
{

    echo "$titre";
    echo "$box";

}
elseif (! loginExist($_POST['login'])) {

    echo "$titre";
    echo "$box";

}
elseif (mdpCorrect($_POST['login'] , $_POST['pass'])) {
  // code...
  $_SESSION['usr'] = $_POST['login'];
  header("Location: welcome.php");
}
else {
  //include_once 'welcome.php';
  //header("Location: welcome.php");


    echo "<h2 style='color:red'>Erreur :  mot de passe incorrect</h2>" ;


  echo "<div class='center'>
          <p>reassyez ici   <a href='Login.php'> PAGE DE LOGIN </a>
          ou creer un compte ici -->   <a href='creerCompte.php'> CREER COMPTE </a>

          </p>
        </div>";

}


 ?>

</body>
</html>
