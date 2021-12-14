<?php
   // Vérifier si le formulaire est soumis 
   if ( isset( $_POST['submit'] ) ) {
     $recherche = $_POST['recherche']."."; 
     //echo 'Recherche : '.$recherche; 
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
		$j = 0;
		$alimNonSouhaites = array();
		$alimSouhaites = array();
		while( $i<strlen($recherche) ){
			if ($recherche[$i] == " " ){
				$i++;
			}
			 if($recherche[$i] == '-'){
				$i++;
				if ($recherche[$i] == '"'){
					$i++;
					$alimNonSouhaite = "";
					while ($recherche[$i] != '"'){
						$alimNonSouhaite = $alimNonSouhaite.$recherche[$i];
						$i++;
					}
					$alimNonSouhaites[$k] = $alimNonSouhaite;
					$k++;
					
				}else {
					$alimNonSouhaite = "";
					while ($recherche[$i] != ' ' and $recherche[$i] != "."){
						$alimNonSouhaite = $alimNonSouhaite.$recherche[$i];
						$i++;
					}
					$alimNonSouhaites[$k] = $alimNonSouhaite;
					$k++;
				}
					
			}else if($recherche[$i] == "+"  ){
				$i++;
			
				if ($recherche[$i] == '"'){
					$i++;
					$alimSouhaite = "";
					while ($recherche[$i] != '"'){
						$alimSouhaite = $alimSouhaite.$recherche[$i];
						$i++;
					}
					$alimSouhaites[$j] = $alimSouhaite;
					$j++;
				}else {
					$alimSouhaite = "";
					while ($recherche[$i] != ' ' and $recherche[$i] != "."){
						$alimSouhaite = $alimSouhaite.$recherche[$i];
						$i++;
					}
					$alimSouhaites[$j] = $alimSouhaite;
					$j++;
				}
			
				
			}else {
					if ($recherche[$i] == '"'){
					$i++;
					$alimSouhaite = "";
					while ($recherche[$i] != '"'){
						$alimSouhaite = $alimSouhaite.$recherche[$i];
						$i++;
					}
					$alimSouhaites[$j] = $alimSouhaite;
					$j++;
				}else {
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
?>