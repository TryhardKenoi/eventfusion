<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\Model;
use App\Models\UserModel;
use App\Libraries\Datum;
use App\Models\EventyGroupModel;
use App\Models\EventyUserModel;
use App\Models\GroupModel;
use App\Models\ChatModel;

class Event extends BaseController
{

  var $datum;
  protected $db;
  

  function __construct()
  {
    $this->datum = new Datum();
    $this->db = \Config\Database::connect();

  }


  public function createEventView() //Zobrazí view na vytvoření eventu
  {
    $data['settings'] = $this->siteSettings;

    $uModel = new UserModel();
    $gModel = new GroupModel();
    $data['people'] = $uModel->findAll();
    $data['groups'] = $gModel->findAll();
    return view('events/createEvent', $data);
  }

  public function createEventPost() //Vytvoří event
  {
    $data['settings'] = $this->siteSettings;

    $euModel = new EventyUserModel();
    $egModel = new EventyGroupModel();
    $eModel = new EventModel();

    $userId = \App\Helpers\User::user()->id;
    //users a groups
    $userList = $this->request->getPost('users');
    $groupList = $this->request->getPost('groups');
    if ($this->request->getPost('description')) {
      $description = $this->request->getPost('description');
    } else {
      $description = "";
    }

    $validationRules = [
      'nazev_eventu' => 'required',
      'rozgah_datum' => 'required'
    ];

    $validationMessages = [
      'nazev_eventu' => [
        'required' => 'Zadejte název eventu'
      ],
      'rozgah_datum' => [
        'required' => 'Zadejte rozsah konání eventu'
      ],
    ];

    if (!$this->validate($validationRules, $validationMessages)) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $data = [
      'nazev_eventu' => $this->request->getPost('nazev_eventu'),
      'zacatek_eventu' => null,
      'konec_eventu' => null,
      'color' => $this->request->getPost('color'),
      'creator_id' => $userId,
      'description' => $description
    ];

    $repeat = $this->request->getPost('repeat');
    $multiplier = $this->request->getPost('multiplier');

    switch ($repeat) {
      case 'none':
        $rozgahDatum = $this->request->getPost('rozgah_datum');
        $datum = $this->datum->splitDate($rozgahDatum);
        $data['zacatek_eventu'] = $datum['zacatek_eventu'] . " " . $this->request->getPost('startTime');
        $data['konec_eventu'] = $datum['konec_eventu'] . " " . $this->request->getPost('endTime');
        $eModel->insert($data);
        $eventId = $eModel->getInsertID();
        if ($userList != null) {
          foreach ($userList as $id) {
            $euModel->insert(['user_id' => $id, 'event_id' => $eventId]);
          }
        }
        if ($groupList != null) {
          foreach ($groupList as $id) {
            $egModel->insert(['group_id' => $id, 'event_id' => $eventId]);
          }
        }
        break;
      case 'day':
        for ($i = 0; $i < $multiplier; $i++) {
          $rozgahDatum = $this->request->getPost('rozgah_datum');
          $datum = $this->datum->splitDate($rozgahDatum);
          $taskDate = date('Y-m-d', strtotime($datum['zacatek_eventu'] . " +{$i} days"));
          $taskDate2 = date('Y-m-d', strtotime($datum['konec_eventu'] . " +{$i} days"));
          $data['zacatek_eventu'] = $taskDate . " " . $this->request->getPost('startTime');
          $data['konec_eventu'] = $taskDate2 . " " . $this->request->getPost('endTime');
          $eModel->insert($data);
          $eventId = $eModel->getInsertID();
          if ($userList != null) {
            foreach ($userList as $id) {
              $euModel->insert(['user_id' => $id, 'event_id' => $eventId]);
            }
          }
          if ($groupList != null) {
            foreach ($groupList as $id) {
              $egModel->insert(['group_id' => $id, 'event_id' => $eventId]);
            }
          }
        }
        break;
      case 'week':
        for ($i = 0; $i < $multiplier; $i++) {
          $rozgahDatum = $this->request->getPost('rozgah_datum');
          $datum = $this->datum->splitDate($rozgahDatum);
          $taskDate = date('Y-m-d', strtotime($datum['zacatek_eventu'] . " +{$i} weeks"));
          $taskDate2 = date('Y-m-d', strtotime($datum['konec_eventu'] . " +{$i} weeks"));
          $data['zacatek_eventu'] = $taskDate . " " . $this->request->getPost('startTime');
          $data['konec_eventu'] = $taskDate2 . " " . $this->request->getPost('endTime');
          $eModel->insert($data);
          $eventId = $eModel->getInsertID();
          if ($userList != null) {
            foreach ($userList as $id) {
              $euModel->insert(['user_id' => $id, 'event_id' => $eventId]);
            }
          }
          if ($groupList != null) {
            foreach ($groupList as $id) {
              $egModel->insert(['group_id' => $id, 'event_id' => $eventId]);
            }
          }
        }
        break;
      case '2weeks':
        for ($i = 0; $i < $multiplier; $i++) {
          $rozgahDatum = $this->request->getPost('rozgah_datum');
          $datum = $this->datum->splitDate($rozgahDatum);
          $taskDate = date('Y-m-d', strtotime($datum['zacatek_eventu'] . " +" . (2 * $i) . " weeks"));
          $taskDate2 = date('Y-m-d', strtotime($datum['konec_eventu'] . " +" . (2 * $i) . " weeks"));
          $data['zacatek_eventu'] = $taskDate . " " . $this->request->getPost('startTime');
          $data['konec_eventu'] = $taskDate2 . " " . $this->request->getPost('endTime');
          $eModel->insert($data);
          $eventId = $eModel->getInsertID();
          if ($userList != null) {
            foreach ($userList as $id) {
              $euModel->insert(['user_id' => $id, 'event_id' => $eventId]);
            }
          }
          if ($groupList != null) {
            foreach ($groupList as $id) {
              $egModel->insert(['group_id' => $id, 'event_id' => $eventId]);
            }
          }
        }
        break;
      case 'month':
        for ($i = 0; $i < $multiplier; $i++) {
          $rozgahDatum = $this->request->getPost('rozgah_datum');
          $datum = $this->datum->splitDate($rozgahDatum);
          $taskDate = date('Y-m-d', strtotime($datum['zacatek_eventu'] . " +{$i} months"));
          $taskDate2 = date('Y-m-d', strtotime($datum['konec_eventu'] . " +{$i} months"));
          $data['zacatek_eventu'] = $taskDate . " " . $this->request->getPost('startTime');
          $data['konec_eventu'] = $taskDate2 . " " . $this->request->getPost('endTime');
          $eModel->insert($data);
          $eventId = $eModel->getInsertID();
          if ($userList != null) {
            foreach ($userList as $id) {
              $euModel->insert(['user_id' => $id, 'event_id' => $eventId]);
            }
          }
          if ($groupList != null) {
            foreach ($groupList as $id) {
              $egModel->insert(['group_id' => $id, 'event_id' => $eventId]);
            }
          }
        }
        break;
      case 'year':
        for ($i = 0; $i < $multiplier; $i++) {
          $rozgahDatum = $this->request->getPost('rozgah_datum');
          $datum = $this->datum->splitDate($rozgahDatum);
          $taskDate = date('Y-m-d', strtotime($datum['zacatek_eventu'] . " +{$i} years"));
          $taskDate2 = date('Y-m-d', strtotime($datum['konec_eventu'] . " +{$i} years"));
          $data['zacatek_eventu'] = $taskDate . " " . $this->request->getPost('startTime');
          $data['konec_eventu'] = $taskDate2 . " " . $this->request->getPost('endTime');
          $eModel->insert($data);
          $eventId = $eModel->getInsertID();
          if ($userList != null) {
            foreach ($userList as $id) {
              $euModel->insert(['user_id' => $id, 'event_id' => $eventId]);
            }
          }
          if ($groupList != null) {
            foreach ($groupList as $id) {
              $egModel->insert(['group_id' => $id, 'event_id' => $eventId]);
            }
          }
        }
        break;
      default:
        echo 'brambory';
        break;
    }



    return redirect()->to('/')->with('flash-success', 'Přidáno!');
  }

  //Metodou získám data, které volám do modal okna
  public function getEventByID($id) 
  {
    $data['settings'] = $this->siteSettings;

    $model = new Model();
    $event = $this->eventModel->where('id', $id)->first();
    $event->groups = $model->getGroupsByEventId($id);
    $event->users = $model->getUsersByEventId($id);
    $event->allDay = (strstr($event->zacatek_eventu, "00:00:00")) ? true : false;
    $data = json_encode((array)$event);
    return $data;
  }

  public function editEventView($id)
  {
    $data['settings'] = $this->siteSettings;

    $model = new Model();
    $chatModel = new ChatModel();
    $e = $model->getEventById($id);
    $chatHistory = $chatModel->where('event_id', $id)->findAll();
    $data['event'] = $e;
    $data['users'] = $model->getUsersFromEventByEventId($id);
    $data['groups'] = $model->getGroupsFromEventByEventId($id);
    $data['people'] = $model->getUsersToAddFiltered($id);
    $data['org'] = $model->getRolesToAddFiltered($id);
    $data['chat'] = $chatHistory;

    return view('events/eventEdit', $data);
  }

  public function editEventPost($eventId)
  {
    $data['settings'] = $this->siteSettings;

    $data = $this->request->getPost();
    $model = new EventModel();
    $euModel = new EventyUserModel();
    $egModel = new EventyGroupModel();

    $userList = $this->request->getPost('users');
    $groupList = $this->request->getPost('groups');

    $prep = [
      'nazev_eventu' => $data['name'],
      'zacatek_eventu' => $data['start'],
      'konec_eventu' => $data['end'],
      'color' => $data['color'],
      'description' => $data['description'],
      'latitute' => $data['latitute'],
      'longtitute' => $data['longtitute']
    ];


    if ($userList != null) {
      foreach ($userList as $id) {
        $euModel->insert(['user_id' => $id, 'event_id' => $eventId]);
      }
    }

    if ($groupList != null) {
      foreach ($groupList as $id) {
        $egModel->insert(['group_id' => $id, 'event_id' => $eventId]);
      }
    }


    $model->update($eventId, $prep);
    return redirect()->to('/event/info/' . $eventId)->with('flash-success', 'Změna úspěšná!');;
  }

  public function deleteEvent($id)
  { //Metoda smaže event
    $data['settings'] = $this->siteSettings;

    $model = new EventModel();
    $model->deleteEventAndRelated($id);

    return redirect()->to('/')->with('flash-success', 'Event smazán!');
  }

  public function removeUserFromEvent($eventUserID, $eventId)
  { //Metoda odebere uživatele z eventu
    $model = new Model();
    $data['settings'] = $this->siteSettings;


    if ($model->removeUserFromEvent($eventUserID)) {
      return redirect()->to('/event/edit/' . $eventId)->with('flash-success', 'Úspěšně odebráno!');
    } else {
      return redirect()->to('/event/edit/' . $eventId)->with('flash-error', 'Odebrání neuspěšné!');
    }
  }

  public function removeGroupFromEvent($eventGroupId, $eventId)
  { //Metoda odebere skupinu z eventu
    $model = new Model();
    $data['settings'] = $this->siteSettings;

    if ($model->removeGroupFromEvent($eventGroupId)) {
      return redirect()->to('/event/edit/' . $eventId)->with('flash-success', 'Úspěšně odebráno!');
    } else {
      return redirect()->to('/event/edit/' . $eventId)->with('flash-error', 'Odebrání neuspěšné!');
    }
  }

  public function getEventInfo($id)
  {
    $data['settings'] = $this->siteSettings;

    $model = new Model();
    $chatModel = new ChatModel();
    $e = $model->getEventById($id);
    $chatHistory = $chatModel->where('event_id', $id)->findAll();
    $data['event'] = $e;
    $data['users'] = $model->getUsersFromEventByEventId($id);
    $data['groups'] = $model->getGroupsFromEventByEventId($id);
    $data['people'] = $model->getUsersToAddFiltered($id);
    $data['org'] = $model->getRolesToAddFiltered($id);
    $data['chat'] = $chatHistory;

    return view('events/eventInfo', $data);
  }
}
