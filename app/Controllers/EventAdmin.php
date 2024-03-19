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

  public function getAllEvents(){
    $data['event'] = $this->eventModel->findAll();

    return view('events/eventList', $data);
  }


  public function deleteEvent($id){
    $this->eventModel->deleteEventAndRelated($id);

    return redirect()->to('/admin/events')->with('flash-success', 'Event smazán!');
}

public function editEventView($id){
    $e = $this->eventModel->getEventById($id);
    $data['event'] = $e;
    $data['users'] = $this->userModel->getUsersFromEventByEventId($id);
    $data['groups'] = $this->groupModel->getGroupsFromEventByEventId($id);
    $data['people'] = $this->userModel->getUsersToAddFiltered($id);
    $data['roles'] = $this->groupModel->getRolesToAddFiltered($id);

    return view('events/editEventAdmin', $data);
  }

  public function editEventSubmit($eventId){
    $data = $this->request->getPost();
    
    $userList = $this->request->getPost('users');
    $groupList = $this->request->getPost('groups');

    $prep = [
      'nazev_eventu' => $data['name'],
      'zacatek_eventu' => $data['start'],
      'konec_eventu' => $data['end'],
      'color' =>$data['color'],
      'description' => $data['description'],
      'latitute' => $data['latitute'],
      'longtitute' => $data['longtitute']
    ];

    
    if($userList != null) {
      foreach($userList as $id){
        $this->eventUserModel->insert(['user_id' => $id, 'event_id'=>$eventId]);
      }
    }

    if($groupList != null) {
      foreach($groupList as $id){
        $this->eventGroupModel->insert(['group_id' => $id, 'event_id'=>$eventId]);
      }
    }
    

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
    }
  }
  
}