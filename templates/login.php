<?php require_once _ROOTPATH_.'/templates/header.php';?>

    <div class="text-center">
        <h2>
            Connectez vous
        </h2>
    </div>

    <?php 
        if(isset($errors)) {
        foreach ($errors as $error) {?>
            <div class="alert alert-danger">
                <?= $error; ?>
            </div>
    <?php }} ?>


    <form action="index.php?controller=auth&action=login" method="POST" class="form">
        <input type="hidden" name="loginUser">

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="text" name="email" id="email" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Mot de Passe :</label>
            <input type="text" name="password" id="password" required class="form-control">
        </div>


        <br>

    <input type="submit" value="Se connecter" class="btn btn-primary">
</form>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>