<?php
session_start();

include_once 'fonctions.php';

$debutHtmlEtStyle = "<!DOCTYPE html>
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
";

$finhtml = "
</body>
</html>
";

if(!isset($_POST['email']) || estVide($_POST['email']) )
    echo "Vous avez mal renseigné votre email , cliquer  ICI ->> <a href='creerCompte.php'> CREER COMPTE </a> pour ressayer ";

if(!isset($_POST['pass']) || estVide($_POST['pass']) )
    echo "Vous avez mal renseigné votre mot de passe , cliquer  ICI ->> <a href='creerCompte.php'> CREER COMPTE </a> pour ressayer ";

if(!isset($_POST['nom']) || estVide($_POST['nom']) )
    echo "Vous avez mal renseigné votre nom , cliquer  ICI ->> <a href='creerCompte.php'> CREER COMPTE </a> pour ressayer ";

if(!isset($_POST['prenom']) || estVide($_POST['prenom']) )
    echo "Vous avez mal renseigné votre prenom , cliquer  ICI ->> <a href='creerCompte.php'> CREER COMPTE </a> pour ressayer ";

if(!isset($_POST['login']) || estVide($_POST['login']) )
    echo "Vous avez mal renseigné votre login , cliquer  ICI ->> <a href='creerCompte.php'> CREER COMPTE </a> pour ressayer ";

if (! file_exists("users.txt") )
{
  $myfile = fopen("users.txt", "w") or die("Unable to open file!");

  fwrite($myfile, trim( $_POST['email']) );      // email login mdp nom prenom
  fwrite($myfile, " ");


  fwrite($myfile, trim( $_POST['login']) );
  fwrite($myfile, " ");

    fwrite($myfile, trim($_POST['pass']) );
    fwrite($myfile, " ");


    fwrite($myfile, trim( $_POST['nom']) );
    fwrite($myfile, " ");

    fwrite($myfile, trim( $_POST['prenom']) );
    fwrite($myfile, " ");

    fwrite($myfile, " ".PHP_EOL);

  $_SESSION['login'] = $_POST['login'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['pass'] = $_POST['pass'];
  $_SESSION['nom'] = $_POST['nom'];
  $_SESSION['prenom'] = $_POST['prenom'];

  fclose($myfile);

  header("Location: index.php");

}elseif (emailExist($_POST['email'])) {

  //echo "Email deja existant !! try again ici -->   <a href='creerCompte.php'> CREER COMPTE </a>";

  echo "$debutHtmlEtStyle";
  echo "<h2 style='color:red'>Erreur Email deja existant</h2>";

  echo "<div class='center'>
              <p>reassyez ici   <a href='creerCompte.php'> CREER COMPTE </a>
              </p>
            </div>";

  echo "$finhtml";

}elseif(loginExist($_POST['login']))
{

  echo "$debutHtmlEtStyle";

    echo "<h2 style='color:red'>Erreur Login deja existant</h2>";

    echo "<div class='center'>
            <p>reassyez ici   <a href='creerCompte.php'> CREER COMPTE </a>
            </p>
          </div>";

    echo "$finhtml";

}
else {

  $myfile = fopen("users.txt", "a") or die("Unable to open file!");

  fwrite($myfile, trim($_POST['email']) );      // email login mdp nom prenom
  fwrite($myfile, " ");

  fwrite($myfile, trim( $_POST['login']) );
  fwrite($myfile, " ");

  fwrite($myfile, trim($_POST['pass']) );
  fwrite($myfile, " ");


  fwrite($myfile, trim( $_POST['nom']) );
  fwrite($myfile, " ");

  fwrite($myfile, trim( $_POST['prenom']) );
  fwrite($myfile, " ");

  fwrite($myfile, " ".PHP_EOL);

  fclose($myfile);

  $_SESSION['login'] = $_POST['login'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['pass'] = $_POST['pass'];
  $_SESSION['nom'] = $_POST['nom'];
  $_SESSION['prenom'] = $_POST['prenom'];

  header("Location: index.php");
}

  ?>
