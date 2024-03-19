<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="container">
    <h1 class="my-4 text-center">Nastaveni webu</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
      <div class="card">
        <div class="card-body">
            <h5 class="card-title">Název webu</h5>
            <form action="<?= base_url("/settings"); ?>" method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" id="site_name" name="site_name"
                        value="<?= $settings['site_name'] ?? ""; ?>"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">Uložit</button>
            </form>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Logo webu</h5>

          <a href="#" class="btn btn-primary">Uložit</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Nastaveni 3</h5>
          <p class="card-text">Lorem, ipsum dolor.</p>
          <a href="#" class="btn btn-primary">Uložit</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?=  $this->endSection(); ?>