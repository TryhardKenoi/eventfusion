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
      <label for="rozgah_datum" class="form-label">Datum konání<p class="d-inline" style="color: red;">*</p></label>
      <input type="text" required class="form-control" id="rozgah_datum" name="rozgah_datum" placeholder="Vyberte začátek a konec události">
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

    <div class="d-flex align-items-center mt-4">
      <label class="mr-2 mt-2" for="repeat">Opakovat</label>
      <select class="form-control flex-grow-1" id="repeat" name="repeat">
        <option value="none">Nikdy</option>
        <option value="day">Každý den</option>
        <option value="week">Každý týden</option>
        <option value="2weeks">Každé dva týdny</option>
        <option value="month">Každý měsíc</option>
        <option value="year">Každý rok</option>
      </select>
    </div>
    <div class="align-items-center mt-2" style="display:none;" id="multiplierContainer">
      <label class="mr-2 mt-2 d-inline-block" for="multiplier">Množství opakování</label>
      <input type="number" id="multiplier" name="multiplier" class="form-control flex-grow-1 d-inline-block" min="2" max="20">
    </div>


    <div class="pt-5">
      <div class="form-group w-100">
        <label for="exampleInputEmail1">
          <h5>Přidat lidi</h5>
        </label>
        <select class="form-control" id="users" name="users[]" multiple>
          <?php foreach ($people as $p) : ?>
            <option value="<?= $p->id ?>"><?= $p->first_name . ' ' . $p->last_name ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="pt-5">
      <div class="form-group w-100">
        <label for="exampleInputEmail1">
          <h5>Přidat skupiny</h5>
        </label>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-duallistbox/4.0.1/jquery.bootstrap-duallistbox.min.js"></script>
<script src="<?= base_url('assets/js/duallistbox.cs.js'); ?>"></script>
<script src="<?= base_url('assets/js/flatpickr.cs.js') ?>"></script>
<script>
  flatpickr("#rozgah_datum", {
    enableTime: false,
    mode: "range",
    dateFormat: "Y-m-d",
    locale:'cs'
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

<script>
  document.getElementById('repeat').addEventListener('change', function() {
    var multiplierContainer = document.getElementById('multiplierContainer');
    var multiplierInput = document.getElementById('multiplier');
    if (this.value === 'none') {
      multiplierContainer.style.display = 'none';
      multiplierInput.value = ''; // Clear the value if hidden
      multiplierInput.removeAttribute('required');
    } else {
      multiplierContainer.style.display = 'flex';
      multiplierInput.setAttribute('required', 'required');
    }
  });
</script>

<?= $this->endSection(); ?>