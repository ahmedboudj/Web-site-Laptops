<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Panier</title>
   
    <style>
        
        .prix-blanc {
            color: white;
        }

    </style>
</head>

<body>
    <h1 class="text-center">Gestion Panier</h1>
    <table class="table container">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Courte description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cmpt = 1;
            $prixTotal = 0; 

            foreach ($laptops as $laptop) {
                $quantite = $laptop[0];
                $currentLaptop = $laptop[1];

                
                $prixTotal += $currentLaptop->prix * $quantite;

                ?>
                <tr>
                    <th><?= $cmpt++; ?></th>
                    <td><img height="100px" width="100px" src="<?= isset($currentLaptop->chemin_image) ? URI . $currentLaptop->chemin_image : URI . "assets/image.jpeg"; ?>" alt=""></td>
                    <td><?= $currentLaptop->nom; ?></td>
                    <td class="prix-blanc"><?= $currentLaptop->prix; ?> $</td>
                    <td>
                        <input class="quantite-input" data-laptop-id="<?= $currentLaptop->id_laptop; ?>" name="quantite" type="number" min="0" max="<?= $currentLaptop->quantite; ?>" value="<?= $quantite; ?>">
                    </td>
                    <td><?= $currentLaptop->courte_description; ?></td>
                    <td class="row">
                        <button class="modifier-btn btn btn-info col"><i class="bi bi-pencil-square"></i></button>
                        <a class="supprimer-btn btn btn-danger col" href="<?= URI . "paniers/supprimer/" . $currentLaptop->id_laptop; ?>"><i class="bi bi-trash3"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


    <h3 class="prix-blanc" style="text-align : center";>Total du panier: <?= $prixTotal; ?> $</h3>

    <!-- <?php if (isset($_SESSION['Utilisateur'])): ?>
            <div id="paypal-button-container"></div>
        <?php else: ?>
            header("Location: " . URI . "auths/login");
        <?php endif; ?> -->

<script src="https://www.paypal.com/sdk/js?client-id=Ac-VZtkL8Zy_z5t0QSoB-bLA7XUAndR8AehXJ8HubHfS7oCSyHK2JXUhgcp8jf-20BHkJYcIUa9UnohG&components=buttons"></script>


<?php
if (isset($_SESSION['Utilisateur'])){
     ?>
   <div style="display: flex; justify-content: center; margin-top: 20px;">
    <div id="paypal-button-container"></div>
</div>

     <?php
}else{
    header("Location: " . URI . "auths/login");
                    return;
}
?> 

    <script>

        // PayPall

    paypal.Buttons({
        createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: <?= $prixTotal; ?>,
                }
            }]
        });
    },
    onApprove: async (data, actions) => {

        const order = await actions.order.capture();
        console.log(order);
        alert('Transaction completed by ' + order.payer.name.given_name);
    }
   } ).render('#paypal-button-container');




        document.addEventListener('DOMContentLoaded', function () {
            const quantiteInputs = document.querySelectorAll('.quantite-input');

            quantiteInputs.forEach(function (input) {
                input.addEventListener('change', function () {
                    const quantite = input.value;
                    const laptopId = input.getAttribute('data-laptop-id');

                    fetch('<?= URI . "paniers/modifier/"; ?>' + laptopId, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'quantite=' + encodeURIComponent(quantite),
                    }).then(function() {
                        // Recharger la page après modification
                        window.location.reload();
                    });
                });
            });
        });

    </script>
</body>

</html>
