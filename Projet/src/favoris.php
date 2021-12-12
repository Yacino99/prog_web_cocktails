
<div class="body border row">
    <div class="Recettes favorites">
        <?php
            include 'Donnees.inc.php';
            echo "</a><h3>Liste des cocktails favoris</h3>";
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
            
            if (isset($_SESSION['login']))
                $login = $_SESSION['login'];
            else
                $login = 'user';
            $nomFichier = "../favoris/".$login."_favoris.txt";
            $file = fopen($nomFichier, 'r');

            if ($file) {
                while(!feof($file)) {
                    $line = fgets($file);
                    foreach($Recettes as $numRecette => $Recette) {
                        if (trim($Recette['titre'])==trim($line)) {
                            if (isset($_GET['recette'])) { // on affiche la recette détaillée sur laquelle on vient de cliquer
                                $nomCocktail = $_GET['recette'];
                                $fichier = traitementNomFichier($nomCocktail);
                                if (!file_exists("../Photos/".$fichier))
                                  $fichier = "cocktail.png";
                                include("recette.php");
                            }
                            else { // ici on affiche la liste des recettes favorites
                                $filename = traitementNomFichier($Recette['titre']);
                                if (!file_exists("../Photos/".$filename))
                                    $filename = "cocktail.png";
                                echo "
                                    <div class=\"boisson border col-auto\">
                                    <h5><a href=\"?recette=".$Recette['titre']."\">".$Recette['titre']."</a> <a><img class='heart' id=\"coeurr\" height=\"20\" width=\"20\" src=\"../Photos/coeur.png\"/></a></h5>
                                    <img src=\"../Photos/".$filename."\" alt=\"boisson\" height=\"100\">
                                ";
                                echo "<ul>";
                                foreach($Recette['index'] as $num => $ingredient) {
                                    echo "<li>".$ingredient."</li>";
                                }
                                echo "</ul>";
                                echo "</div>";
                            }
                        }
                    }
                }
            }
            fclose($file);

            ?>

        </div>
    </div>
</div>
