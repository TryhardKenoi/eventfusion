<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<?php if (session()->has('errors')) : ?>
  <div class="container pt-3">
    <div class="alert alert-danger">
      <ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <?php foreach (session('errors') as $error) : ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
<?php endif; ?>

<div class="text-center pt-3">
  <h1><b>Nový uživatel</b></h1>
  <hr>
</div>

<div class="container">
  <div class="" id="showForm">
    <form class="" id="editForm" action="<?= base_url('admin/register') ?>" method="post">
      <div class="form-group">
        <label for="name">Jméno</label>
        <input type="text" class="form-control" id="first_name" name="first_name">
      </div>
      <div class="form-group">
        <label for="start">Příjmení</label>
        <input type="text" class="form-control" id="last_name" name="last_name">
      </div>
      <div class="form-group">
        <label for="start">Email</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="end">Heslo</label>
        <input type="password" class="form-control" id="password" name="password" value="">
      </div>
      <div class="form-group">
        <label for="end">Heslo znovu</label>
        <input type="password" class="form-control" id="password-again" name="password-again" value="">
      </div>
      <button type="submit" id="submitButton" class="btn btn-secondary" name="button">Odeslat</button>
    </form>
  </div>
</div>


<?= $this->endSection(); ?>