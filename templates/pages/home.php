<?php require_once _ROOTPATH_.'/templates/header.php'; ?>


            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="assets/images/logo_KGB.png" class="d-block mx-lg-auto img-fluid" alt="kgb logo" loading="lazy" width="250px" >
                </div>
                <div class="col-lg-6">
                    <h1 class="h1Color display-5 fw-bold text-body-emphasis lh-1 mb-3">Bienvenue sur le site du KGB</h1>
                    <p class="lead">Sur ce site est listé nos opérations en cours. Si vous êtes habilités, vous pourrez également créer ou supprimer une mission.</p>
                    
                </div>
            </div>

            <div class="text-center">
                <h2>
                    Nos missions en cours
                </h2>
            </div>


            <div class="row text-center">
                <div class="col-md-4 my-2 d-flex">
                    <div class="card" style="width: 18rem;">
                        <img src="" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?=$test ;?></h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 my-2 d-flex">
                    <div class="card" style="width: 18rem;">
                        <img src="" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?=$test2 ;?></h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 my-2 d-flex">
                    <div class="card" style="width: 18rem;">
                        <img src="" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?=$test3 ;?></h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>