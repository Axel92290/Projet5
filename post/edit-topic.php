<?php
require_once('../include.php');

if (!isset($_SESSION['id'])) {

    header('Location: ../index.php');
    exit;
}


if (!isset($_GET['id'])) {
    header('Location: post.php');
    exit;
}

$get_id_topic = (int) $_GET['id'];

if ($get_id_topic <= 0) {
    header('Location: post.php');
    exit;
}

$req = $DB->prepare("SELECT t.*, p.titre AS titre_post FROM topics t INNER JOIN post p ON p.id = t.id_post WHERE t.id=? ");

$req->execute([$get_id_topic]);

$req_topic = $req->fetch();

if (!isset($req_topic['id'])) {
    header('Location: post.php');
    exit;
}

$req = $DB->prepare("SELECT id, titre FROM post ");

$req->execute();

$req_post = $req->fetchAll();


if (!empty($_REQUEST)) {
    extract($_REQUEST);

    $valid = (bool) true;

    if (isset($_REQUEST['edit'])) {

        $titre = (string) ucfirst(trim($titre));
        $categorie = (int) $categorie;
        $contenu = (string) trim($contenu);

        if (empty($titre)) {
            $valid = false;
            $err_titre = "Ce champ ne peut pas être vide";
        } elseif (grapheme_strlen($titre) < 4) {
            $valid = false;
            $err_titre = "Le titre doit faire plus de 3 caractères.";
        } elseif (grapheme_strlen($titre) > 50) {
            $valid = false;
            $err_titre = "Le titre doit faire moins de 51 caractères (" . grapheme_strlen($titre) . "/50)";
        }


        $req = $DB->prepare("SELECT id, titre FROM post WHERE id = ?");

        $req->execute([$categorie]);

        $req_post_verif = $req->fetch();

        if (!isset($req_post_verif['id'])) {
            $valid = false;
            $categorie = null;
            $err_cat = "Cette catégorie n'existe pas";
        }

        if (empty($contenu)) {
            $valid = false;
            $err_contenu = "Ce champ ne peut pas être vide";
        } elseif (grapheme_strlen($contenu) < 4) {
            $valid = false;
            $err_contenu = "Le contenu doit faire plus de 3 caractères.";
        }

        if ($valid) {

            $date_modification = date('Y-m-d H:i:s');

            $req = $DB->prepare("UPDATE topics SET id_post = ?, titre = ? , contenu = ?, date_modification = ? WHERE id = ?");

            $req->execute([$req_post_verif['id'], $titre, $contenu, $date_modification, $req_topic['id']]);

            header('Location: ./topic.php?id=' . $req_topic['id']);

            exit;
        }
    }
}

?>

<!doctype html>
<html lang="fr">

<head>
    <title>Editer mon Topic</title>
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
                <h1>Editer mon topic</h1>
                <form method="post">
                    <div class="sm-3">
                        <?php if (isset($err_titre)) {
                            echo '<div>' . $err_titre . '</div>';
                        } ?>
                        <label class="form-label">Titre</label>
                        <input class="form-control" type="text" name="titre" value="<?php if (isset($titre)) {
                                                                                        echo $titre;
                                                                                    } else {
                                                                                        echo $req_topic['titre'];
                                                                                    } ?>" placeholder="Titre" />
                    </div>
                    <div class="sm-3">
                        <?php if (isset($err_cat)) {
                            echo '<div>' . $err_cat . '</div>';
                        } ?>
                        <label class="form-label">Catégorie</label>
                        <select class="form-control" name="categorie">

                            <?php
                            if (isset($categorie)) {
                            ?>
                            <option value="<?= $req_post_verif['id'] ?>"> <?= $req_post_verif['titre'] ?> </option>
                            <?php
                            } elseif (isset($req_topic['id_post'])) {

                            ?>

                            <option value="<?= $req_topic['id_post'] ?>"> <?= $req_topic['titre_post'] ?> </option>

                            <?php
                            } else {
                            ?>
                            <option hidden>Choisissez votre catégorie</option>
                            <?php
                            }
                            ?>


                            <?php
                            foreach ($req_post as $rp) {

                            ?>
                            <option value="<?= $rp['id'] ?>"><?= $rp['titre'] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>

                    <div class="sm-3">
                        <?php if (isset($err_contenu)) {
                            echo '<div>' . $err_contenu . '</div>';
                        } ?>
                        <label class="form-label">Contenu</label>
                        <textarea class="form-control" type="text" name="contenu"
                            placeholder="Votre topic..."><?php if (isset($contenu)) {
                                                                                                                    echo $contenu;
                                                                                                                } else {
                                                                                                                    echo $req_topic['contenu'];
                                                                                                                }  ?></textarea>
                    </div>

                    <div class="sm-3">
                        <button type="submit" name="edit" class="btn btn-outline-dark">Modifier mon topic </button>
                    </div>
                </form>




            </div>
        </div>

        <?php
        require_once('../footer/footer.php');
        ?>
</body>

</html>