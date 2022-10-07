<?php
require_once('include.php');

if (isset($_SESSION['id'])) {
    $welcome = "Bonjour " . $_SESSION['prenom'];
} else {
    $welcome = "Bonjour à toi cher visiteur";
}


?>


<!doctype html>
<html lang="fr">

<head>
    <title>Accueil</title>
    <?php
    require_once('head/meta.php');
    require_once('head/link.php');
    require_once('head/script.php');
    ?>



</head>

<body>
    <?php
    require_once('menu/menu.php');
    ?>


    <h1><?= $welcome ?> </h1>



    <?php
    require_once('footer/footer.php');
    ?>

</body>



</html>