<?php
require_once('include.php');

if (!empty($_REQUEST)) {
    extract($_REQUEST);


    if (isset($_REQUEST['inscription'])) {

        [$err_nom, $err_prenom, $err_mail, $err_pword] = $_registration->verif_registration($nom, $prenom, $mail, $confmail, $pword, $confpassword);
    }
}

?>


<!doctype html>
<html lang="fr">

<head>

    <?php
    require_once('head/meta.php');
    require_once('head/script.php');
    require_once('head/link.php');
    ?>

    <title>Inscription</title>

</head>

<body>
    <?php
    require_once('menu/menu.php');
    ?>


    <div class="container-sm">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>Inscription</h1>
                <form method="post" action="">
                    <div class="sm-3">
                        <?php if (isset($err_nom)) {
                            echo '<div>' . $err_nom . '</div>';
                        } ?>
                        <label class="form-label">Nom</label>
                        <input class="form-control" type="text" name="nom" value="<?php if (isset($nom)) {
                                                                                        echo $nom;
                                                                                    } ?>" placeholder="Nom" />
                    </div>
                    <div class="sm-3">
                        <?php if (isset($err_prenom)) {
                            echo '<div>' . $err_prenom . '</div>';
                        } ?>
                        <label class="form-label">Prénom</label>
                        <input class="form-control" type="text" name="prenom" value="<?php if (isset($prenom)) {
                                                                                            echo $prenom;
                                                                                        } ?>" placeholder="Prenom" />
                    </div>
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
                        <label class="form-label">Confirmation du mail</label>
                        <input class="form-control" type="email" name="confmail" value="<?php if (isset($confmail)) {
                                                                                            echo $confmail;
                                                                                        } ?>" placeholder="Confirmation du mail" />
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
                        <label class="form-label">Confirmation du mot de passe</label>
                        <input class="form-control" type="password" name="confpassword" value="" placeholder="Confirmation du mot de passe" />
                    </div>
                    <div class="sm-3">
                        <button type="submit" name="inscription" class="btn btn-outline-dark">Inscription</button>
                    </div>
            </div>
        </div>
    </div>

    </form>




    <?php
    require_once('footer/footer.php');
    ?>
</body>

</html>