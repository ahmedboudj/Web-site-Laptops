<div class="container">
    <h1 class="text-center">Liste des utilisateurs</h1>

    <div class="text-center mb-4 mt-4">
        <a class="btn btn-primary" href="<?= URI . "auths/ajouter_user"; ?>">Ajouter un nouveau utilisateur <i class="bi bi-person-add"></i></a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Email</th>
                <th scope="col">Numéro de téléphone</th>
                <th scope="col">adresse</th>
                <th scope="col">code_postal</th>
                <th scope="col">Rôle</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur) { ?>
                <tr>
                    <th scope="row"><?= $utilisateur->id_utilisateur; ?></th>
                    <td><?= $utilisateur->nom; ?></td>
                    <td><?= $utilisateur->prenom; ?></td>
                    <td><?= $utilisateur->email; ?></td>
                    <td><?= $utilisateur->numero_telephone; ?></td>
                    <td><?= $utilisateur->adresse; ?></td>
                    <td><?= $utilisateur->code_postal; ?></td>
                    <td><?= $utilisateur->id_role; ?></td>
                    <td class="row">
                          <a class="btn btn-info col" href="<?= URI . "auths/modifier_utilisateur/" . $utilisateur->id_utilisateur; ?>"><i class="bi bi-pencil-square"></i></a>
                        <a class="btn btn-danger col" href="<?= URI . "Auths/supprimer/" . $utilisateur->id_utilisateur; ?>"><i class="bi bi-trash3"></i></a>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
