<section class="py-5">
    <div class="container px-5 mb-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Gérer les utilisateurs</span></h1>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Inscrit le</th>
                    <th scope="col">Actif</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u) : ?>
                    <tr>
                        <th scope="row"><?= $u->getId_utilisateur() ?></th>
                        <td><?= $u->getPrenom() ?></td>
                        <td><?= $u->getEmail() ?></td>
                        <td><?= $u->getRole() ?></td>
                        <td><?= date('d/m/Y', strtotime($u->getCreated_at()))  ?></td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault data-id="<?= $u->getId_utilisateur() ?>">
                                <label class="form-check-label" for="flexSwitchCheckDefault<?= $u->getId_utilisateur() ?>"></label>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


    </div>
</section>