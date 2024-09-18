<header>
    <?php
    require_once(RACINE . "views/public/header.php");
    ?>
</header>

<form method="post" class="container">
    <div class="mb-3 text-white">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom" id="nom">
    </div>  

    <div class="mb-3 text-white">
        <label for="prenom" class="form-label">Prenom</label>
        <input type="text" class="form-control" name="prenom" id="prenom">
    </div>
    
    <div class="mb-3 text-white">
        <label for="courriel" class="form-label">Courriel</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>
    
    <div class="mb-3 text-white">
        <label for="numero_telephone" class="form-label">Numero telephone</label>
        <input type="text" class="form-control" name="numero_telephone" id="numero_telephone">
    </div>

    <div class="mb-3 text-white">
        <label for="adresse" class="form-label">Adresse</label>
        <input type="text" class="form-control" name="adresse" id="adresse">
    </div>

    <div class="mb-3 text-white">
        <label for="code_postal" class="form-label">Code postal</label>
        <input type="text" class="form-control" name="code_postal" id="code_postal">
    </div>

    <div class="mb-3 text-white">
        <label for="mot_de_passe" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe">
    </div>

    <div class="mb-3 text-white">
        <label for="c_mot_de_passe" class="form-label">Confirme mot de passe</label>
        <input type="password" class="form-control" name="c_mot_de_passe" id="c_mot_de_passe">
    </div>

    <?php
    if (isset($message)) {
        ?>
        <div class="alert alert-danger" role="alert">
            <?= $message; ?>
        </div>
        <?php

    }

    ?>

    <input type="submit" class="btn btn-success" name="Save" value="Cree un compte">
</form>


<footer class="fixed-bottom bg-light text-center">
<?php
    require_once(RACINE . "views/public/footer.php");
    ?>
</footer>