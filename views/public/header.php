<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

    <title>Laptops</title>
    
    <style>
        body {
            background-image: url('../assets/images/pic2.jpg');
            background-size: cover;
            background-position: center;
        }
        .navbar-brand img {
            width: 100px;           
            height: auto;
            margin-right: 0px;    
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="<?= URI . "laptops/home"; ?>">
            <img src="../assets/images/logo.png" alt="Logo">
        </a>    

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="<?= URI . "laptops/index"; ?>">Store</a>
                </li>

                <!-- visiteur  -->

                <?php
                if (!isset($_SESSION['Utilisateur'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href=<?= URI . "auths/login"; ?>> Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href=<?= URI . "auths/inscription"; ?>> Inscription</a>
                    </li>
                   

                    <?php
                    
                } else { ?>

                    <!--  client -->

                    <li class="nav-item">
                        <a class="nav-link text-white" href=<?= URI . "auths/profil"; ?>>Profil</a>
                    </li>

                    <?php

                     //  admin

                     if ($_SESSION['role'] == 1 ) {
                      ?> 

                    <li class="nav-item">
                    <a class="nav-link text-white" href="<?= URI . "laptops/admin"; ?>">Gestion des commandes</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= URI . "auths/gestionUtilisateurs"; ?>">Gestion des utilisateurs</a>
                </li>


                <?php } ?>

                    <li class="nav-item">
                        <a class="nav-link text-white" href=<?= URI . "auths/deconnexion"; ?>>Deconnexion</a>
                    </li>

                    <?php } ?>

                <li>
                    <a href="<?= URI . "paniers/index" ?>" class="btn btn-primary "><i class="bi bi-cart4"></i>
                        <?=
                        (isset($_SESSION[Panier::NAME])) ?
                            count($_SESSION[Panier::NAME]) : 0;
                        ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</body>
</html>
