<?php 

	function estReconnu($aliment, $Hierarchie ){
		if($aliment=='Aliment')
			return true ;
		$trouve = false ;
		foreach($Hierarchie as $alim => $cat ){
			if (isset($cat['sous-categorie'])){
				foreach($cat['sous-categorie'] as $sousCat){
					
					if ($sousCat == $aliment )
						$trouve = true ;
				}
			}	
		
		}
		return $trouve ;
	}
	
?>
