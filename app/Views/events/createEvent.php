<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
  <h1>Přidejte event</h1>
  <form action="<?php echo base_url('/event/create'); ?>" method="post">
    <div class="mb-3">
      <label for="nazev" class="form-label">Název eventu</label>
      <input type="name" class="form-control" id="nazev_eventu" name="nazev_eventu">
    </div>
    <div class="mb-3">
      <label for="rozgah_datum" class="form-label">Rozsah eventu</label>
      <input type="text" class="form-control" id="rozgah_datum" name="rozgah_datum" placeholder="Vyberte rozsah datumů">
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
              <option value="<?= $g->id ?>"><?= $g->name?></option>
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

    if (!event.target.checked) {
      timeInputs.style.display = 'block';
    } else {
      timeInputs.style.display = 'none';
    }
  }

  var allDayCheckbox = document.getElementById('allDayCheckbox');
  allDayCheckbox.addEventListener('change', handleCheckboxChange);
</script>


<?= $this->endSection(); ?>