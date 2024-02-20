<?php

namespace App\Controllers;

use App\Helpers\User;
use App\Models\EventModel;
use App\Models\GetEvent;
use App\Models\Model;
use App\Models\UserModel;
use App\Libraries\Datum;
use App\Models\EventyGroupModel;
use App\Models\EventyUserModel;
use App\Models\GroupModel;
use DateTime;

class Home extends BaseController
{

  var $datum;
  protected $db;
  function __construct()
  {
    $this->datum = new Datum();
    $this->db = \Config\Database::connect();
  }
  public function index()
  {
    $model = new GetEvent();
    $events = $model->getDataWithID();
    //$events = $model->findAll();
    return view('index', 
      [
        'events' => $events,
        'eventsList' => $this->getEvents(),
      ]
    );
  }
  
  public function getEvents()
  {
    $model = new GetEvent();
    $events = $model->getDataWithID();
    $events_data = [];

    foreach ($events as $event) {
      
        $id = $event->id;
        $title = $event->nazev_eventu;
        $color = $event->color;
        $start = $event->zacatek_eventu;
        $end = $event->konec_eventu;

        // Přidejte data události do pole
        $events_data[] = [
            'id' => $id,
            'title' => $title,
            'start'=> $start,
            'end'=> $end,
            'color' => $color,
            'allDay' => (strstr($start, "00:00:00"))?true:false
        ];

    }
    return json_encode($events_data);
  }

  
}