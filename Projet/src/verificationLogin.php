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
  <p>reassyez ici   <a href='Login.php'> PAGE DE LOGIN </a>
  ou creer un compte ici -->   <a href='creerCompte.php'> CREER COMPTE </a>

  </p>
</div>

</body>
</html>


";


include_once 'fonctions.php';

if (! file_exists("users.txt") )
{
    echo "$html";
    echo "$titre";
    echo "$box";

}
elseif (! loginExist($_POST['login'])) {

    echo "$html";
    echo "$titre";
    echo "$box";

}
elseif (mdpCorrect($_POST['login'] , $_POST['pass'])) {

  $_SESSION['usr'] = $_POST['login'];
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
