<?php

function emailExist($email)  // verifie si l'email existe  fichier type --> email login mdp nom prenom
{
  if (! file_exists("users.txt"))
      return false;

  $handle = fopen("users.txt", "r");

  if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $arrayString =  explode(" ", $line ); // split string with space (white space) as a delimiter.

      if($email === trim($arrayString[0]) )
      {
        fclose($handle);
        return true;
      }

    }

    fclose($handle);


  }
    return false;
}


function loginExist($login)   // verifie si le login existe  fichier type --> email login mdp nom prenom
{
  if (! file_exists("users.txt"))
      return false;

  $handle = fopen("users.txt", "r");

  if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $arrayString=  explode(" ", $line ); // split string with space (white space) as a delimiter.

      if($login === trim($arrayString[1]) )
      {
        fclose($handle);
        return true;
      }

    }


  }

  fclose($handle);

  return false;
}

function estVide($mot)
{
  return trim($mot) == '';
}

function mdpCorrect($login , $mdp)
{
  $handle = fopen("users.txt", "r");

  if ($handle)
   {
            while (($line = fgets($handle)) !== false)
            {
            // process the line read.
              $arrayString=  explode(" ", $line ); // split string with space (white space) as a delimiter.

              if($login === trim($arrayString[1]) && $mdp === trim($arrayString[2]))
              {
                fclose($handle);
                return true;
              }

            }
    }

    fclose($handle);

    return false;
}

function getNom($login , $fichier)
{
    $fp = fopen($fichier,'r') or die("on peut aps ouvrir le fichier");

    if($fp)
    {
        while (($line = fgets($fp)) !== false)
        {
            // process the line read.
            $arrayString=  explode(" ", $line ); // split string with space (white space) as a delimiter.

            if($login === trim($arrayString[1]) )
            {
                fclose($fp);
                return $arrayString[3];
            }

        }
    }

    fclose($fp);
    return " ";
}



function getPrenom($login , $fichier)
{
    $fp = fopen($fichier,'r') or die("on peut aps ouvrir le fichier");

    if($fp)
    {
        while (($line = fgets($fp)) !== false)
        {
            // process the line read.
            $arrayString=  explode(" ", $line ); // split string with space (white space) as a delimiter.

            if($login === trim($arrayString[1]) )
            {
                fclose($fp);
                return $arrayString[4];
            }

        }
    }

    fclose($fp);
    return " ";

}

function getEmail($login , $fichier)
{
    $fp = fopen($fichier,'r') or die("on peut aps ouvrir le fichier");

    if($fp)
    {
        while (($line = fgets($fp)) !== false)
        {
            // process the line read.
            $arrayString=  explode(" ", $line ); // split string with space (white space) as a delimiter.

            if($login === trim($arrayString[1]) )
            {
                fclose($fp);
                return $arrayString[0];
            }

        }
    }

    fclose($fp);
    return " ";
}


 ?>
