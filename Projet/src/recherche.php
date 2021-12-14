<?php
	// Vérifier si le formulaire est soumis 
	if ( isset( $_POST['submit'] ) ) {
		$recherche = $_POST['recherche']."."; 
		//echo 'Recherche : '.$recherche; 
		$_SESSION['recherche'] = $recherche;
	}
	else {
		$recherche = $_SESSION['recherche'];
	}
	$j = 0;
	for($i = 0 ; $i<strlen($recherche) ; $i++){// test si le nombre de doubles-quotes est impair
		if ($recherche[$i] == '"'){
			$j++;
		}
	}
	  
	if ( $j%2 )
		echo "Problème de syntaxe dans votre requête : nombre impair de double-quotes";
	else {
		$i =0;
		$k =0;
		$t= 0;
		$alimNonSouhaites = array();
		$alimSouhaites = array();
		while( $i<strlen($recherche) ){
			if ($recherche[$i] == " " ){
				$i++;
			}
			 if($recherche[$i] == '-'){// cas - 
				$i++;
				if ($recherche[$i] == '"'){ //cas -"...."
					$i++;
					$alimNonSouhaite = "";
					while ($recherche[$i] != '"'){
						$alimNonSouhaite = $alimNonSouhaite.$recherche[$i];
						$i++;
					}
					$alimNonSouhaites[$k] = $alimNonSouhaite;
					$k++;
					
				}else {//cas -....
					$alimNonSouhaite = "";
					while ($recherche[$i] != ' ' and $recherche[$i] != "."){
						$alimNonSouhaite = $alimNonSouhaite.$recherche[$i];
						$i++;
					}
					$alimNonSouhaites[$k] = $alimNonSouhaite;
					$k++;
				}
					
			}else if($recherche[$i] == "+"  ){// cas +
				$i++;
			
				if ($recherche[$i] == '"'){//cas +"...."
					$i++;
					$alimSouhaite = "";
					while ($recherche[$i] != '"'){
						$alimSouhaite = $alimSouhaite.$recherche[$i];
						$i++;
					}
					$alimSouhaites[$j] = $alimSouhaite;
					$j++;
				}else {// cas +....
					$alimSouhaite = "";
					while ($recherche[$i] != ' ' and  $recherche[$i] != "."){
						$alimSouhaite = $alimSouhaite.$recherche[$i];
						$i++;
					}
					$alimSouhaites[$j] = $alimSouhaite;
					$j++;
				}
			
				
			}else { // cas 
				if ($recherche[$i] == '"'){
					$i++;
					$alimSouhaite = "";
					while ($recherche[$i] != '"'){
						$alimSouhaite = $alimSouhaite.$recherche[$i];
						$i++;
					}
					$alimSouhaites[$j] = $alimSouhaite;
					$j++;
				}else if ($recherche[$i] != '"' and   $recherche[$i] != "."){
					$alimSouhaite = "";
					while ($recherche[$i] != ' ' and $recherche[$i] != "."){
						$alimSouhaite = $alimSouhaite.$recherche[$i];
						$i++;
					}
					$alimSouhaites[$j] = $alimSouhaite;
					$j++;
				}
			}
			
			$i++;
		 }
		 foreach($alimNonSouhaites as $alim ){
			 
			echo "alimNonSouhaite: ".$alim."\n </br>";
			
		 }
		
		 foreach($alimSouhaites as $alim ){
			echo"alimSouhaite: ".$alim. "\n </br>";
		 }
	}

	// --------------------- CALCUL DU SCORE POUR CHAQUE RECETTE ---------------------
	include("Donnees.inc.php");
	// On sélectionne les recettes qui correspondent à $alimSouhaites et $alimNonSouhaites
    $res = array();
	$score = array(); // tableau des scores de chaque de recette initialisé à 100
    foreach($Recettes as $numRecette => $Recette) {
		$nbAlimSouhaitePresent = 0;
		$nbAlimSouhaiteAbsent = 0;
		$nbAlimNonSouhaiteAbsent = 0;
		$nbAlimNonSouhaitePresent = 0;
		foreach($Recette['index'] as $num => $ingredient) { // les ingredients PRESENT
			$trouve = false;
			$parcoursIngredient = $ingredient;
			while($parcoursIngredient != "Aliment" && !$trouve) { // on cherche dans les super-categorie
				if (in_array($parcoursIngredient, $alimSouhaites)) { // une categorie superieure de l'ingredient est dans les alimSouhaites
					$nbAlimSouhaitePresent++;
					$trouve = true;
				}
				if (in_array($parcoursIngredient, $alimNonSouhaites)) { // une categorie superieure de l'ingredient est dans les alimNonSouhaites
					$nbAlimNonSouhaitePresent++;
					$trouve = true;
				}
				if (in_array($parcoursIngredient, $alimSouhaites)) { // toutes les categories superieures de l'ingredient sont absentes de alimSouhaites
					$nbAlimSouhaiteAbsent++;
					$trouve = true;
				}
				if (in_array($parcoursIngredient, $alimNonSouhaites)) { // toutes les categories superieures de l'ingredient sont absentes de alimNonSouhaites
					$nbAlimNonSouhaiteAbsent++;
					$trouve = true;
				}
				$parcoursIngredient = $Hierarchie[$parcoursIngredient]["super-categorie"][0];
			}
			// Pour aliment
			if (in_array($parcoursIngredient, $alimSouhaites)) { // une categorie superieure de l'ingredient est dans les alimSouhaites
				$nbAlimSouhaitePresent++;
			}
			if (in_array($parcoursIngredient, $alimNonSouhaites)) { // une categorie superieure de l'ingredient est dans les alimNonSouhaites
				$nbAlimNonSouhaitePresent++;
			}
			if (in_array($parcoursIngredient, $alimSouhaites)) { // toutes les categories superieures de l'ingredient sont absentes de alimSouhaites
				$nbAlimSouhaiteAbsent++;
			}
			if (in_array($parcoursIngredient, $alimNonSouhaites)) { // toutes les categories superieures de l'ingredient sont absentes de alimNonSouhaites
				$nbAlimNonSouhaiteAbsent++;
			}
		}

		/* On a
		$nbAlimSouhaitePresent
		$nbAlimSouhaiteAbsent
		$nbAlimNonSouhaiteAbsent
		$nbAlimNonSouhaitePresent
		pour calculer $score[$Recette]
		*/

		$nbCriteres = sizeof($alimSouhaites) + sizeof($alimNonSouhaites);
		$score[$Recette['titre']] = 100*( ($nbAlimSouhaitePresent + $nbAlimNonSouhaiteAbsent)/$nbCriteres );

		echo "Recette : ".$Recette['titre'].", nbAlimSouhaitePresent : ".$nbAlimSouhaitePresent.", nbAlimNonSouhaiteAbsent : ".$nbAlimNonSouhaiteAbsent."</br>";

    }

	include("traitementNomFichier.php"); // accès à la fonction traitementNomFichier($chaine)
	arsort($score); // trie par ordre decroissant en gardant le lien index valeur
	foreach($score as $titreRecette => $pourcent) {
		if ($pourcent > 0) {
			//echo $titreRecette;
			$nomFichier = traitementNomFichier($titreRecette);
			if (!file_exists("../Photos/".$nomFichier))
				$nomFichier = "cocktail.png";
			echo "
				<div class=\"boisson border col-auto\">
				<h5><a href=\"?recette=".$titreRecette."\">".$titreRecette."</a> <a><img class='heart' id=\"".$titreRecette."\" height=\"20\" width=\"20\" src=\"../Photos/coeur.png\"/></a></h5>
				<img src=\"../Photos/".$nomFichier."\" alt=\"boisson\" height=\"100\">
				<p>".$pourcent."</p>
			";
		}
	}
?>
