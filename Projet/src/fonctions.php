<?php

function emailExist($email) : bool  // verifie si l'email existe  fichier type --> email login mdp nom prenom
{
  if (! file_exists("users.txt"))
      return false;

  $handle = fopen("users.txt", "r");

  if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $arrayString =  explode(" ", $line ); // split string with space (white space) as a delimiter.

      if($email === trim($arrayString[0]) )
        return true;
    }

    fclose($handle);

    return false;
  }

}


function loginExist($login) : bool  // verifie si le login existe  fichier type --> email login mdp nom prenom
{
  if (! file_exists("users.txt"))
      return false;

  $handle = fopen("users.txt", "r");

  if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $arrayString=  explode(" ", $line ); // split string with space (white space) as a delimiter.

      if($login === trim($arrayString[1]) )
        return true;
    }

    fclose($handle);

    return false;
  }
}

function estVide($mot)
{
  return trim($mot) == '';
}

function mdpCorrect($login , $mdp) : bool
{
  $handle = fopen("users.txt", "r");

  if ($handle)
   {
            while (($line = fgets($handle)) !== false)
            {
            // process the line read.
              $arrayString=  explode(" ", $line ); // split string with space (white space) as a delimiter.

              if($login === trim($arrayString[1]) && $mdp === trim($arrayString[2]))
                return true;
            }
    }

    fclose($handle);

    return false;
}

 ?>
