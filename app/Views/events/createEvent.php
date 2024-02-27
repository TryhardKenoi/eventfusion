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

<div class="container mt-5">
  <h1>Přidejte event</h1>
  <form action="<?php echo base_url('/event/create'); ?>" method="post">
    <div class="mb-3">
      <label for="nazev" class="form-label">Název eventu<p class="d-inline" style="color: red;">*</p></label>
      <input type="name" required class="form-control" id="nazev_eventu" name="nazev_eventu">
    </div>
    <div class="mb-3">
      <label for="nazev" class="form-label">Popisek</label>

      <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
    </div>
    <div class="mb-3">
      <label for="rozgah_datum" class="form-label">Rozsah eventu<p class="d-inline" style="color: red;">*</p></label>
      <input type="text" required class="form-control" id="rozgah_datum" name="rozgah_datum" placeholder="Vyberte rozsah datumů">
    </div>
    <div>
      <label for="allDayCheckbox">Celý den: </label>
      <input type="checkbox" checked id="allDayCheckbox">
    </div>
    <div id="timeInputs" style="display: none;">
      <div class="">
        <label for="startTime">Začátek: </label>
        <input type="time" id="startTime" name="startTime">
      </div>
      <div class="">
        <label for="endTime">Konec: </label>
        <input type="time" id="endTime" name="endTime">
      </div>
    </div>

    <div class="d-flex">
      <div class="form-group w-100">
        <label for="exampleInputEmail1">Přidat lidi</label>
        <select class="form-control" id="users" name="users[]" multiple>
          <?php foreach ($people as $p) : ?>
            <option value="<?= $p->id ?>"><?= $p->first_name . ' ' . $p->last_name ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group w-100">
        <label for="exampleInputEmail1">Přidat skupiny</label>
        <select class="form-control" id="groups" name="groups[]" multiple>
          <?php foreach ($groups as $g) : ?>
            <option value="<?= $g->id ?>"><?= $g->name ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div>
      <label for="color">Vyberte barvu:</label>
      <input type="color" id="color" name="color" value="#0BA0E0">
    </div>
    <button type="submit" id="testing" class="btn btn-primary">Odeslat</button>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  flatpickr("#rozgah_datum", {
    enableTime: false,
    mode: "range",
    dateFormat: "Y-m-d",

  });

  function handleCheckboxChange(event) {
    var timeInputs = document.getElementById('timeInputs');
    var sTime = document.getElementById('startTime');
    var eTime = document.getElementById('endTime');

    if (!event.target.checked) {
      timeInputs.style.display = 'block';
      sTime.setAttribute('required', 'required');
      eTime.setAttribute('required', 'required');
    } else {
      timeInputs.style.display = 'none';
      sTime.removeAttribute('required');
      eTime.removeAttribute('required');
    }
  }

  var allDayCheckbox = document.getElementById('allDayCheckbox');
  allDayCheckbox.addEventListener('change', handleCheckboxChange);
</script>


<?= $this->endSection(); ?>