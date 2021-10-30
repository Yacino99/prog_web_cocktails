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

          <?php
            // Ici on sélectionne les recettes qui correspondent à l'aliment courant :
            $res = array();
            foreach($Recettes as $numRecette => $Recette) {
              foreach($Recette['index'] as $num => $ingredient) {
                // ne pas oublier && !in_array($Recette, $res) car une recette peut avoir plusieurs ingredients
                // qui correspondent à l'alimCourant
                if ($alimCourant == 'Aliment' && !in_array($Recette, $res)) // alors on prend tout
                  array_push($res, $Recette);
                else { // sinon il faut sélectionner
                  if ($ingredient == $alimCourant && !in_array($Recette, $res)) { // on ajoute les recettes qui 
                                                                                  // contiennent l'alimCourant
                    array_push($res, $Recette);
                  }
                  else {
                    if (isset($Hierarchie[$ingredient]['super-categorie']))
                      $super = $Hierarchie[$ingredient]['super-categorie'][0];
                    while(isset($Hierarchie[$super]['super-categorie'])) { // on regarde dans toutes les super-categories
                                                                           // de l'ingredient qu'on regarde pour voir
                                                                           // si elle correspond à l'alimCourant
                      if ($super == $alimCourant && !in_array($Recette, $res))
                        array_push($res, $Recette);
                      $super = $Hierarchie[$super]['super-categorie'][0];
                    }
                  }
                }
              }
            }
          ?>

          <div class="row">
            <?php
              function traitementNomFichier($chaine) {
                $string = str_replace(' ', '_', $chaine);
                $search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'ñ');
			          $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'n');
                $string = str_replace($search, $replace, $string);
                $string = strtolower($string);
                $string = ucfirst($string);
                $string = preg_replace('/[^A-Za-z_]/', '', $string); // on enlève les caractères spéciaux
                $string = $string.".jpg";
                return $string;
              };

              // Ici on affiche les recettes qu'on vient de sélectionner :
              foreach($res as $Recette) {
                $nomFichier = traitementNomFichier($Recette['titre']);
                if (!file_exists("../Photos/".$nomFichier))
                  $nomFichier = "cocktail.png";
                echo "
                  <div class=\"boisson border col-auto\">
                  <h5>".$Recette['titre']."</h5>
                  <img src=\"une iamge de coeur a recup sur le net\" alt=\"coeur\">
                  <img src=\"../Photos/".$nomFichier."\" alt=\"boisson\" height=\"100\">
                ";
                echo "<ul>";
                foreach($Recette['index'] as $num => $ingredient) {
                  echo "<li>".$ingredient."</li>";
                }
                echo "</ul>";
                echo "</div>";  
              }
            ?>
          </div>

        </div>

      </div>

    </div>

  </body>
</html>
