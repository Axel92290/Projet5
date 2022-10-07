<?php
require_once('../include.php');

$req = $DB->prepare("SELECT * FROM post ORDER BY ordre");

$req->execute();

$req_post = $req->fetchAll();

?>

<!doctype html>
<html lang="fr">

<head>
    <title>Liste des posts</title>
    <?php
    require_once('../head/meta.php');
    require_once('../head/link.php');
    require_once('../head/script.php');
    ?>


</head>

<body>
    <?php
    require_once('../menu/menu.php');
    ?>
    <div class="container-sm">
        <div class="row">
            <div class="col-12">
                <h1>Liste des posts</h1>
            </div>
            <br>

            <?php if (isset($_SESSION['id'])) {
            ?>
            <div>
                <a href="Projet-5/post/creer-topic.php">Créer un Topic</a>
            </div>
            <?php
            }
            ?>
            <br>
            <br>
            <?php
            foreach ($req_post as $rp) {

            ?>

            <div class="col-3">
                <?= $rp['titre']; ?> <br>
                <a href="Projet-5/post/list-topics.php?id=<?= $rp['id'] ?>">Voir les topics</a>
            </div>
            <?php
            }
            ?>


            <?php
            require_once('../footer/footer.php');
            ?>
</body>

</html>