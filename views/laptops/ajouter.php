<form class="m-5" method="post" enctype="multipart/form-data">
    
    <div class="mb-3 text-white">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom">
    </div>
    
    <div class="mb-3 text-white">
        <label for="prix" class="form-label">Prix</label>
        <input type="text" class="form-control" id="prix" name="prix">
    </div>
    
    <div class="mb-3 text-white">
        <label for="quantite" class="form-label">Quantité</label>
        <input type="number" class="form-control" id="quantite" name="quantite">
    </div>
    
    <div class="mb-3 text-white">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    
    <div class="mb-3 form-floating">
        <textarea class="form-control" name="courte_description" style="height: 100px" placeholder="Entrer votre courte description ici" id="courte_description"></textarea>
        <label for="courte_description" class="form-label">Courte description</label>
    </div>

    <div class="mb-3 form-floating">
        <textarea class="form-control" name="description" style="height: 100px" placeholder="Entrer votre description ici" id="description"></textarea>
        <label for="description" class="form-label">Description</label>
    </div>
    
    <input class="btn btn-primary" type="submit" value="Ajouter" name="save">
</form>
