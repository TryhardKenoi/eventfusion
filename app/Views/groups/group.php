<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<form method="post" action="<?= base_url("/group/addUser/".$group->id)?>">

    <div class="text-center">
      <div class="text-center pt-3">
        <h1>Skupina</h1>
        <hr>
      </div>
        <div id="default">
        <p>Název: <?= $group->name; ?></p>
        <p>Popisek: <?= $group->description; ?></p>
        </div>
    </div>

    <div class="container" style="display:none;" id="edit">
        <div class="form-group">
          <label for="name">Název skupiny</label>
          <input type="text" class="form-control" id="name" name="name" value="<?= $group->name; ?> ">
        </div>
        <div class="form-group">
          <label for="name">Popisek skupiny</label>
          <input type="text" class="form-control" id="description" name="description" value="<?= $group->description; ?> ">
        </div>
    </div>

<div class="container">
     <?php if(\App\Helpers\User::user()->id == $group->owner_id): ?>
          <button type="button" class="btn btn-primary" id="editButton">Upravit</button>
     <?php endif; ?>


   <div class="row">
    <div class="col-12">
      <h1>Seznam clenu skupiny</h1>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Jmeno</th>
            <th scope="col">Přímení</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($users as $p): ?>
            <tr>
              <td><?= $p->id ?></td>
              <td><?= $p->first_name ?></td>
              <td><?= $p->last_name ?></td>
              <td class="d-flex">
              <?php if($p->id == $group->owner_id): ?>
                  <h4 class="mr-2"><span class="badge badge-danger">Majitel</span></h4>
                <?php endif; ?>
                <?php if(\App\Helpers\User::user()->id == $group->owner_id): ?>
                  <?php if($p->id !== $group->owner_id): ?>
                  <a class="btn btn-danger" href="<?= base_url('/group/user/remove/' .$group->id ."/".$p->id ) ?>">Odebrat</a>
                  <?php endif; ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="col-12">
      <?php if(count($people) != 0): ?>

        <div class="form-group">
          <label for="exampleInputEmail1">Přidat lidi</label>
          <select class="form-control" id="users" name="users[]" multiple>
            <?php foreach($people as $p): ?>
              <option value="<?= $p->id ?>"><?= $p->first_name .' ' . $p->last_name ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <?php endif; ?>
    </div>
  </div>
</div>

<script
  <script>
        const div1 = document.getElementById('default');
        const div2 = document.getElementById('edit');
        const toggleButton = document.getElementById('editButton');

        toggleButton.addEventListener('click', () => {
            div1.style.display = 'none';
            // Zobrazí druhý div
            div2.style.display = 'block';
            // Skryje tlačítko
            toggleButton.style.display = 'none';
        });
    </script>

</script>

<?php $this->endSection(); ?>
