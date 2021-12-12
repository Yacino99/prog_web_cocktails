
<?php
    include 'Donnees.inc.php';
    if (isset($_GET['login']) && isset($_GET['cocktail'])) {
        $login = $_GET['login'];
        $cocktail = $_GET['cocktail'];
        $nomFichier = "../favoris/".$login."_favoris.txt";
        $file = fopen($nomFichier, 'r');
        $present = false;
        while(!feof($file)) {
            $line = fgets($file);
            if (trim($line) == trim($cocktail)) {
                $present = true;
            }
        }
        fclose($file);
        if ($present) echo "coeur_plein";
        else echo "coeur";
    }
?>
