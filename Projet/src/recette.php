<div class="body border row">

    <div class="Affichage détaillé">

        <?php
            $precedent = $_SERVER["HTTP_REFERER"]; 
            echo "<a href=".$precedent."><button><img height=\"20\" width=\"20\" src=\"../Photos/flecheGauche.png\"></button></a><h4>Recette détaillée</h4>";
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
                    }
                }
            ?>
        </div>

    </div>
</div>
