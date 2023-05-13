<section class="py-5">
    <div class="container px-5">
        <!-- Contact form-->
        <div class="bg-light rounded-4 py-5 px-4 px-md-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 mb-3"><i class="bi bi-trash3-fill"></i></div>
                <h1 class="fw-bolder">Supprimer un article</h1>
                <p class="lead fw-normal text-muted mb-0">Êtes-vous sûr de vouloir supprimer cette article ?</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <?= $form ?>

                    <div id='error-form' class='mt-3'></div>
                </div>
            </div>
        </div>
    </div>
</section>
