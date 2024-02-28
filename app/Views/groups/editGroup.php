<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>


<form method="post" action="<?= base_url("/admin/group/user/add/" . $group->id) ?>">
  <div class="text-center">
    <div class="text-center pt-3">
      <h1>Skupina</h1>
      <hr>
    </div>
  </div>

  <div class="container">
    <div class="form-group">
      <label for="name">Název skupiny<p class="d-inline" style="color: red;">*</p></label>
      <input type="text" class="form-control" id="name" required name="name" value="<?= $group->name; ?>">
    </div>
    <div class="form-group">
      <label for="name">Popisek skupiny</label>
      <input type="text" class="form-control" id="description" name="description" value="<?= $group->description; ?>">
    </div>
  </div>


  <div class="container">
    <div class="row">
      <div class="col-12 pt-4">
        <h3>Seznam členů skupiny</h3>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Jmeno</th>
              <th scope="col">Přímení</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $p) : ?>
              <tr>
                <td><?= $p->id ?></td>
                <td><?= $p->first_name ?></td>
                <td><?= $p->last_name ?></td>
                <td><a class="btn btn-danger" href="<?= base_url('/admin/group/user/remove/' . $group->id . "/" . $p->id) ?>">Odebrat</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="col-12 pt-4">
        <?php if (count($people) != 0) : ?>
          <div class="form-group w-100">
            <label for="exampleInputEmail1"><h3>Přidat lidi</h3></label>
            <select class="form-control" id="users" name="users[]" multiple id="selectUsersEvent" data-lang="cs">
              <?php foreach ($people as $p) : ?>
                <option value="<?= $p->id ?>"><?= $p->first_name . ' ' . $p->last_name ?></option>
              <?php endforeach; ?>
            </select>
          </div>
      </div>

  <div class="pt-4">
    <button type="submit" class="btn btn-primary">Odeslat</button>
  </div>
      
</form>
<?php endif; ?>
</div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-duallistbox/4.0.1/jquery.bootstrap-duallistbox.min.js"></script>
<script>
  $(document).ready(function() {
    $('#users').bootstrapDualListbox({
      nonSelectedListLabel: 'Nezvolené',  // Text pro nezvolené položky
      selectedListLabel: 'Zvolené',  // Text pro zvolené položky
      preserveSelectionOnMove: 'přesunuté',  // Zachování výběru při přesunu
      moveOnSelect: false,  // Přesunout při výběru
      filterTextClear: 'zobrazit vše',  // Text pro tlačítko "Zobrazit vše"
      filterPlaceHolder: 'Filtr',  // Placeholder pro filtr
      moveSelectedLabel: 'Přesunout zvolené',  // Text pro tlačítko "Přesunout zvolené"
      moveAllLabel: 'Přesunout vše',  // Text pro tlačítko "Přesunout vše"
      removeSelectedLabel: 'Odebrat zvolené',  // Text pro tlačítko "Odebrat zvolené"
      removeAllLabel: 'Odebrat vše',  // Text pro tlačítko "Odebrat vše"
      infoText: 'Zobrazuje všechny {0}',  // Text pro "Showing all {0}"
      infoTextEmpty: 'Prázdný seznam'  // Text pro prázdný seznam
      
    });
  });
  
</script>

<?php $this->endSection(); ?>