<?php

function emailExist($lemail)  // verifie si l'email existe  fichier type -->  email%login%motDePasse%nom%prenom%sexe%naissance%ville%poste%adresse%tel
{
  if (! file_exists('../emails/'.$lemail.'.txt'))
      return false;
  
  else return true;
    
}


function loginExist($login)   // verifie si le login existe  fichier type -->  email%login%motDePasse%nom%prenom%sexe%naissance%ville%poste%adresse%tel
{
  if (! file_exists('../users/'.$login.'.txt'))
      return false;
  
  else return true;

}

function estVide($mot)
{
  return trim($mot) == ''; // verifie si une chaine de caractere est vide
}

// fonction qui verifie si le mot de passe est correct par rapport au login renvoie true si oui sinon false
function mdpCorrect($login , $mdp) 
{
  $handle = fopen("../users/".$login.".txt", "r");

  if ($handle)
   {

      $line = fgets($handle);  //format -> email%login%motDePasse%nom%prenom%sexe%naissance%ville%poste%adresse%tel
      // process the line read.
      $arrayString = explode("%", $line ); // split string with space (white space) as a delimiter.

      //on verifie si le login est egal au 2eme champs du fichier (login)
      // et si le mot de passe est egale au 3eme champ du fichier 

      if($login === trim($arrayString[1]) && $mdp === trim($arrayString[2])) 
      {
        fclose($handle);
        return true;
      }
    }



    fclose($handle);

    return false;
}


 ?>
