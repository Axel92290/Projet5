<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="Projet-5/index.php">Accueil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="Projet-5/post/post.php">Post</a>
                </li>
                <li class="nav-item">

                    <a class="nav-link" href="Projet-5/Profile/members.php">Membres</a>
                </li>
                <?php
                if (!isset($_SESSION['id'])) {

                ?>
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="Projet-5/registration.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Projet-5/connexion.php">Connexion</a>
                    </li>

                    <?php
                } else {
                    ?>


                    <li class="nav-item">
                        <a class="nav-link" href="Projet-5/Profile/profile.php">Mon profil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="Projet-5/deconnexion.php">Deconnexion</a>
                    </li>
                    <?php
                } ?>



                </ul>
        </div>
    </div>
</nav>