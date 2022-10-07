<?php
require_once('include.php');

if (isset($_SESSION['id'])) {

    header('Location : index.php');
    exit;
}

if (!empty($_REQUEST)) {
    extract($_REQUEST);

    if (isset($_REQUEST['connexion'])) {

        [$err_mail, $err_pword] = $_Connexion->verif_connexion($mail, $pword);
    }
}

?>

<!doctype html>
<html lang="fr">

<head>
    <title>Connexion</title>
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
    <div class="container-sm">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>Connexion</h1>
                <form method="post" action="">
                    <div class="sm-3">
                        <?php if (isset($err_mail)) {
                            echo '<div>' . $err_mail . '</div>';
                        } ?>
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" name="mail" value="<?php if (isset($mail)) {
                                                                                        echo $mail;
                                                                                    } ?>" placeholder="Mail" />
                    </div>
                    <div class="sm-3">
                        <?php if (isset($err_pword)) {
                            echo '<div>' . $err_pword . '</div>';
                        } ?>
                        <label class="form-label">Mot de passe</label>
                        <input class="form-control" type="password" name="pword" value="<?php if (isset($pword)) {
                                                                                            echo $pword;
                                                                                        } ?>" placeholder="Mot de passe" />
                    </div>
                    <div class="sm-3">
                        <button type="submit" name="connexion" class="btn btn-outline-dark">Se connecter </button>
                    </div>
            </div>
        </div>

        </form>
        <?php
        require_once('footer/footer.php');
        ?>
</body>

</html>