<?php
$zacatek = $event->zacatek_eventu;
$konec = $event->konec_eventu;

$z = new DateTime($zacatek);
$k = new DateTime($konec);

$zDate = $z->format('Y-m-d');
$kDate = $k->format('Y-m-d');

$zDatetime = $z->format('Y-m-d H:i:s');
$kDatetime = $k->format('Y-m-d H:i:s');

if (str_contains($zacatek, '00:00:00') && str_contains($konec, '00:00:00')) {
  $inputType = 'date';
  $checked = 'checked';
  $zValue = $zDate;
  $kValue = $kDate;
} else {
  $inputType = 'datetime-local';
  $checked = '';
  $zValue = $zDatetime;
  $kValue = $kDatetime;
}
?>

<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="text-center pt-3">
  <h1><b>Event</b></h1>
  <hr>

</div>



<div id="user">
  <div class="container">
    <h2>Základní informace</h2>
    <div class="form-group">
      <label for="name">Název eventu</label>
      <input type="text" class="form-control" disabled id="name" name="name" value="<?= $event->nazev_eventu; ?> ">
    </div>
    <div class="form-group">
      <label for="start">Začátek eventu</label>
      <input type="<?= $inputType ?>" class="form-control" disabled id="start" name="start" value="<?= $zValue; ?>">
    </div>
    <div class="form-group">
      <label for="end">Konec eventu</label>
      <input type="<?= $inputType ?>" class="form-control" disabled id="end" name="end" value="<?= $kValue; ?>">
    </div>
    <div>
      <label for="description">Popisek</label>
      <input type="text" class="form-control" disabled id="description" name="description" value="<?= $event->description; ?>">
    </div>
    <div>
      <label for="color">Barva</label;>
        <input type="color" id="color" name="color" disabled value="<?= $event->color; ?>">
    </div>

    <h2 class="mt-5">Zúčastnění uživatelé</h2>
    <table class="table ">
      <thead class="thead-dark">
        <tr>

          <th scope="col">Jméno</th>
          <th>Příjmení</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u) : ?>
          <tr>
            <td><?= $u->first_name ?></td>
            <td><?= $u->last_name ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <h2 class="mt-5">Zúčastněné skupiny</h2>
    <table class="table">
      <thead class="thead-dark">
        <tr>

          <th scope="col">Název</th>
          <th>Popisek</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($groups as $g) : ?>
          <tr>
            <td><?= $g->name ?></td>
            <td><?= $g->description ?></td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <h2 class="mt-5">Místo konání</h2>
    <div class="pb-5">
      <label for="location">Lokace</label>
      <input type="text" name="latitute" value="<?= $event->latitute; ?>" id="latitute" readonly />
      <input type="text" name="longtitute" value="<?= $event->longtitute; ?>" id="longtitute" readonly />
      <div id="map2" style="height: 400px;"></div>
      <script>
        var la = <?= json_encode($event->latitute) ?>;
        var lo = <?= json_encode($event->longtitute) ?>;
        document.addEventListener('DOMContentLoaded', function() {
          if (la != null && lo != null) {
            var map = L.map('map2').setView([la, lo], 9);
          } else {
            var map = L.map('map2').setView([50, 15], 7);
          }
          var marker;


          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
          }).addTo(map);

          if (la != null && lo != null) {
            marker = L.marker([la, lo]).addTo(map);
          }
          var latitute = document.getElementById('latitute');
          var longtitute = document.getElementById('longtitute');
        });
      </script>
    </div>
    <?php if(\App\Helpers\User::user()->id == $event->creator_id): ?>
    <a class="btn btn-primary mb-5" href="<?= base_url('event/edit/' .$event->id); ?>">Upravit</a>
    <?php endif; ?>
  </div>
</div>


<?php
$curentUserID = \App\Helpers\User::user()->id;
?>

<script>
  const currentUserId = '<?= $curentUserID ?>';
  const eventId = '<?= $event->creator_id; ?>';
  const isOwner = (currentUserId == eventId);

  if (isOwner) {
    document.getElementById('owner').style.display = 'block';
    document.getElementById('user').style.display = 'none';
  } else {
    document.getElementById('owner').style.display = 'none';
    document.getElementById('user').style.display = 'block';
  }


  function handleCheckboxChange(event) {
    var timeInputs = document.getElementById('timeInputs');
    var start = document.getElementById('start');
    var end = document.getElementById('end');

    if (!event.target.checked) {
      start.setAttribute('type', 'datetime-local');
      end.setAttribute('type', 'datetime-local');

      start.setAttribute('value', '<?= $zDatetime; ?>');
      end.setAttribute('value', '<?= $kDatetime; ?>');

    } else {
      start.setAttribute('type', 'date');
      end.setAttribute('type', 'date');

      start.setAttribute('value', '<?= $zDate; ?>');
      end.setAttribute('value', '<?= $kDate; ?>');
    }
  }



</script>

<?= $this->endSection(); ?>