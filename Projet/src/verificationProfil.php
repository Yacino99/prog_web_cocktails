<?php
session_start();
/**
 * pour l'email , je compare la session avec le post , si je vois qu'ils ont pareil alors je fais rien , sinon je supprimme
 * le mail de la session , je verifie s'il existe le mail du post avant de creer un  nouveau mail avec le post
 */

include_once 'fonctions.php';

if(!isset($_POST['email']) || estVide($_POST['email']) )
    echo "Vous avez mal renseigné votre email , cliquer  ICI ->> <a href='index.php?page=creerCompte'> CREER COMPTE </a> pour ressayer ";

if(!isset($_POST['pass']) || estVide($_POST['pass']) )
    echo "Vous avez mal renseigné votre mot de passe , cliquer  ICI ->> <a href='index.php?page=creerCompte'> CREER COMPTE </a> pour ressayer ";

if(!isset($_POST['nom']) || estVide($_POST['nom']) )
    //echo "Vous avez mal renseigné votre nom , cliquer  ICI ->> <a href='creerCompte.php'> CREER COMPTE </a> pour ressayer ";
    $_POST['nom']=";";

if(!isset($_POST['prenom']) || estVide($_POST['prenom']) )
    //echo "Vous avez mal renseigné votre prenom , cliquer  ICI ->> <a href='creerCompte.php'> CREER COMPTE </a> pour ressayer ";
    $_POST['prenom']=";";

   
    if(!isset($_POST['naissance']) || estVide($_POST['naissance']) )
    $_POST['naissance']=";";

if(!isset($_POST['ville']) || estVide($_POST['ville']) )
    $_POST['ville']=";";

if(!isset($_POST['poste']) || estVide($_POST['poste']) )
    $_POST['poste']=";";

if(!isset($_POST['adresse']) || estVide($_POST['adresse']) )
    $_POST['adresse']=";";  

if(!isset($_POST['tel']) || estVide($_POST['tel']) )
    $_POST['tel']=";";    


print_r($_POST);


   
    $_SESSION['pass'] = trim($_POST['pass']);
    $_SESSION['nom'] = trim($_POST['nom']);
    $_SESSION['prenom'] = trim($_POST['prenom']);
    $_SESSION['naissance'] = trim($_POST['naissance']);
    $_SESSION['adresse'] = trim($_POST['adresse']);
    $_SESSION['poste'] = trim($_POST['poste']);
    $_SESSION['ville'] = trim($_POST['ville']);
    $_SESSION['tel'] = trim($_POST['tel']);


if( $_POST['email'] !== $_SESSION['email'])
{
    $mailSupp = "../emails/".trim($_SESSION['email']).'.txt';

    if (!unlink($mailSupp)) { 
        echo "fichier email ne peut etre supprimé"; 
    }

    $nouvelMail= "../emails/".trim($_POST['email']).'.txt';

    $fichier = fopen($nouvelMail, "w") or die("Unable to open file!");
    fwrite($fichier,"%");
    fclose($fichier);
}


    $fichier = fopen("../users/".trim($_SESSION['login']).'.txt',"w");

    // email login mdp nom prenom sexe naissance ville poste adresse tel

    fwrite($fichier, trim( $_POST['email']) );      
    fwrite($fichier, "%");


  fwrite($fichier, trim( $_POST['login']) );
  fwrite($fichier, "%");

    fwrite($fichier, trim($_POST['pass']) );
    fwrite($fichier, "%");


    fwrite($fichier, trim( $_POST['nom']) );
    fwrite($fichier, "%");

    fwrite($fichier, trim( $_POST['prenom']) );
    fwrite($fichier, "%");

    fwrite($fichier, trim( $_POST['sexe']) );
    fwrite($fichier, "%");

    fwrite($fichier, trim( $_POST['naissance']) );
    fwrite($fichier, "%");

    fwrite($fichier, trim( $_POST['ville']) );
    fwrite($fichier, "%");

    fwrite($fichier, trim( $_POST['poste']) );
    fwrite($fichier, "%");

    fwrite($fichier, trim( $_POST['adresse']) );
    fwrite($fichier, "%");

    fwrite($fichier, trim( $_POST['tel']) );
    fwrite($fichier, "%");


    fwrite($fichier, "%".PHP_EOL);

    fclose($fichier);

   

    $_SESSION['email'] = trim($_POST['email']);

header("Location: index.php");


?>