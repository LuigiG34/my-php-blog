<section class="py-5">
  <div class="container px-5 mb-5">
    <div class="text-center mb-5">
      <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Gérer les commentaires</span></h1>
      <p class="lead fw-light mb-4" </p>
    </div>


    <div class="overflow-auto" style="height: 600px">

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Contenu</th>
            <th scope="col">Auteur</th>
            <th scope="col">Article</th>
            <th scope="col">Statut</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($comments as $c) : ?>
            <tr>
              <th scope="row"><?= $c->getIdCommentaire() ?></th>
              <td><?= $c->getContenu() ?></td>
              <td><?= $c->getAuteur() ?></td>
              <td><?= $c->getArticle() ?></td>
              <td>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault<?= $c->getIdCommentaire() ?>" <?= $c->getIdStatutCommentaire() == 1 ? 'checked' : '' ?> data-id="<?= $c->getIdCommentaire() ?>">
                  <label class="form-check-label" for="flexSwitchCheckDefault<?= $c->getIdCommentaire() ?>"></label>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
</section>

<script src="/assets/typescript/ajax.ts"></script>