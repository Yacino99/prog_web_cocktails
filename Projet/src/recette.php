<div class="body border row">

    <div class="Affichage détaillé">

        <?php
            echo "<h4>".$nomCocktail."</h4>";
        ?>

        <div class="row">
            <?php
                foreach($Recettes as $num => $Recette) {
                    if ($Recette['titre']==$nomCocktail) {
                        echo "
                        <div class=\"boisson border col-auto\">
                        <h5>".$nomCocktail." <a><img class='heart' id=\"coeur\" height=\"20\" width=\"20\" src=\"../Photos/coeur.png\"/></a></h5>
                        <img src=\"../Photos/".$fichier."\" alt=\"boisson\" height=\"100\">
                        <p><strong>Ingrédients : </strong>".$Recette['ingredients']."</p>
                        <p><strong>Recette : </strong>".$Recette['preparation']."</p>
                        ";
                        echo "<ul>";
                        /*
                        foreach($Recette['index'] as $num => $ingredient) {
                            echo "<li>".$ingredient."</li>";
                        }
                        echo "</ul>";
                        echo "</div>";
                        */
                    }
                }
            ?>
        </div>

    </div>
</div>
