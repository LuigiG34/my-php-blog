<section class="py-5">
    <div class="container px-5 mb-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Gérer les articles</span></h1>
            <a href="/articles/add" class="btn btn-primary my-100 mt-5">Ajouter un article</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Chapô</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($articles as $a) : ?>
                    <tr>
                        <th scope="row"><?= $a->getId_article() ?></th>
                        <td>
                            <img src="/uploads/<?= $a->getImg() ?>" alt="" width="45px">
                        </td>
                        <td><?= $a->getTitre() ?></td>
                        <td><?= substr($a->getChapo(), 0, 124) ?>...</td>
                        <td><?= $a->getCategorie() ?></td>
                        <td><?= $a->getAuteur() ?></td>
                        <td><?= date('d/m/Y', strtotime($a->getCreated_at())) ?></td>
                        <td>
                            <a class="btn btn-warning w-100 mb-1" href="/articles/update/<?= $a->getId_article() ?>">Modifier</a>
                            <a class="btn btn-danger w-100 mt-1" href="/articles/delete/<?= $a->getId_article() ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>


    </div>
</section>