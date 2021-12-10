<?php
    //session_start(); déjà fait dans index.php
    if (isset($_GET['alimCourant']))
      $alimCourant = $_GET['alimCourant'];
    else // 1ère visite
      $alimCourant = 'Aliment';
?>

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

      // ----------------- AFFICHAGE : -----------------
      if (isset($_GET['recette'])) { // on affiche la recette détaillée sur laquelle on vient de cliquer
          $nomCocktail = $_GET['recette'];
          $fichier = traitementNomFichier($nomCocktail);
          if (!file_exists("../Photos/".$fichier))
            $fichier = "cocktail.png";
          include("recette.php");
      }
      else { // ici on affiche les recettes sélectionnée à l'aide du menu :
        foreach($res as $Recette) {
          $nomFichier = traitementNomFichier($Recette['titre']);
          if (!file_exists("../Photos/".$nomFichier))
            $nomFichier = "cocktail.png";
          echo "
            <div class=\"boisson border col-auto\">
            <h5><a href=\"?recette=".$Recette['titre']."\">".$Recette['titre']."</a> <a><img id=\"coeur\" height=\"20\" width=\"20\" src=\"../Photos/coeur.png\"/></a></h5>
            <img src=\"../Photos/".$nomFichier."\" alt=\"boisson\" height=\"100\">
          ";
          echo "<ul>";
          foreach($Recette['index'] as $num => $ingredient) {
            echo "<li>".$ingredient."</li>";
          }
          echo "</ul>";
          echo "</div>";  
        }
      }

    ?>
  </div>
</div>
