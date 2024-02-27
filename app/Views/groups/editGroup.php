<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>


<form method="post" action="<?= base_url("/admin/group/user/add/".$group->id)?>">
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
    <div class="col-12">
      <h1>Seznam clenu skupiny</h1>
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
          <?php foreach($users as $p): ?>
            <tr>
              <td><?= $p->id ?></td>
              <td><?= $p->first_name ?></td>
              <td><?= $p->last_name ?></td>
              <td><a class="btn btn-danger" href="<?= base_url('/admin/group/user/remove/' .$group->id ."/".$p->id ) ?>">Odebrat</a></td>
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


<?php $this->endSection(); ?>
