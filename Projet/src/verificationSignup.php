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
    echo "Vous avez mal renseigné votre email , cliquer  ICI ->> <a href='index.php?page=creerCompte'> CREER COMPTE </a> pour ressayer ";

if(!isset($_POST['pass']) || estVide($_POST['pass']) )
    echo "Vous avez mal renseigné votre mot de passe , cliquer  ICI ->> <a href='index.php?page=creerCompte'> CREER COMPTE </a> pour ressayer ";

if(!isset($_POST['nom']) || estVide($_POST['nom']) )
    //echo "Vous avez mal renseigné votre nom , cliquer  ICI ->> <a href='creerCompte.php'> CREER COMPTE </a> pour ressayer ";
    $_POST['nom']=";";

if(!isset($_POST['prenom']) || estVide($_POST['prenom']) )
    //echo "Vous avez mal renseigné votre prenom , cliquer  ICI ->> <a href='creerCompte.php'> CREER COMPTE </a> pour ressayer ";
    $_POST['prenom']=";";

if(!isset($_POST['login']) || estVide($_POST['login']) )
    echo "Vous avez mal renseigné votre login , cliquer  ICI ->> <a href='creerCompte.php'> CREER COMPTE </a> pour ressayer ";

if(!isset($_POST['sexe']) || estVide($_POST['sexe']) )
    $_POST['sexe']=";";
    
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

if(isset( $_POST['naissance']) )
{
  //---TODO : verifier qu'il est majeur
}


$monf = "../users/".trim($_POST['login']).'.txt';

if (! file_exists($monf) && ! emailExist( trim($_POST['email']) ))
{
  $myfile = fopen($monf, "w") or die("Unable to open file!");
  $myfile2 = fopen("../emails/".trim($_POST['email']).'.txt', "w") or die("Unable to open file!");
  


  fwrite($myfile2," ");
  fclose($myfile2);

  fwrite($myfile, trim( $_POST['email']) );      // email login mdp nom prenom sexe naissance ville poste adresse tel
  fwrite($myfile, " ");


  fwrite($myfile, trim( $_POST['login']) );
  fwrite($myfile, " ");

    fwrite($myfile, trim($_POST['pass']) );
    fwrite($myfile, " ");


    fwrite($myfile, trim( $_POST['nom']) );
    fwrite($myfile, " ");

    fwrite($myfile, trim( $_POST['prenom']) );
    fwrite($myfile, " ");

    fwrite($myfile, trim( $_POST['sexe']) );
    fwrite($myfile, " ");

    fwrite($myfile, trim( $_POST['naissance']) );
    fwrite($myfile, " ");

    fwrite($myfile, trim( $_POST['ville']) );
    fwrite($myfile, " ");

    fwrite($myfile, trim( $_POST['poste']) );
    fwrite($myfile, " ");

    fwrite($myfile, trim( $_POST['adresse']) );
    fwrite($myfile, " ");

    fwrite($myfile, trim( $_POST['tel']) );
    fwrite($myfile, " ");


    fwrite($myfile, " ".PHP_EOL);

  $_SESSION['login'] = trim($_POST['login']);
  $_SESSION['email'] = trim($_POST['email']);
  $_SESSION['pass'] = trim($_POST['pass']);
  $_SESSION['nom'] = trim($_POST['nom']);
  $_SESSION['prenom'] = trim($_POST['prenom']);
  $_SESSION['sexe'] = trim($_POST['sexe']);
  $_SESSION['naissance'] = trim($_POST['naissance']);
  $_SESSION['adresse'] = trim($_POST['adresse']);
  $_SESSION['poste'] = trim($_POST['poste']);
  $_SESSION['ville'] = trim($_POST['ville']);
  $_SESSION['tel'] = trim($_POST['tel']);

  fclose($myfile);

  header("Location: index.php");

}elseif ( emailExist( trim($_POST['email']) ) ) {

  //echo "Email deja existant !! try again ici -->   <a href='creerCompte.php'> CREER COMPTE </a>";

  echo "$debutHtmlEtStyle" ;
  echo "<h2 style='color:red'>Erreur Email deja existant</h2>";

  echo "<div class='center'>
              <p>reassyez ici   <a href='creerCompte.php'> CREER COMPTE </a>
              </p>
            </div>";

  echo "$finhtml";

}elseif(loginExist ( trim($_POST['login']) ) )
{

  echo "$debutHtmlEtStyle";

    echo "<h2 style='color:red'>Erreur Login deja existant</h2>";

    echo "<div class='center'>
            <p>reassyez ici   <a href='creerCompte.php'> CREER COMPTE </a>
            </p>
          </div>";

    echo "$finhtml";

}

  ?>
