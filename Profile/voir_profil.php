<?php
require_once('../include.php');

$get_id = (int) $_GET['id'];

if ($get_id <= 0) {
    header('Location : members.php');
    exit;
}

if (isset($_SESSION['id']) && $get_id == $_SESSION['id']) {
    header('Location: profile.php');
    exit;
}

$req = $DB->prepare("SELECT * FROM utilisateur WHERE id = ?");

$req->execute([$get_id]);

$req_user = $req->fetch();

$date = date_create($req_user['date_creation']);
$date_registration = date_format($date, 'd/m/Y');

$date = date_create($req_user['date_connexion']);
$date_connexion = date_format($date, 'd/m/Y à H:i');

switch ($req_user['role']) {
    case 0:
        $role = "Utilisateur";
        break;

    case 1:
        $role = "Super Admin";
        break;

    case 2:
        $role = "Admin";
        break;

    case 3:
        $role = "Modérateur";
        break;
}

?>


<!doctype html>
<html lang="fr">

<head>
    <?php
    require_once('../head/meta.php');
    require_once('../head/script.php');
    require_once('../head/link.php');
    ?>

    <title>Profil de <?= $req_user['prenom'] ?> </title>
</head>

<body>
    <?php
    require_once('../menu/menu.php');
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1> <?= $req_user['prenom'] ?> <?= $req_user['nom'] ?></h1>

                <div>
                    Date d'inscription : <?= $date_registration ?>
                </div>

                <div>
                    Date de dernière connexion : <?= $date_connexion ?>
                </div>

                <div>
                    Rôle utilisateur : <?= $role ?>
                </div>





            </div>


        </div>

    </div>

    <?php
    require_once('../footer/footer.php');
    ?>
</body>

</html>