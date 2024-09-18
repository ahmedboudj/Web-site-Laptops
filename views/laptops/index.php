<div class="container">
<div style="display: flex; justify-content: center; margin-top: 20px;">
    <img height="250px" width="500px" src="<?= (isset($laptop->chemin_image)) ? URI . $laptop->chemin_image : URI . "assets/images/horiz.avif"; ?>" style="border-radius: 15px;">
</div>

    <h1 class="text-center text-white mb-5 mt-5" style="font-family: 'Verdana', sans-serif;"><i class="bi bi-laptop"></i> Laptops Store</h1>
    <h5 class="text-center text-white mb-5 mt-3" style="font-family: 'Georgia', serif;">"Votre satisfaction est notre priorité."</h5>
    
   

    <div class="row row-cols-1 row-cols-md-2 g-4 py-5">
    <?php foreach ($laptops as $laptop): ?>
        <div class="col-6 col-md-3"> 
            <div class="card">
                <img height="200px" width="150px" src="<?= (isset($laptop->chemin_image)) ? URI . $laptop->chemin_image : URI . "assets/image.jpeg"; ?>" class="card-img-top bg-dark" alt="...">
                <div class="card-body text-white bg-dark">
                    <h5 class="card-title text-center mb-4"><?= $laptop->nom; ?></h5>
                    <p class="card-text"><?= $laptop->courte_description; ?></p>
                    <p class="card-text"><?= $laptop->description; ?></p>
                </div>
                <div class="d-flex justify-content-center text-white bg-dark">
                    <h3 class="text-center">Prix : <?= $laptop->prix; ?>$</h3>
                </div>
                    <a class="btn btn-primary" href="<?= URI . "paniers/ajouter/" . $laptop->id_laptop ?>">Ajouter au panier</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    </div>
