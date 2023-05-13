<section class="py-5">
    <div class="container px-5">
        <!-- Contact form-->
        <div class="bg-light rounded-4 py-5 px-4 px-md-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 mb-3"><i class="bi bi-person-circle"></i></div>
                <h1 class="fw-bolder"><?= $user->getPrenom() ?></h1>

            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <p class="lead fw-normal text-muted my-4">Adresse mail : <?= $user->getEmail() ?></p>
                    <p class="lead fw-normal text-muted my-4">Inscrit depuis le : <?= $user->getCreatedAt() ?></p>
                    <a href="/utilisateurs/modifier" class="btn btn-primary w-100 mt-3">Modifier mon compte</a>
                </div>
            </div>
        </div>
    </div>
</section>
