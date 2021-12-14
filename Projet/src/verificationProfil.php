<?php
session_start();
/**
 * pour l'email , je compare la session avec le post , si je vois qu'ils ont pareil alors je fais rien , sinon je supprimme
 * le mail de la session , je verifie s'il existe le mail du post avant de creer un  nouveau mail avec le post
 */

include_once 'fonctions.php';

// on test si les parametres recu par le formulaire sont vide , si oui , on affiche une erreur pour le cas ou l'email ou le mot de passe est vide
// sinon on stock des espaces dans la variable $_POST afin de stocker tout ceci dans un fichier (notre base de donnee);

if(!isset($_POST['email']) || estVide($_POST['email']) )
    echo "Vous avez mal renseigné votre email , cliquer  ICI ->> <a href='index.php?page=creerCompte'> CREER COMPTE </a> pour ressayer ";

if(!isset($_POST['pass']) || estVide($_POST['pass']) )
    echo "Vous avez mal renseigné votre mot de passe , cliquer  ICI ->> <a href='index.php?page=creerCompte'> CREER COMPTE </a> pour ressayer ";

if(!isset($_POST['nom']) || estVide($_POST['nom']) )
    $_POST['nom']=" ";

if(!isset($_POST['prenom']) || estVide($_POST['prenom']) )
    $_POST['prenom']=" ";

   
    if(!isset($_POST['naissance']) || estVide($_POST['naissance']) )
    $_POST['naissance']=" ";

if(!isset($_POST['ville']) || estVide($_POST['ville']) )
    $_POST['ville']=" ";

if(!isset($_POST['poste']) || estVide($_POST['poste']) )
    $_POST['poste']=" ";

if(!isset($_POST['adresse']) || estVide($_POST['adresse']) )
    $_POST['adresse']=" ";  

if(!isset($_POST['tel']) || estVide($_POST['tel']) )
    $_POST['tel']=" ";    


    //-- maintenant qu'on a le format qu'on veut , on enregistre les infos de l'utilisateur dans des sessions
    
    $_SESSION['pass'] = trim($_POST['pass']);
    $_SESSION['nom'] = trim($_POST['nom']);
    $_SESSION['prenom'] = trim($_POST['prenom']);
    $_SESSION['naissance'] = trim($_POST['naissance']);
    $_SESSION['adresse'] = trim($_POST['adresse']);
    $_SESSION['poste'] = trim($_POST['poste']);
    $_SESSION['ville'] = trim($_POST['ville']);
    $_SESSION['tel'] = trim($_POST['tel']);


    //-- si l'utilisateur n'a pas modifier son email , on efface le fichier deja existant et on recree un identique

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

    // on enregistre les modification dans le fichier "nom_Utilisateur".txt les modifications qu'il a fourni sous le format suivant :
    // email%login%motDePasse%nom%prenom%sexe%naissance%ville%poste%adresse%tel

    //-- on ouvre le fichier en mode ecrasement
    $fichier = fopen("../users/".trim($_SESSION['login']).'.txt',"w");
    
        //-- on ecrase les donnees

    fwrite($fichier, trim( $_POST['email']) );      
    fwrite($fichier, "%");


  fwrite($fichier, trim( $_SESSION['login']) );
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

header("Location: index.php");  // on redirige vers la page d'acceuil


?>