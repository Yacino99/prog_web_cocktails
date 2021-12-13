<?php
   // Vérifier si le formulaire est soumis 
   if ( isset( $_POST['submit'] ) ) {
     $recherche = $_POST['recherche']; 
     echo 'Recherche : '.$recherche; 
  }
?>
