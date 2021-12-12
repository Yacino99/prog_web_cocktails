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
      echo '<a href="?page=profil"><button type="button" name="profil"> Profil </button></a>'; 
      echo '
      <a href="deconnexion.php"><button type="button" name="profil"> Deconnexion </button></a>
      '; 
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
  var imageCoeur; // variable globale pour que ajouterFavoris puisse la modifier et stateChanged puisse l'utiliser sans avoir à
                  // le passer en parametre
  function stateChanged() {
    if(XmlHttp.readyState==4) {
      console.log("stateChanged : XmlHttp.responseText = " + XmlHttp.responseText);
      //console.log("stateChanged : " + imageCoeur.src);
      imageCoeur.src="../Photos/"+XmlHttp.responseText+".png";
    }
  }
  function ajouterFavori(login, cocktail, image) {
    XmlHttp=GetXmlHttpObject();
    if(XmlHttp==null) alert("Objets HTTP non supportés");
    else {
      imageCoeur = image; // on màj la var globale pour que stateChanged puisse l'utiliser
      XmlHttp.onreadystatechange=stateChanged;
      XmlHttp.open("GET","ajouterFavori.php?login="+login+"&cocktail="+cocktail,true);
      XmlHttp.send(null);
    }
  }
  for (let i = 0; i < heart.length; i++) {
      heart[i].addEventListener("click", function() {
        //console.log("click");
        var login = '<?php if (isset($_SESSION['login'])) echo $_SESSION['login'];
                           else echo 'user';
                      ?>';
        var cocktail = heart[i].parentElement.parentElement.firstChild.textContent;
        console.log("login : " + login);
        console.log("cocktail : " + cocktail);
        ajouterFavori(login, cocktail, heart[i]);
     });
  }


  // ------------ Mettre les coeurs rouge par défaut aux favoris ------------
  var XmlHttp2;
  var imageCoeur2; // variable globale pour que estFavori puisse la modifier et stateChanged2 puisse l'utiliser sans avoir à
                   // le passer en parametre
  function stateChanged2() {
    if(XmlHttp2.readyState==4) {
      console.log("stateChanged2 : XmlHttp.responseText = " + XmlHttp2.responseText);
      imageCoeur2.src="../Photos/"+XmlHttp2.responseText+".png";
    }
  }
  function estFavori(login, cocktail, image) {
    XmlHttp2=GetXmlHttpObject();
    if(XmlHttp2==null) alert("Objets HTTP non supportés");
    else {
      imageCoeur2 = image; // on màj la var globale pour que stateChanged2 puisse l'utiliser
      XmlHttp2.onreadystatechange=stateChanged2;
      XmlHttp2.open("GET","estFavori.php?login="+login+"&cocktail="+cocktail,false); // false => synchrone
      XmlHttp2.send(null);
    }
  }
  for (let i = 0; i < heart.length; i++) {
    var login = '<?php if (isset($_SESSION['login'])) echo $_SESSION['login'];
                       else echo 'user';
                 ?>';
    var cocktail = heart[i].parentElement.parentElement.firstChild.textContent;
    console.log("Parcours : "+cocktail);
    estFavori(login, cocktail, heart[i]); // on traite tous les coeurs de la page sans condition
  }

</script>
