<div class="container">
    <div class="text-center mb-4 mt-4">
        <a class="btn btn-primary" href="<?= URI . "laptops/ajouter"; ?>">Ajouter un nouveau laptop  <i class="bi bi-laptop-fill"></i>+</a>
    </div>

    <table class="table">
    <thead>
    <tr>
        <th scope="col">#id</th>
        <th scope="col">Image</th>
        <th scope="col">Nom</th>
        <th scope="col">Prix</th>
        <th scope="col">Quantité</th>
        <th scope="col">Courte description</th>
        <th scope="col">Description</th> 
        <th scope="col">Actions</th>
    </tr>
</thead>

        <tbody>
    <?php foreach ($laptops as $laptop) { ?>
        <tr>
            <th scope="row"><?= $laptop->id_laptop; ?></th>
            <td><img height="100px" width="100px" src="<?= isset($laptop->chemin_image) ? URI . $laptop->chemin_image : URI . "assets/image.jpeg"; ?>" alt=""></td>
            <td><?= $laptop->nom; ?></td>
            <td><?= $laptop->prix; ?></td>
            <td><?= $laptop->quantite; ?></td>
            <td><?= $laptop->courte_description; ?></td>
            <td><?= $laptop->description; ?></td> 
            <td class="row">
                <a class="btn btn-info col" href="<?= URI . "laptops/modifier/" . $laptop->id_laptop; ?>"><i class="bi bi-pencil-square"></i></a>
                <a class="btn btn-danger col" href="<?= URI . "laptops/supprimer/" . $laptop->id_laptop; ?>"><i class="bi bi-trash3"></i></a>
            </td>
        </tr>
    <?php } ?>
</tbody>

    </table>
</div>
