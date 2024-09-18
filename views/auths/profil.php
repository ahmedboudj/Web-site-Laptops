<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <script>
        function enableEdit() {
            // Activer les champs de formulaire
            document.getElementById('nom').readOnly = false;
            document.getElementById('prenom').readOnly = false;
            document.getElementById('email').readOnly = false;
            document.getElementById('numero_telephone').readOnly = false;
            document.getElementById('adresse').readOnly = false;
            document.getElementById('code_postal').readOnly = false;
            document.getElementById('id_role').disabled = false;

            // Cacher le bouton "Modifier" et afficher le bouton "Enregistrer"
            document.getElementById('editBtn').style.display = 'none';
            document.getElementById('saveBtn').style.display = 'block';
        }
    </script>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Bienvenue "<?= htmlspecialchars($utilisateur->prenom); ?>"</h1>
        
        <!-- Formulaire de profil de l'utilisateur -->
        <form action="<?= URI . "auths/modifier_profil"; ?>" method="POST">
            <div class="mb-3 row text-white">
                <label for="nom" class="col-sm-2 col-form-label">Nom :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($utilisateur->nom); ?>" readonly>
                </div>
            </div>

            <div class="mb-3 row text-white">
                <label for="prenom" class="col-sm-2 col-form-label">Prénom :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($utilisateur->prenom); ?>" readonly>
                </div>
            </div>

            <div class="mb-3 row text-white">
                <label for="email" class="col-sm-2 col-form-label">Email :</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($utilisateur->email); ?>" readonly>
                </div>
            </div>
            
            <div class="mb-3 row text-white">
                <label for="numero_telephone" class="col-sm-2 col-form-label">Numéro de téléphone :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="numero_telephone" name="numero_telephone" value="<?= htmlspecialchars($utilisateur->numero_telephone); ?>" readonly>
                </div>
            </div>
            
            <div class="mb-3 row text-white">
                <label for="adresse" class="col-sm-2 col-form-label">Adresse :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="adresse" name="adresse" value="<?= htmlspecialchars($utilisateur->adresse); ?>" readonly>
                </div>
            </div>
            
            <div class="mb-3 row text-white">
                <label for="code_postal" class="col-sm-2 col-form-label">Code postal :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="code_postal" name="code_postal" value="<?= htmlspecialchars($utilisateur->code_postal); ?>" readonly>
                </div>
            </div>
            
            <div class="mb-3 row text-white">
                <label for="id_role" class="col-sm-2 col-form-label">Rôle :</label>
                <div class="col-sm-10">
                    <select class="form-select" id="id_role" name="id_role" disabled>
                        <option value="1" <?php if ($utilisateur->id_role == 1) echo 'selected'; ?>>Admin</option>
                        <option value="2" <?php if ($utilisateur->id_role == 2) echo 'selected'; ?>>Client</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row text-white">
                <div class="col-sm-10 offset-sm-2">
                    <button type="button" class="btn btn-primary" id="editBtn" onclick="enableEdit()">Modifier</button>
                    <button type="submit" class="btn btn-success" id="saveBtn" style="display: none;">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
