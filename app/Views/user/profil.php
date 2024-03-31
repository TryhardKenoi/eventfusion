<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="text-center pt-3">
  <h1><b>Vítejte, <?= \App\Helpers\User::user()->first_name; ?></b></h1>
  <hr>
</div>

<div class="container">
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?= base_url('assets/images/avatar.jpg') ?>" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?= \App\Helpers\User::user()->first_name; ?> <?= \App\Helpers\User::user()->last_name; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center text-center flex-wrap">
                    <h5>Skupiny</h5>
                  </li>
                  <?php foreach ($user_groups as $group) : ?>
                    <a href="<?= base_url('/group/'.$group->id);?>">
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap black">
                      <p class="mb-0 black"><?= $group->name ?></p>
                      <span class="text-secondary"><?= $group->description; ?></span>
                    </li>
                    </a>
                  <?php endforeach; ?>
                </ul>
                <div class="col-sm-12 pt-2 pb-2">
                      <a class="btn btn-info " target="" href="<?= base_url('group/create'); ?>">Vytvořit</a>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Jméno</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= \App\Helpers\User::user()->first_name . ' '?> <?= \App\Helpers\User::user()->last_name ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= \App\Helpers\User::user()->email; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Telefon</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= \App\Helpers\User::user()->phone; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Společnost</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= \App\Helpers\User::user()->company; ?>
                    </div>
                  </div>
                  <hr>
                    <div class="col-sm-12">
                      <a class="btn btn-info " target="" href="<?= base_url('profile/details/'. \App\Helpers\User::user()->id); ?>">Upravit</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
    </div>

    <?= $this->endSection(); ?>