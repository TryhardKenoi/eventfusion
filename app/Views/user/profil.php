<!DOCTYPE html>
<html lang='en'>
  <head>
  <title>Kenoi's website</title>
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/custom.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <meta charset='utf-8' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.9/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <?= $this->include('layout/navbar') ?>

  </head>
  <body>
    <div class="text-center pt-3">
      <h1><b>Vítejte, <?= \App\Helpers\User::user()->first_name; ?></b></h1>
      <hr>
    </div>
    <div class="container">
      <div class="row">

        <div class="col-6">
          <h2><b>Údaje</b></h2>
          <p>Name: <?= \App\Helpers\User::user()->first_name; ?> <?= \App\Helpers\User::user()->last_name; ?></p>
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


  </body>
</html>
