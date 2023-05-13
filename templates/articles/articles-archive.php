<!-- Projects Section-->
<section class="py-5">
    <div class="container px-5 mb-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Projects</span></h1>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-11 col-xl-9 col-xxl-8">

                <?php foreach ($articles as $article) : ?>

                    <div class="card overflow-hidden shadow rounded-4 border-0 mb-5">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center">
                                <div class="p-5">
                                    <small><?= date('d/m/Y', strtotime($article->getCreatedAt())) ?></small>
                                    <h2 class="fw-bolder"><?= $article->getTitre() ?></h2>
                                    <small>Auteur : <?= $article->getAuteur() ?></small>
                                    <p><?= substr($article->getChapo(), 0, 124) ?>...</p>
                                    <a href="/articles/unique/<?= $article->getSlug() ?>" class="btn btn-primary">Lire la suite</a>
                                </div>
                                <img class="img-fluid" src="/uploads/<?= $article->getImg() ?>" alt="..." />
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!-- Call to action section-->
<section class="py-5 bg-gradient-primary-to-secondary text-white">
    <div class="container px-5 my-5">
        <div class="text-center">
            <h2 class="display-4 fw-bolder mb-4">Vous avez des questions ?</h2>
            <a class="btn btn-outline-light btn-lg px-5 py-3 fs-6 fw-bolder" href="/contact">Contactez moi</a>
        </div>
    </div>
</section>
