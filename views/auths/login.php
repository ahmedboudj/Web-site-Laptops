<form method="post" class="container">

    <div class="mb-3 text-white">
        <label for="exampleInputEmail1" class="form-label">E-mail address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    
    <div class="mb-3 text-white">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="mot_de_passe" class="form-control" id="exampleInputPassword1">
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

    <input value="submit" type="submit" name="submit" class="btn btn-primary">
</form>