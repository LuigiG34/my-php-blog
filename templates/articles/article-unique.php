<section class="py-5">
    <div class="container px-5 mb-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline"><?= $article->getTitre() ?></span></h1>
            <p class="lead fw-light mb-4"><?= $article->getCategorie() ?></p>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-11 col-xl-9 col-xxl-8">


                <div class="d-flex align-items-center">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <img class="img-fluid" src="/uploads/<?= $article->getImg() ?>" alt="..." />
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <small><?= date('d/m/Y', strtotime($article->getCreatedAt())) ?></small>
                            <p class="pt-3"><?= $article->getChapo() ?></p>
                            <small>Auteur : <?= $article->getAuteur() ?></small>
                        </div>

                    </div>
                </div>
                <p class="my-5"><?= $article->getContenu() ?></p>


                <?php if (isset($form)) : ?>
                    <?= $form ?>
                <?php endif; ?>

                <div class="my-5">
                    <?php if (isset($commentaires) && !empty($commentaires)) : ?>
                        <?php foreach ($commentaires as $c) : ?>
                            <div class="py-3">
                                <hr>
                                <small><?= $c->getAuteur() ?> | <?= $c->getCreatedAt() ?></small>
                                <p><?= $c->getContenu() ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Pas de commentaires.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
