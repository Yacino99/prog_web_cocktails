<?php

function emailExist($lemail)  // verifie si l'email existe  fichier type --> email login mdp nom prenom
{
  if (! file_exists('../emails/'.$lemail.'.txt'))
      return false;
  
  else return true;
    
}


function loginExist($login)   // verifie si le login existe  fichier type --> email login mdp nom prenom
{
  if (! file_exists('../users/'.$login.'.txt'))
      return false;
  
  else return true;

}

function estVide($mot)
{
  return trim($mot) == '';
}

function mdpCorrect($login , $mdp)
{
  $handle = fopen("../users/".$login.".txt", "r");

  if ($handle)
   {

      $line = fgets($handle); //// email login mdp nom prenom sexe naissance ville poste adresse tel
      // process the line read.
      $arrayString = explode(" ", $line ); // split string with space (white space) as a delimiter.

      if($login === trim($arrayString[1]) && $mdp === trim($arrayString[2]))
      {
        fclose($handle);
        return true;
      }
    }

    fclose($handle);

    return false;
}

function getNom($login , $fichier)
{
    
    return " ";
}



function getPrenom($login , $fichier)
{
   
    return " ";

}

function getEmail($login , $fichier)
{
    
    return " ";
}


 ?>
