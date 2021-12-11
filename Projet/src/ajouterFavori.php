
<?php
    if (isset($_GET['login']) && isset($_GET['cocktail'])) {
        $login = $_GET['login'];
        $cocktail = $_GET['cocktail'];
        file_put_contents("../favoris/".$login."_favoris.txt", $cocktail."\n", FILE_APPEND);
        echo "coeur_plein"; // on prévient javascript de mettre le coeur plein

        /*
        $file = fopen(../favoris/".$login."_favoris.txt);
        $line = fgets($file);
        $present=false;
        while(isset($line) && !$present) {
            if (line==$cocktail) {
                unset($line); // on supprime la ligne
                $present = true;
            }
        }
        if ($present) {
            echo "coeur"; // on prévient javascript de remettre le coeur vide
        }
        else {
            file_put_contents("../favoris/".$login."_favoris.txt", $cocktail."\n", FILE_APPEND);
            echo "coeur_plein"; // on prévient javascript de mettre le coeur plein
        }
        */
    }
?>
