<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Acceuil</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  <body>


    <div class="main border container">
      <div class="navigationHaut border">

        <button type="button" id="navigation" name="navigation"> Navigation </button>
        <button type="button" id="recettes" name="recettes"> Recettes </button>

        <span>
          Recherche :
          <input type="search" id="recherche" name="recherche">
          <button type="submit" name="submit"> inserer une image loupe </button>
        </span>
         <a href="login.php"> <button type="button" name="button"> Zone de connexion </button> </a>

      </div>


      <div class="body border row">

        <div class="navigationGauche border col-auto">

          <h3>Aligment Courant</h3>

        <span>  <a href="#"> Aliment </a> / <a href="#">Fruit</a> / <a href="#">Agrumes</a> </span>

          <h4>Sous-Categories</h4>

          <ul>
            <li> <a href="#">Citron</a> </li>
            <li> <a href="#">Citron vert</a> </li>
            <li> <a href="#">Kumqat</a> </li>
            <li> <a href="#">Mandarine</a> </li>
            <li> <a href="#">Orange</a> </li>
            <li> <a href="#">Pamplemousse</a> </li>
            <li> <a href="#"> Partie d'Agrumes </a> </li>
          </ul>

        </div>

        <div class="listeCock col">

          <h4>Liste des Cocktails</h4>

          <div class="row">
                <div class="boisson border col-auto">
                  <h5>bloody Mary</h5>

                  <img src="une iamge de coeur a recup sur le net" alt="coeur">
                  <img src="image de la boisson a recup dans les photos" alt="boisson">

                  <ul>
                    <li>vodka</li>
                    <li>jus de citron</li>
                    <li>Jus d'orange</li>
                  </ul>

                </div>


                <div class="boisson border col-auto">
                  <h5>bloody Mary</h5>

                  <img src="une iamge de coeur a recup sur le net" alt="coeur">
                  <img src="image de la boisson a recup dans les photos" alt="boisson">

                  <ul>
                    <li>vodka</li>
                    <li>jus de citron</li>
                    <li>Jus d'orange</li>
                  </ul>

            </div>
          </div>


        </div>

      </div>

    </div>

  </body>
</html>
