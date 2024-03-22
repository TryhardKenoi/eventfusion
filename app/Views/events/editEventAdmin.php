<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="text-center pt-3">
  <h1><b>Event</b></h1>
  <hr>
</div>

<div class="container" id="showForm">
  <form class="" action="<?= base_url('/admin/event/edit/' . $event->id); ?>" method="post">
    <div class="form-group">
      <label for="name">Název eventu<p class="d-inline" style="color: red;">*</p></label>
      <input type="text" class="form-control" id="name" required name="name" value="<?= $event->nazev_eventu; ?>">
    </div>
    <div class="form-group">
      <label for="start">Začátek eventu<p class="d-inline" style="color: red;">*</p></label>
      <input type="datetime-local" class="form-control" required id="start" name="start" value="<?= $event->zacatek_eventu; ?>">
    </div>
    <div class="form-group">
      <label for="end">Konec eventu<p class="d-inline" style="color: red;">*</p></label>
      <input type="datetime-local" class="form-control" required id="end" name="end" value="<?= $event->konec_eventu; ?>">
    </div>
    <div>
      <label for="description">Popisek</label>
      <input type="text" class="form-control" id="description" name="description" value="<?= $event->description; ?>">
    </div>
    <div>
      <label for="color">Barva</label>
      <input type="color" id="color" name="color" value="<?= $event->color; ?>">
    </div>

<h1 class="text-center pt-3">Uživatelé</h1>
  <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Název</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $u) : ?>
              <tr>
                <td><?= $u->id ?></td>
                <td><?= $u->first_name . ' ' . $u->last_name ?></td>
                <td class="d-flex mx-1">
                  <a href="<?= base_url('admin/event/edit/user/remove' . '/' . $u->id . '/' . $event->id) ?>" class="btn btn-danger remove">Odebrat</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <div class="form-group w-100">
          <label for="exampleInputEmail1">Přidat lidi</label>
          <select class="form-control" id="users" name="users[]" multiple>
            <?php foreach ($people as $p) : ?>
              <option value="<?= $p->id ?>"><?= $p->first_name . ' ' . $p->last_name ?></option>
            <?php endforeach; ?>
          </select>
        </div>

<h1 class="text-center pt-3">Skupiny</h1>
<table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Název</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($groups as $g) : ?>
              <tr>
                <td><?= $g->id ?></td>
                <td><?= $g->name ?></td>
                <td class="d-flex mx-1">
                  <a href="<?= base_url('admin/event/edit/group/remove' . '/' . $g->id . '/' . $event->id) ?>" class="btn btn-danger remove">Odebrat</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <div class="form-group w-100">
          <label for="exampleInputEmail1">Přidat skupiny</label>
          <select class="form-control" id="groups" name="groups[]" multiple>
            <?php foreach ($roles as $g) : ?>
              <option value="<?= $g->id ?>"><?= $g->name ?></option>
            <?php endforeach; ?>
          </select>
        </div>

    <div class="pt-5 pb-5">
      <h1 class="text-center">Místo konání</h1>
      <label for="location">Souřadnice</label>
      <input type="text" name="latitute" value="<?= $event->latitute; ?>" id="latitute" readonly />
      <input type="text" name="longtitute" value="<?= $event->longtitute; ?>" id="longtitute" readonly />
      <div id="map" style="height: 400px;"></div>

      <script>
        var la = <?= json_encode($event->latitute) ?>;
        var lo = <?= json_encode($event->longtitute) ?>;
        document.addEventListener('DOMContentLoaded', function() {
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
    </div>
    <button type="submit" id="submitButton" class="btn btn-primary mb-5" name="button">Uložit změny</button>
</div>

<?= $this->endSection(); ?>