<?php
session_start();
//tout simplement on detruit la session et on revient a l'acceuil
session_destroy();
header("Location: index.php");
?>