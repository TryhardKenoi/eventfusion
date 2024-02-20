<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="text-center pt-3">
  <h1><b>Úpravit uživatele</b></h1>
  <hr>
</div>

<div class="container">
  <div class="" id="showForm">
      <form class="" id="editForm" action="<?= base_url('admin/user/edit/'. $user->id); ?>" method="post">
        <div class="form-group">
          <label for="name">Jméno</label>
          <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $user->first_name; ?> ">
        </div>
        <div class="form-group">
          <label for="start">Příjmení</label>
          <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $user->last_name; ?> ">
        </div>
        <div class="form-group">
          <label for="end">Nové heslo</label>
          <input type="password" class="form-control" id="password" name="password" value="">
        </div> 
        <div class="form-group">
          <label for="end">Nové heslo znovu</label>
          <input type="password" class="form-control" id="password-again" name="password-again" value="">
        </div>
        <div class="form-group">
          <label for="start">Telefonní číslo</label>
          <input type="phone" class="form-control" id="phone" name="phone" value="<?= $user->phone; ?> ">
        </div>
        <div class="form-group">
          <label for="start">Firma</label>
          <input type="text" class="form-control" id="company" name="company" value="<?= $user->company; ?> ">
        </div>
        
        <button type="submit" id="submitButton" class="btn btn-secondary" name="button">Odeslat</button>
    </form>
  </div>
</div>


<?= $this->endSection(); ?>