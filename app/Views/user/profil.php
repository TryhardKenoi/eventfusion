<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>


    <div class="text-center pt-3">
      <h1><b>Vítejte, <?= \App\Helpers\User::user()->first_name; ?></b></h1>
      <hr>
    </div>
    <div class="container">
      <div class="row">

        <div class="col-6">
          <h2><b>Údaje</b></h2>
          <p>Jméno: <?= \App\Helpers\User::user()->first_name; ?> <?= \App\Helpers\User::user()->last_name; ?></p>
          <p>Email: <?= \App\Helpers\User::user()->email; ?></p>
          <p>Firma: <?= \App\Helpers\User::user()->company; ?></p>

          <a class="btn btn-secondary" href="<?= base_url('profile/details/'. \App\Helpers\User::user()->id); ?>">Změnit údaje</a>
        </div>
        <div class="col-6">
          <h2><b>Skupiny</b></h2>
          <p>
            <?php foreach ($user_groups as $group) : ?>
              <a href="<?= base_url('/group/'.$group->id);?>"><?php echo $group->name; ?></a> <br>
            <?php endforeach; ?>
          </p>
          <a href="<?= base_url('/group/create'); ?>">
            <button type="button" class="btn btn-secondary" name="button">Nová skupina</button>
          </a>
        </div>
      </div>
    </div>

    <?= $this->endSection(); ?>