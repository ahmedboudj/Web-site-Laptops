<table class="table container">
<h1 class="text-center">Ordinateurs populaire</h1>
    <thead>
    <tr>
        <th scope="col">N</th>
        <th scope="col">Image</th>
        <th scope="col">Nom</th>
        <th scope="col">Prix</th>
        <th scope="col">Quantite</th>
        <th scope="col">Courte description</th>

    </tr>
    </thead>
    <tbody>
    <?php
    $cmpt = 1;
    foreach ($laptops as $laptop) {
        ?>
        <tr>
            <th scope="row"><?= $cmpt++; ?></th>
            <td><img height="100px" width="100px" src="<?=
                (isset($laptop->chemin_image)) ? URI . $laptop->chemin_image
                    : URI . "assets/image.jpeg";

                ?>" alt="">

            </td>
            <?php echo $laptop->id_laptop ?>
            <td><?= $laptop->nom; ?></td>
            <td><?= $laptop->prix; ?></td>
            <td><?= $laptop->quantite; ?></td>
            <td><?= $laptop->courte_description; ?></td>
            <td><a class="btn btn-primary" href="<?= URI."paniers/ajouter/".$laptop->laptop ?>" >Ajouter au panier</a></td>
        </tr>
        <?php
    }

    ?>

    </tbody>
</table>

