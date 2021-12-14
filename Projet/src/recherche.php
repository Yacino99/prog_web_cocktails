<?php
	include "estReconnu.php";
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
	$alimNonReconnu = array();
	$alimNonSouhaites = array();
	$alimSouhaites = array();
	if ( $j%2 )
		echo "Problème de syntaxe dans votre requête : nombre impair de double-quotes \n </br>";
	else {
		$i =0;
		$k =0;
		$j= 0;
		$t = 0;
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
					if (estReconnu($alimNonSouhaite,$Hierarchie)){
						$alimNonSouhaites[$k] = $alimNonSouhaite;
						$k++;
					}else {
						$alimNonReconnu[$t] =$alimNonSouhaite;
						$t++;
					}
				}else {//cas -....
					$alimNonSouhaite = "";
					while ($recherche[$i] != ' ' and $recherche[$i] != "."){
						$alimNonSouhaite = $alimNonSouhaite.$recherche[$i];
						$i++;
					}
					if (estReconnu($alimNonSouhaite, $Hierarchie)){
						$alimNonSouhaites[$k] = $alimNonSouhaite;
						$k++;
					}else {
						$alimNonReconnu[$t] =$alimNonSouhaite;
						$t++;
					}
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
					if (estReconnu($alimSouhaite,$Hierarchie)){
						$alimSouhaites[$j] = $alimSouhaite;
						$j++;
					}else {
						$alimNonReconnu[$t] =$alimSouhaite;
						$t++;
					}
					
				}else {// cas +....
					$alimSouhaite = "";
					while ($recherche[$i] != ' ' and  $recherche[$i] != "."){
						$alimSouhaite = $alimSouhaite.$recherche[$i];
						$i++;
					}
					if (estReconnu($alimSouhaite,$Hierarchie)){
						$alimSouhaites[$j] = $alimSouhaite;
						$j++;
					}else {
						$alimNonReconnu[$t] =$alimSouhaite;
						$t++;
					}
				}
			
				
			}else { // cas 
				if ($recherche[$i] == '"'){// cas "....."
					$i++;
					$alimSouhaite = "";
					while ($recherche[$i] != '"'){
						$alimSouhaite = $alimSouhaite.$recherche[$i];
						$i++;
					}
					if (estReconnu($alimSouhaite,$Hierarchie)){
						$alimSouhaites[$j] = $alimSouhaite;
						$j++;
					}else {
						$alimNonReconnu[$t] =$alimSouhaite;
						$t++;
					}
				}else if ($recherche[$i] != '"' and   $recherche[$i] != "."){ //cas ......
					$alimSouhaite = "";
					while ($recherche[$i] != ' ' and $recherche[$i] != "."){
						$alimSouhaite = $alimSouhaite.$recherche[$i];
						$i++;
					}
					if (estReconnu($alimSouhaite,$Hierarchie)){
						$alimSouhaites[$j] = $alimSouhaite;
						$j++;
					}else {
						$alimNonReconnu[$t] =$alimSouhaite;
						$t++;
					}
				}
			}
			
			$i++;
		 }
		 if (sizeof($alimSouhaites)>0){
			 echo "liste des aliments souhaites :";
			 foreach($alimSouhaites as $alim ){
				echo $alim .",";
			 }
			 echo "\n </br>";
		 }
		 if (sizeof($alimNonSouhaites)>0){
			echo "liste des aliments non souhaites :";
			 foreach($alimNonSouhaites as $alim ){
				echo $alim .",";
			 }
			  echo "\n </br>";
		 }
		 if (sizeof($alimNonReconnu)>0){
			 echo "Éléments non reconnus dans la requête :";
			 foreach($alimNonReconnu as $alim ){
				 echo $alim .",";
			 }
			  echo "\n </br>";
				
		 }
		 
	}


	// --------------------- CALCUL DU SCORE POUR CHAQUE RECETTE ---------------------
	include("Donnees.inc.php");
	// On sélectionne les recettes qui correspondent à $alimSouhaites et $alimNonSouhaites
    $res = array();
	$score = array(); // tableau des scores de chaque de recette initialisé à 100

	/* Si besoin d'un tableau de booléens : ------------------------------------------------------------------------
	// 2 tableaux pour vérifiés si chaque alim de boolAlimSouhaites et alimNonSouhaites a été trouvé ou non
	$boolAlimSouhaites = array();
	$boolAlimNonSouhaites = array();
	foreach($alimSouhaites as $alim) {
		boolAlimSouhaites[$alim] = false;
	}
	foreach($alimNonSouhaites as $alim) {
		boolAlimNonSouhaites[$alim] = false;
	}
	function toutVrai($tab) {
		// renvoie true ssi toutes les valeurs d'un tab de booléens sont à true sinon false
		foreach($tab as $value) {
			if ($value == false) return false;
		}
		return true;
	}
	----------------------------------------------------------------------------------------------------------- */
	if (sizeof($alimNonSouhaites)==0 && sizeof($alimSouhaites)== 0)
		echo "Problème dans votre requête : recherche impossible \n </br>";
	else {

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
					if ( sizeof($alimNonSouhaites) != 0 && !in_array($parcoursIngredient, $alimNonSouhaites)) { // toutes les categories superieures de l'ingredient sont absentes de alimNonSouhaites
						$nbAlimNonSouhaiteAbsent++;
						$trouve = true;
					}
					
					$parcoursIngredient = $Hierarchie[$parcoursIngredient]["super-categorie"][0];
				}
				if ($trouve )
					break;
				// Pour aliment
				if (in_array($parcoursIngredient, $alimSouhaites)) { // une categorie superieure de l'ingredient est dans les alimSouhaites
					$nbAlimSouhaitePresent++;
				}
				if ( sizeof($alimNonSouhaites) != 0  && !in_array($parcoursIngredient, $alimNonSouhaites)) { // toutes les categories superieures de l'ingredient sont absentes de alimNonSouhaites
					$nbAlimNonSouhaiteAbsent++;
				}
				
			}

			/* On dispose de
			- $nbAlimSouhaitePresent
			- $nbAlimSouhaiteAbsent
			- $nbAlimNonSouhaiteAbsent
			- $nbAlimNonSouhaitePresent
			pour calculer $score[$Recette]
			*/

			$nbCriteres = sizeof($alimSouhaites) + sizeof($alimNonSouhaites);
			$score[$numRecette] = 100*( ($nbAlimSouhaitePresent + $nbAlimNonSouhaiteAbsent)/$nbCriteres );

			//echo "Recette : ".$Recette['titre'].", nbAlimSouhaitePresent : ".$nbAlimSouhaitePresent.", nbAlimNonSouhaiteAbsent : ".$nbAlimNonSouhaiteAbsent."</br>";

		}

		include("traitementNomFichier.php"); // accès à la fonction traitementNomFichier($chaine)
		arsort($score); // trie par ordre decroissant en gardant le lien index valeur
		foreach($score as $num => $pourcent) {
			if ($pourcent > 0) {
				$titreRecette = $Recettes[$num]['titre'];
				$nomFichier = traitementNomFichier($titreRecette);
				if (!file_exists("../Photos/".$nomFichier))
					$nomFichier = "cocktail.png";
				echo "
					<div class=\"boisson border col-auto\">
					<h5><a href=\"?recette=".$titreRecette."\">".$titreRecette."</a> <a><img class='heart' id=\"".$titreRecette."\" height=\"20\" width=\"20\" src=\"../Photos/coeur.png\"/></a></h5>
					<img src=\"../Photos/".$nomFichier."\" alt=\"boisson\" height=\"100\">
					<p>Score = ".$pourcent."</p>
				";
				echo "<ul>";
				foreach($Recettes[$num]['index'] as $numIngr => $ingredient) {
				  echo "<li>".$ingredient."</li>";
				}
				echo "</ul>";
				echo "</div>"; 
			}
		}
	}
?>

