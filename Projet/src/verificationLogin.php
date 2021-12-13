<?php session_start();

$html = "
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
";



$titre= "<h2 style='color:red'>Erreur Login ou mot de passe incorrect</h2>";

$box="
<div class='center'>
  <p>reassyez ici   <a href='index.php'> RETOUR A LA PAGE PRINCIPALE </a>
  ou creer un compte ici -->   <a href='creerCompte.php'> CREER COMPTE </a>

  </p>
</div>

</body>
</html>


";


include_once 'fonctions.php';
/*
if (! file_exists("users.txt") )
{
    echo "$html";
    echo "$titre";
    echo "$box";

}
*/

if (! loginExist(trim($_POST['login']))) {

    echo "$html";
    echo "$titre";
    echo "$box";

}
elseif (mdpCorrect(trim($_POST['login']) , trim($_POST['pass']))) {

  $handle = fopen("../users/".$_POST['login'].".txt", "r") or die("cannot open file ");

  if ($handle)
  {

      $line = fgets($handle); //// email login mdp nom prenom sexe naissance ville poste adresse tel
      // process the line read.
      $tabUser = explode("%", $line ); // split string with space (white space) as a delimiter.

      
      $_SESSION['login'] = trim($tabUser[1]);
      $_SESSION['email'] = trim($tabUser[0]);
      $_SESSION['pass'] = trim($tabUser[2]);
      $_SESSION['nom'] = trim($tabUser[3]);
      $_SESSION['prenom'] = trim($tabUser[4]);
      $_SESSION['sexe'] = trim($tabUser[5]);
      $_SESSION['naissance'] = trim($tabUser[6]);
      $_SESSION['ville'] = trim($tabUser[7]);
      $_SESSION['poste'] = trim($tabUser[8]);
      $_SESSION['adresse'] = trim($tabUser[9]);
      $_SESSION['tel'] = trim($tabUser[10]);

      // on concatene user_favoris et login_favoris dans login_favoris à la connexion
      file_put_contents("../favoris/".$_SESSION['login']."_favoris.txt", file_get_contents("../favoris/user_favoris.txt"), FILE_APPEND);
  }

  fclose($handle);

  header("Location: index.php");

}
else {

    echo "$html";
    echo "<h2 style='color:red'>Erreur :  mot de passe incorrect</h2>" ;


  echo "<div class='center'>
          <p>reassyez ici   <a href='Login.php'> PAGE DE LOGIN </a>
          ou creer un compte ici -->   <a href='creerCompte.php'> CREER COMPTE </a>

          </p>
        </div>
        
</body>
</html>
        ";

}


 ?>

