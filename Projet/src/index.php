<?php 
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

    <div class="main border container">
      <div class="navigationHaut border">

        <button type="button" id="navigation" name="navigation"> Navigation </button>
        <button type="button" id="recettes" name="recettes"> Recettes </button>

        <span>
          Recherche :
          <input type="search" id="recherche" name="recherche">
          <button type="submit" name="submit"> inserer une image loupe </button>
        </span>
         <a href="login.php"> <button type="button" name="button"> Zone de connexion </button> </a>

      </div>


      <div class="body border row">

        <div class="navigationGauche border col-auto">

          <h3>Aligment Courant</h3>
          <span>
            <?php
              $chemin = array();
      
              if (isset($Hierarchie[$alimCourant]['super-categorie'])) { // on vérifie que la super categorie existe
                                                                        // càd alimCourant != Aliment
                array_push($chemin, $alimCourant);
                $super = $Hierarchie[$alimCourant]['super-categorie'];
                while(isset($Hierarchie[$super[0]]['super-categorie'])) {
                  array_push($chemin, $super[0]);
                  $super = $Hierarchie[$super[0]]['super-categorie'];
                } // $super n'a plus de super catégorie donc c'est aliment
              }
              // on sait qu'il ne nous manque plus que Aliment donc on peut le traiter tout de suite
              // ce qui aidera pour l'affichage des /
              echo "<a href=\"".$_SERVER["PHP_SELF"]."?alimCourant=Aliment\">Aliment</a>";

              $chemin = array_reverse($chemin); // on inverse le reste du chemin pour avoir alimCourant en dernier
              foreach($chemin as $categorie) {
                echo "/";
                echo "<a href=\"".$_SERVER["PHP_SELF"]."?alimCourant=".$categorie."\">".$categorie."</a>";
              }
            ?>
          </span>

          <h4>Sous-Categories</h4>
          <ul>
            <?php
              if (isset($Hierarchie[$alimCourant]['sous-categorie'])) {
                foreach($Hierarchie[$alimCourant]['sous-categorie'] as $sousCategorie) {
                  echo "<li> <a href=\"".$_SERVER["PHP_SELF"]."?alimCourant=".$sousCategorie."\">".$sousCategorie."</a> </li>";
                }
              }
            ?>
          </ul>

        </div>

        <div class="listeCock col">

          <h4>Liste des Cocktails</h4>

          <div class="row">
                <div class="boisson border col-auto">
                  <h5>bloody Mary</h5>

                  <img src="une iamge de coeur a recup sur le net" alt="coeur">
                  <img src="image de la boisson a recup dans les photos" alt="boisson">

                  <ul>
                    <li>vodka</li>
                    <li>jus de citron</li>
                    <li>Jus d'orange</li>
                  </ul>

                </div>


                <div class="boisson border col-auto">
                  <h5>bloody Mary</h5>

                  <img src="une iamge de coeur a recup sur le net" alt="coeur">
                  <img src="image de la boisson a recup dans les photos" alt="boisson">

                  <ul>
                    <li>vodka</li>
                    <li>jus de citron</li>
                    <li>Jus d'orange</li>
                  </ul>

            </div>
          </div>


        </div>

      </div>

    </div>

  </body>
</html>
