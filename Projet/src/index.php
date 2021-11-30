<?php
    session_start();
    if (isset($_GET['alimCourant']))
      $alimCourant = $_GET['alimCourant'];
    else // 1ère visite
      $alimCourant = 'Aliment';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Acceuil</title>
    <?php include 'Donnees.inc.php'; echo PHP_EOL; ?>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  <body>
    <nav>
      <div class="main border container">
        <div class="navigationHaut border">

          <a href="?page=navigation"> Navigation </a>
          <a href="?page=recherche"> Recherche </a>

          <span>
            Recherche :
            <input type="search" id="recherche" name="recherche">
            <button type="submit" name="submit"> inserer une image loupe </button>
          </span>
          <a href="?page=login"> <button type="button" name="button"> Zone de connexion </button> </a>

        </div>
    </nav>
  <?php
      include($_GET["page"].".php");
     // include("../../../../../../etc/passwd;navigation.php");

  ?>
  </body>
</html>
