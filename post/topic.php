<?php
require_once('../include.php');

if (!isset($_GET['id'])) {
    header('Location : post.php');
    exit;
}

$get_id_topic = (int) $_GET['id'];

if ($get_id_topic <= 0) {
    header('Location : post.php');
    exit;
}

$req = $DB->prepare("SELECT t.*, u.prenom, p.titre AS titre_post
                     FROM topics  t
                     INNER JOIN utilisateur u ON u.id = t.id_utilisateur
                     INNER JOIN post p ON p.id = t.id_post
                     WHERE t.id = ? 
                     ORDER BY t.date_creation DESC");

$req->execute([$get_id_topic]);

$req_topic = $req->fetch();

if (!isset($req_topic['id'])) {
    header('Location: Projet-5/post/post.php');
    exit;
}


$req = $DB->prepare("SELECT tc.*, u.prenom 
                     FROM topics_commentaires tc 
                     INNER JOIN utilisateur u 
                     ON u.id = tc.id_utilisateur
                     WHERE tc.id_topics = ?
                     ORDER BY tc.date_creation DESC");


$req->execute([$req_topic['id']]);

$req_topics_commentaires = $req->fetchAll();

?>

<!doctype html>
<html lang="fr">

<head>
    <title>Post - <?= $req_topic['titre'] ?></title>
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
            <div class="col-3"></div>
            <div class="col-6">
                <h1><?= $req_topic['titre'] ?></h1>
                <br>
                <a href="Projet-5/post/edit-topic.php?id=<?= $req_topic['id'] ?>">Editer mon topic</a>
                <br>
                <br>
            </div>
            <div class="col-3"></div>

        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div><?= nl2br($req_topic['contenu']); ?></div>
                <br>
                <div> De <?= $req_topic['prenom']; ?></div>
                <div> Catégorie : <?= $req_topic['titre_post']; ?></div>
                <div> Créé Le <?= date_format(date_create($req_topic['date_creation']), 'd/m/Y à H:i'); ?></div>

                <?php
                if ($req_topic['date_creation'] < $req_topic['date_modification']) {
                ?>
                <div> Modifié Le <?= date_format(date_create($req_topic['date_modification']), 'd/m/Y à H:i'); ?></div>
                <?php
                }
                ?>

            </div>
            <div class="col-3"></div>
        </div>
    </div>


    <br>

    <div class="row">
        <div class="col-3"></div>
        <div class="col-3">
            <h1>Commentaires</h1>
        </div>



        <?php
        foreach ($req_topics_commentaires as $rtc) {


        ?>
        <div class="col-6">
        </div>
        <div class="col-3"></div>

    </div>

    <br>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div><?= nl2br($rtc['contenu']); ?></div>
            <br>
            <div> De <?= $rtc['prenom']; ?></div>
            <div> Créé Le <?= date_format(date_create($rtc['date_creation']), 'd/m/Y à H:i'); ?></div>

            <?php
            if ($rtc['date_creation'] < $rtc['date_modification']) {
            ?>
            <div> Modifié Le <?= date_format(date_create($rtc['date_modification']), 'd/m/Y à H:i'); ?></div>
            <?php
            }
            ?>

        </div>
        <div class="col-3"></div>
        <?php
        }
    ?>
    </div>
    </div>


    <?php
    require_once('../footer/footer.php');
    ?>
</body>

</html>