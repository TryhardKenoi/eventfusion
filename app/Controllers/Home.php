<?php

namespace App\Controllers;

use App\Libraries\Datum;


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
    $events = $this->eventModel->getDataWithID();
    return view('index', 
      [
        'events' => $events,
        'eventsList' => $this->getEvents(),
      ]
    );
  }
  
  public function getEvents()
  {
    $events = $this->eventModel->getDataWithID();
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

  public function chat(){
    return view('chat');
  }
}