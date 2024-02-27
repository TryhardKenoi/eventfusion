<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="text-center pt-3">
  <h1><b>Upravit uživatelské údaje</b></h1>
  <hr>
</div>


<div class="container">
  <div class="" id="showForm">
      <form class="" id="editForm" action="<?= base_url('profile/details/change/'. $user->id); ?>" method="post">
          <div class="form-group">
              <label for="end">Jméno<p class="d-inline" style="color: red;">*</p></label>
              <input type="text" class="form-control" id="first_name" name="first_name" required value="<?= $user->first_name ?>">
          </div>
          <div class="form-group">
              <label for="end">Příjmení<p class="d-inline" style="color: red;">*</p></label>
              <input type="text" class="form-control" id="last_name" name="last_name" required value="<?= $user->last_name ?>">
          </div>
          <div class="form-group">
              <label for="end">Společnost</label>
              <input type="text" class="form-control" id="company" name="company" value="<?= $user->company ?>">
          </div>
          <div class="form-group">
              <label for="end">Telefon</label>
              <input type="phone" class="form-control" id="phone" name="phone" value="<?= $user->phone ?>">
          </div>

          <h4 class="pt-2">Heslo</h4>
          <div class="form-group">
          <label for="end">Stávající heslo</label>
          <input type="password" class="form-control" id="old-password" name="old-password" value="">
        </div>
        <div class="form-group">
          <label for="end">Nové heslo</label>
          <input type="password" class="form-control" id="password" name="password" value="">
        </div> 
        <div class="form-group">
          <label for="end">Nové heslo znovu</label>
          <input type="password" class="form-control" id="password-again" name="password-again" value="">
        </div>
        <p id="message"></p>
        <button type="submit" id="submitButton" class="btn btn-secondary" name="button">Odeslat</button>
    </form>
  </div>
</div>


<?= $this->endSection(); ?>