<?php

namespace App\Controllers;

use App\Libraries\Datum;

class EventAdmin extends BaseController
{

  var $datum;
  protected $db;
  function __construct()
  {
    $this->datum = new Datum();
    $this->db = \Config\Database::connect();
  }

<<<<<<< HEAD
  public function getAllEvents()
  {
    $data['settings'] = $this->siteSettings;

    $model = new EventModel();
    $data['event'] = $model->findAll();
=======
  public function getAllEvents(){
    $data['event'] = $this->eventModel->findAll();
>>>>>>> 3e38d418f25e402cdaaa59e92ab5ef4e09029d2c

    return view('events/eventList', $data);
  }


<<<<<<< HEAD
  public function deleteEvent($id)
  {
    $data['settings'] = $this->siteSettings;

    $model = new EventModel();
    $model->deleteEventAndRelated($id);
=======
  public function deleteEvent($id){
    $this->eventModel->deleteEventAndRelated($id);
>>>>>>> 3e38d418f25e402cdaaa59e92ab5ef4e09029d2c

    return redirect()->to('/admin/events')->with('flash-success', 'Event smazán!');
  }

  public function editEventView($id)
  {
    $data['settings'] = $this->siteSettings;

<<<<<<< HEAD
    $model = new Model();
    $e = $model->getEventById($id);
=======
public function editEventView($id){
    $e = $this->eventModel->getEventById($id);
>>>>>>> 3e38d418f25e402cdaaa59e92ab5ef4e09029d2c
    $data['event'] = $e;
    $data['users'] = $this->userModel->getUsersFromEventByEventId($id);
    $data['groups'] = $this->groupModel->getGroupsFromEventByEventId($id);
    $data['people'] = $this->userModel->getUsersToAddFiltered($id);
    $data['roles'] = $this->groupModel->getRolesToAddFiltered($id);

    return view('events/editEventAdmin', $data);
  }

  public function editEventSubmit($eventId)
  {
    $data['settings'] = $this->siteSettings;

    $data = $this->request->getPost();
<<<<<<< HEAD
    $model = new EventModel();

    $euModel = new EventyUserModel();
    $egModel = new EventyGroupModel();


=======
    
>>>>>>> 3e38d418f25e402cdaaa59e92ab5ef4e09029d2c
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

<<<<<<< HEAD

    if ($userList != null) {
      foreach ($userList as $id) {
        $euModel->insert(['user_id' => $id, 'event_id' => $eventId]);
      }
    }

    if ($groupList != null) {
      foreach ($groupList as $id) {
        $egModel->insert(['group_id' => $id, 'event_id' => $eventId]);
=======
    
    if($userList != null) {
      foreach($userList as $id){
        $this->eventUserModel->insert(['user_id' => $id, 'event_id'=>$eventId]);
      }
    }

    if($groupList != null) {
      foreach($groupList as $id){
        $this->eventGroupModel->insert(['group_id' => $id, 'event_id'=>$eventId]);
>>>>>>> 3e38d418f25e402cdaaa59e92ab5ef4e09029d2c
      }
    }


<<<<<<< HEAD
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
=======
    $this->eventModel->update($eventId, $prep);
    return redirect()->to('/admin/event/edit/'.$eventId)->with('flash-success', 'Změna úspěšná!');
  }


  public function removeUserFromEvent($eventUserID, $eventId){
    if($this->eventUserModel->removeUserFromEvent($eventUserID)){
      return redirect()->to('/admin/event/edit/'.$eventId)->with('flash-success', 'Úspěšně odebráno!');
    }else{
      return redirect()->to('/admin/event/edit/'.$eventId)->with('flash-error', 'Odebrání neuspěšné!');
    }    
  }

  public function removeGroupFromEvent($eventGroupId, $eventId){
    if($this->eventGroupModel->removeGroupFromEvent($eventGroupId)){
      return redirect()->to('/admin/event/edit/'.$eventId)->with('flash-success', 'Úspěšně odebráno!');
    }else{
      return redirect()->to('/admin/event/edit/'.$eventId)->with('flash-error', 'Odebrání neuspěšné!');
>>>>>>> 3e38d418f25e402cdaaa59e92ab5ef4e09029d2c
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
