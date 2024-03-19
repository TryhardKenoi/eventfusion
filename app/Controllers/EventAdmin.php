<?php

namespace App\Controllers;


use App\Models\EventModel;
use App\Models\Model;
use App\Libraries\Datum;
use App\Models\EventyGroupModel;
use App\Models\EventyUserModel;

class EventAdmin extends BaseController
{

  var $datum;
  protected $db;
  function __construct()
  {
    $this->datum = new Datum();
    $this->db = \Config\Database::connect();
  }

  public function getAllEvents()
  {
    $data['settings'] = $this->siteSettings;

    $model = new EventModel();
    $data['event'] = $model->findAll();

    return view('events/eventList', $data);
  }


  public function deleteEvent($id)
  {
    $data['settings'] = $this->siteSettings;

    $model = new EventModel();
    $model->deleteEventAndRelated($id);

    return redirect()->to('/admin/events')->with('flash-success', 'Event smazán!');
  }

  public function editEventView($id)
  {
    $data['settings'] = $this->siteSettings;

    $model = new Model();
    $e = $model->getEventById($id);
    $data['event'] = $e;
    $data['users'] = $model->getUsersFromEventByEventId($id);
    $data['groups'] = $model->getGroupsFromEventByEventId($id);
    $data['people'] = $model->getUsersToAddFiltered($id);
    $data['roles'] = $model->getRolesToAddFiltered($id);

    return view('events/editEventAdmin', $data);
  }

  public function editEventSubmit($eventId)
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
    return redirect()->to('/admin/event/edit/' . $eventId)->with('flash-success', 'Změna úspěšná!');
  }


  public function removeUserFromEvent($eventUserID, $eventId)
  {
    $data['settings'] = $this->siteSettings;

    $model = new Model();

    if ($model->removeUserFromEvent($eventUserID)) {
      return redirect()->to('/admin/event/edit/' . $eventId)->with('flash-success', 'Úspěšně odebráno!');
    } else {
      return redirect()->to('/admin/event/edit/' . $eventId)->with('flash-error', 'Odebrání neuspěšné!');
    }
  }

  public function removeGroupFromEvent($eventGroupId, $eventId)
  {
    $data['settings'] = $this->siteSettings;

    $model = new Model();
    if ($model->removeGroupFromEvent($eventGroupId)) {
      return redirect()->to('/admin/event/edit/' . $eventId)->with('flash-success', 'Úspěšně odebráno!');
    } else {
      return redirect()->to('/admin/event/edit/' . $eventId)->with('flash-error', 'Odebrání neuspěšné!');
    }
  }
}
