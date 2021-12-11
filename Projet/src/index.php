<?php
    if (session_id() == '') file_put_contents("../favoris/user_favoris.txt", "", FILE_APPEND);
    session_start();
    if (isset($_GET['alimCourant']))
      $alimCourant = $_GET['alimCourant'];
    else // 1ère visite
      $alimCourant = 'Aliment';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Acceuil</title>
    <?php include 'Donnees.inc.php'; echo PHP_EOL; ?>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>

<body>
<div class="main border container">
  <div class="navigationHaut border">

    <a href="?page=navigation"><button>Navigation</button></a>
    <a href="?page=favoris"><button>Recettes <img height="20" width="20" src="../Photos/coeur_plein.png"/></button></a>
  <!--  <a href="?page=recherche"> Recherche </a>  -->

    <span>
      Recherche :
      <input type="search" id="recherche" name="recherche">
      <button type="submit" name="submit"><img height="20" width="20" src="../Photos/search.png"/></button>
    </span>

    <?php
    if ( isset( $_SESSION['login']) )
    {
      echo $_SESSION['login'];
      echo '<a href="?page=profil"><button type="button" name="profil"> Profil </button></a>'; // TODO
      echo '<button type="button" name="deconnexion"> deconnexion </button>'; // TODO
    }
    else
      echo '   
      <span>
        <form action="verificationLogin.php" method="post">
        Login :
        <input type="text"  name="login" required>
        Mot de Passe : 
        <input type="password" name="pass" id="pass" required>
        <input type="submit" value="Se connecter !">
        </form>
      </span>
    
      <a href="?page=creerCompte"> <button type="button" name="button"> Inscription </button> </a>
      '
    ?>
</div>

<div class="body border row">
  <div class="navigationGauche border col-auto">

      <h3>Aligment Courant</h3>

          <span>
            <?php
              $chemin = array();
      
              if (isset($Hierarchie[$alimCourant]['super-categorie'])) { // on vérifie que la super categorie existe
                                                                        // càd alimCourant != Aliment
                array_push($chemin, $alimCourant);
                $super = $Hierarchie[$alimCourant]['super-categorie'];
                while(isset($Hierarchie[$super[0]]['super-categorie'])) {
                  array_push($chemin, $super[0]);
                  $super = $Hierarchie[$super[0]]['super-categorie'];
                } // $super n'a plus de super catégorie donc c'est aliment
              }
              // on sait qu'il ne nous manque plus que Aliment donc on peut le traiter tout de suite
              // ce qui aidera pour l'affichage des /
              echo "<a href=\"".$_SERVER["PHP_SELF"]."?alimCourant=Aliment\">Aliment</a>";

              $chemin = array_reverse($chemin); // on inverse le reste du chemin pour avoir alimCourant en dernier
              foreach($chemin as $categorie) {
                echo "/";
                echo "<a href=\"".$_SERVER["PHP_SELF"]."?alimCourant=".$categorie."\">".$categorie."</a>";
              }
            ?>
          </span>

          <h4>Sous-Categories</h4>
          <ul>
            <?php
              if (isset($Hierarchie[$alimCourant]['sous-categorie'])) {
                foreach($Hierarchie[$alimCourant]['sous-categorie'] as $sousCategorie) {
                  echo "<li> <a href=\"".$_SERVER["PHP_SELF"]."?alimCourant=".$sousCategorie."\">".$sousCategorie."</a> </li>";
                }
              }
            ?>
          </ul>

        </div>

        <div class="listeCock col">
          <main>
            <?php
                if (isset($_GET['page']))
                  include($_GET["page"].".php");
                else
                  include("navigation.php");
                // include("../../../../../../etc/passwd;navigation.php");
            ?>
          </main>
        </div>
  </div>
</div>

</body>
</html>

<script type="text/javascript">
  favori = 0;
  let heart = document.querySelectorAll(".heart");
  for (let i = 0; i < heart.length; i++)
  {
      heart[i].addEventListener("mouseover", function() {
        //if(favori % 2 != 0)
        heart[i].src="../Photos/coeur_plein.png";
     });
 }

 for (let i = 0; i < heart.length; i++)
 {
     heart[i].addEventListener("mouseleave", function() {
       //if(favori % 2 == 0 )
        heart[i].src="../Photos/coeur.png";
    });
 }

  function GetXmlHttpObject() {
    var xmlhttpreq=null;
    if(window.XMLHttpRequest) {
      xmlhttpreq = new XMLHttpRequest(); }
    else if(window.ActiveXObject) {
      xmlhttpreq = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return(xmlhttpreq);
  }
  var XmlHttp;
  function stateChanged(image) {
    //console.log("OK");
    //image.src="../Photos/coeur_plein.png";
    //console.log(image.src);
    console.log(XmlHttp.responseText);
    if(XmlHttp.readyState==4) {
      console.log("OK");
      image.src="../Photos/"+XmlHttp.responseText+".png";
    }
  }
  function ajouterFavori(login, cocktail, image) {
    XmlHttp=GetXmlHttpObject();
    if(XmlHttp==null) alert("Objets HTTP non supportés");
    else {
      XmlHttp.onreadystatechange=stateChanged(image);
      XmlHttp.open("GET","ajouterFavori.php?login="+login+"&cocktail="+cocktail,true);
      XmlHttp.send(null);
    }
  }

  for (let i = 0; i < heart.length; i++)
  {
      heart[i].addEventListener("click", function() {
        //console.log("click");
        var login = '<?php if (isset($_SESSION['login'])) echo $_SESSION['login'];
                           else echo 'user'
                      ?>';
        var cocktail = heart[i].parentElement.parentElement.firstChild.textContent;
        //console.log("login : " + login);
        //console.log("cocktail : " + cocktail);
        ajouterFavori(login, cocktail, heart[i]);
     });
  }

</script>
