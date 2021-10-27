<?php

include_once 'fonctions.php';

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

  fclose($myfile);

  header("Location: index.php");

}elseif (emailExist($_POST['email'])) {
  echo "Email deja existant !! try again ici -->   <a href='creerCompte.php'> CREER COMPTE </a>";

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

  header("Location: index.php");
}

  ?>
