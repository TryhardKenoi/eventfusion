<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="text-center pt-3">
  <h1><b>Event</b></h1>
  <hr>
</div>

<div class="container" id="showForm">
    <form class="" action="<?= base_url('/event/edit/'.$event->id); ?>" method="post">
      <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Základní informace
              </button>
            </h2>
          </div>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="form-group">
                  <label for="name">Název eventu</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?= $event->nazev_eventu; ?> ">
                </div>
                <div class="form-group">
                  <label for="start">Začátek eventu</label>
                  <input type="text" class="form-control" id="start" name="start" value="<?= $event->zacatek_eventu; ?> ">
                </div>
                <div class="form-group">
                  <label for="end">Konec eventu</label>
                  <input type="text" class="form-control" id="end" name="end" value="<?= $event->konec_eventu; ?> ">
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
              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Uživatelé a skupiny
              </button>
            </h2>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
              <div class="row">
              <div class="col-md-6 col-12">
                  <h1 class="text-center">Uživatelé</h1>
                  <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        
                        <th scope="col">Název</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $u): ?>
                            <tr>
                                                    
                                <td><?= $u->first_name.' '.$u->last_name ?></td>
                                <td class="d-flex mx-1">
                                    <a href="<?= base_url('event/edit/user/remove'. '/' .$u->id . '/' .$event->id) ?>" class="btn btn-danger remove">Odebrat</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6 col-12">
                  <h1 class="text-center">Skupiny</h1>
                  <table class="table">
                      <thead class="thead-dark">
                      <tr>
                          <th scope="col">Název</th>
                          <th></th>
                      </tr>
                      </thead>
                      <tbody>
                          <?php foreach($groups as $g): ?>
                              <tr>
                                                      
                                  <td><?= $g->name ?></td>
                                  <td class="d-flex mx-1">
                                      <a href="<?= base_url('event/edit/group/remove'. '/' .$g  ->id . '/' .$event->id) ?>" class="btn btn-danger remove">Odebrat</a>
                                  </td>
                              </tr>
                          <?php endforeach; ?>
                      </tbody>
                    </table>            
                </div>
            </div>

            <div class="row">
              <div class="col-md-6 col-12">
                <div class="form-group w-100">
                  <label for="exampleInputEmail1">Přidat lidi</label>
                  <select class="form-control" id="users" name="users[]" multiple id="selectUsersEvent">
                    <?php foreach ($people as $p) : ?>
                      <option value="<?= $p->id ?>"><?= $p->first_name . ' ' . $p->last_name ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-12">
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
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Mapa
              </button>
            </h2>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
              <div class="pb-5">
                <label for="location">Místo konání</label>
                <input type="text" name="latitute" value="<?= $event->latitute; ?>" id="latitute" readonly />
                <input type="text" name="longtitute" value="<?= $event->longtitute;?>" id="longtitute" readonly />
                <div id="map" style="height: 400px;"></div>
              <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
              
              <script>
              var la = <?= json_encode($event->latitute) ?>;
              var lo = <?= json_encode($event->longtitute) ?>;
              document.addEventListener('DOMContentLoaded', function () {
                if(la != null && lo != null){
                    var map = L.map('map').setView([la, lo], 9);
                  }else{
                    var map = L.map('map').setView([50,15], 7);
                  }
                  var marker;
                  

                  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                      attribution: '© OpenStreetMap contributors'
                  }).addTo(map);

                  if(la != null && lo != null){
                    marker = L.marker([la,lo]).addTo(map);
                  }
                  

                  var latitute = document.getElementById('latitute');
                  var longtitute = document.getElementById('longtitute');

                  map.on('click', function (e) {
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
            </div>
          </div>
        </div>
      </div>

      
      <?php if($event->creator_id == \App\Helpers\User::user()->id): ?> 
        <div class="pt-3">
          <button type="submit" id="submitButton" class="btn btn-primary" name="button">Uložit změny</button> 
        </div>
      <?php endif; ?>
  </form>
  <form method="post" action="<?= base_url('event/delete/'. $event->id); ?>" class="mt-4">    
    <?php if($event->creator_id == \App\Helpers\User::user()->id): ?> 
      <button type="submit" id="submitButton" class="btn btn-danger" name="button">Smazat event</button> 
    <?php endif; ?>
  </form>
</div>


<form action="<?= base_url('/chat'). '/' . $event->id . '/'. \App\Helpers\User::user()->id?>" method="post">
            <input type="text" class="form-controler" name="message" id="message" placeholder="Type message"
              aria-label="Recipient's username" aria-describedby="button-addon2" />
            <button class="btn btn-warning" type="submit" id="button-addon2" style="padding-top: .55rem;">
              Button
            </button>
          </form>


<div class="chat-history">
    <h2>Historie chatu</h2>
    <ul>
        <?php foreach ($chat as $message): ?>
            <li>
                <strong><?php echo $message->user_id; ?>:</strong>
                <span><?php echo $message->message; ?></span>
                <span class="timestamp"><?php echo $message->time; ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>



<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  const userId = '<?= \App\Helpers\User::user()->id; ?>';
  const eventId = '<?= $event->creator_id; ?>';
  const isOwner = (userId == eventId) ? true : false;
  console.log(isOwner);
  if(!isOwner) {
    const item = document.querySelectorAll(".form-control");
    const btns = document.querySelectorAll(".remove");

    item.forEach((element, index) => {
      element.setAttribute('readonly', index);
    });

    btns.forEach(button => {
      button.classList.add('disabled');
    });
  }
</script>
<?= $this->endSection(); ?>
