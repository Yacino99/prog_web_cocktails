<?php 

	function estReconnu($aliment, $Hierarchie ){
		$trouve = false ;
		foreach($Hierarchie as $alim => $cat ){
			if($alim != 'Aliment'){
				if ($cat['super-categorie'][0] == $aliment)
					$trouve = true ;
		
			}else {
				if ($aliment == 'Aliment' )
					$trouve= true ;
			}
				
		}
		return $trouve ;
	}
	
?>
