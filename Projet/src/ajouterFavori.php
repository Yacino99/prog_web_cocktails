
<?php
    if (isset($_GET['login']) && isset($_GET['cocktail'])) {
        $login = $_GET['login'];
        $cocktail = $_GET['cocktail'];
        $nomFichier = "../favoris/".$login."_favoris.txt";
        //file_put_contents($nomFichier, $cocktail."\n", FILE_APPEND);
        //echo "coeur_plein"; // on prévient javascript de mettre le coeur plein

        // On analyse le fichier
        $file = fopen($nomFichier, 'r+');
        $present=false;
        if ($file) {
            while(!feof($file) && !$present) {
                $line = fgets($file);
                if (trim($line)===trim($cocktail)) {
                    file_put_contents($nomFichier, str_replace($line, "", file_get_contents($nomFichier))); // on supprime la ligne
                    $present = true;
                }
            }
        }
        fclose($file);

        if ($present) {
            echo "coeur"; // on prévient javascript de remettre le coeur vide
        }
        else {
            file_put_contents($nomFichier, $cocktail."\n", FILE_APPEND); // on ajoute un favori
            echo "coeur_plein"; // on prévient javascript de mettre le coeur plein
        }
    }
?>
