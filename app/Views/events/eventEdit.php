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
  <h1><b>Editace eventu</b></h1>
  <hr>
</div>

<div id="owner">
  <div class="container" id="showForm">
    <form class="" action="<?= base_url('/event/edit/' . $event->id); ?>" method="post">
      <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left" style="color: black;" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Základní informace
              </button>
            </h2>
          </div>
          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              <div class="form-group">
                <label for="name">Název eventu</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $event->nazev_eventu; ?>">
              </div>
              <div class="form-group">
                <label for="start">Začátek eventu</label>
                <input type="<?= $inputType ?>" class="form-control" id="start" name="start" value="<?= $zValue; ?>">
              </div>
              <div class="form-group">
                <label for="end">Konec eventu</label>
                <input type="<?= $inputType ?>" class="form-control" id="end" name="end" value="<?= $kValue; ?>">
              </div>
              <div>
                <label for="allDayCheckbox">Celý den: </label>
                <input type="checkbox" <?= $checked ?> id="allDayCheckbox">
              </div>
              <div>
                <label for="description">Popisek</label>
                <input type="text" class="form-control" id="description" name="description" value="<?= $event->description; ?>">
              </div>
              <div>
                <label for="color">Barva</label>
                <input type="color" id="color" name="color" value="<?= $event->color; ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left collapsed" style="color: black;" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Zúčastnění uživatelé
              </button>
            </h2>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
              <h1 class="text-center">Uživatelé</h1>
              <table class="table">
                <thead class="thead-dark">
                  <tr>

                    <th scope="col">Název</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $u) : ?>
                    <tr>

                      <td><?= $u->first_name . ' ' . $u->last_name ?></td>
                      <td class="d-flex mx-1">
                        <a href="<?= base_url('event/edit/user/remove' . '/' . $u->id . '/' . $event->id) ?>" class="btn btn-danger remove">Odebrat</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

              <div class="form-group w-100">
                <label for="exampleInputEmail1">Přidat lidi</label>
                <select class="form-control" id="users" name="users[]" multiple id="selectUsersEvent">
                  <?php foreach ($people as $p) : ?>
                    <option value="<?= $p->id ?>"><?= $p->first_name . ' ' . $p->last_name ?></option>
                  <?php endforeach; ?>
                </select>

              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header" id="headingThree">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left collapsed" style="color: black;" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Zúčastněné skupiny
              </button>
            </h2>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
              <h1 class="text-center">Skupiny</h1>
              <table class="table">
                <thead class="thead-dark">
                  <tr>

                    <th scope="col">Název</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($groups as $g) : ?>
                    <tr>

                      <td><?= $g->name ?></td>
                      <td class="d-flex mx-1">
                        <a href="<?= base_url('event/edit/group/remove' . '/' . $g->id . '/' . $event->id) ?>" class="btn btn-danger remove">Odebrat</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

              <div class="form-group w-100">
                <label for="exampleInputEmail1">Přidat skupiny</label>
                <select class="form-control" id="groups" name="groups[]" multiple>
                  <?php foreach ($org as $g) : ?>
                    <option value="<?= $g->id ?>"><?= $g->name ?></option>
                  <?php endforeach; ?>
                </select>

              </div>
            </div>
          </div>
        </div>
        <div class="pt-4">
          <h3>Lokace události</h3>
          <label for="location">Souřadnice</label>
          <input type="text" name="latitute" value="<?= $event->latitute; ?>" id="latitute" readonly />
          <input type="text" name="longtitute" value="<?= $event->longtitute; ?>" id="longtitute" readonly />
          <div id="map" style="height: 400px;"></div>
        </div>

        <script>
          var la = <?= json_encode($event->latitute) ?>;
          var lo = <?= json_encode($event->longtitute) ?>;
          window.addEventListener('load', function() {
            if (la != null && lo != null) {
              var map = L.map('map').setView([la, lo], 9);
            } else {
              var map = L.map('map').setView([50, 15], 7);
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

            map.on('click', function(e) {
              var latlng = e.latlng;

              if (marker) {
                map.removeLayer(marker);
              }
              marker = L.marker(latlng).addTo(map);
              latitute.value = latlng.lat;
              longtitute.value = latlng.lng;
            });
          });
        </script>



        <?php if ($event->creator_id == \App\Helpers\User::user()->id) : ?>
          <div class="pt-3">
            <button type="submit" id="submitButton" class="btn btn-primary" name="button">Uložit změny</button>
          </div>
        <?php endif; ?>
    </form>
    <form method="post" action="<?= base_url('event/delete/' . $event->id); ?>" class="mt-4">
      <?php if ($event->creator_id == \App\Helpers\User::user()->id) : ?>
        <button type="submit" id="submitButton" class="btn btn-danger" name="button">Smazat event</button>
      <?php endif; ?>
    </form>
  </div>
</div>

<?php
$curentUserID = \App\Helpers\User::user()->id;
?>

<script src="<?= base_url('assets/js/leaflat.js'); ?>"></script>

<!-- DualListbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-duallistbox/4.0.1/jquery.bootstrap-duallistbox.min.js"></script>
<script src="<?= base_url('assets/js/duallistbox.cs.js'); ?>"></script>

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


  var allDayCheckbox = document.getElementById('allDayCheckbox');
  allDayCheckbox.addEventListener('change', handleCheckboxChange);

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