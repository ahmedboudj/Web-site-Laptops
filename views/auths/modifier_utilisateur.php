<header>
    <?php
    require_once(RACINE . "views/public/header.php");
    ?>
</header>

<div class="container">
    <h1 class="text-center">Modifier un utilisateur</h1>
    
    <form action="<?= URI . "Auths/modifier_utilisateur/" . $utilisateur->id_utilisateur; ?>" method="post">
        
        <div class="mb-3 row">
            <label for="nom" class="col-sm-2 col-form-label">Nom :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nom" name="nom" value="<?= $utilisateur->nom; ?>">
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="prenom" class="col-sm-2 col-form-label">Prénom :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $utilisateur->prenom; ?>">
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email :</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="<?= $utilisateur->email; ?>">
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="numero_telephone" class="col-sm-2 col-form-label">Numéro de téléphone :</label>
            <div class="col-sm-10"> 
                <input type="text" class="form-control" id="numero_telephone" name="numero_telephone" value="<?= $utilisateur->numero_telephone; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="adresse" class="col-sm-2 col-form-label">Adresse :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="adresse" name="adresse" value="<?= $utilisateur->adresse; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="code_postal" class="col-sm-2 col-form-label">code_postal :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="code_postal" name="code_postal" value="<?= $utilisateur->code_postal; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="id_role" class="col-sm-2 col-form-label">Rôle :</label>
            <div class="col-sm-10">
                <select class="form-select" id="id_role" name="id_role">
                    <option value="1" <?php if ($utilisateur->id_role == 1) echo 'selected'; ?>>Admin</option>
                    <option value="2" <?php if ($utilisateur->id_role == 2) echo 'selected'; ?>>Client</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
            </div>
        </div>
    
<footer class="fixed-bottom bg-light text-center">
   <?php
    require_once(RACINE . "views/public/footer.php");
    ?>
</footer>