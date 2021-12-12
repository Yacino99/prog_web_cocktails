<?php

session_start();


echo $_SESSION['login'];

$fichierUser = "../users/".trim($_SESSION['login']).'.txt';
$fichierEmail =  "../emails/".trim($_SESSION['email']).'.txt';
$fichierFavoris = "../favoris/user_favoris.txt";

if (!unlink($fichierFavoris)) { 
    echo "fichier Favoris ne peut etre supprimé"; 
}


elseif (!unlink($fichierUser)) { 
    echo "fichierUser ne peut etre supprimé"; 
}

elseif (!unlink($fichierEmail)) { 
    echo "fichierEmail ne peut etre supprimé"; 
}

else{

    //--suppression de la session 
    
   
    session_destroy();


    header("Location: index.php");
} 

?>