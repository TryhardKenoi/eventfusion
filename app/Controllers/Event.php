<?php

namespace App\Controllers;

use App\Libraries\Datum;

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
    $data['people'] = $this->userModel->findAll();
    $data['groups'] = $this->groupModel->findAll();
    return view('events/createEvent', $data);
  }

  public function createEventPost() //Vytvoří event
  {
    $userId = \App\Helpers\User::user()->id;
    //users a groups
    $userList = $this->request->getPost('users');
    $groupList = $this->request->getPost('groups');
    if($this->request->getPost('description')){
      $description = $this->request->getPost('description');
    }else{
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

    if(!$this->validate($validationRules, $validationMessages)){
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
    $datum = $this->datum->splitDate($this->request->getPost("rozgah_datum"));

    $data = [
      'nazev_eventu' => $this->request->getPost('nazev_eventu'),
      'zacatek_eventu' => $datum['zacatek_eventu'],
      'konec_eventu' => $datum['konec_eventu'],
      'color' => $this->request->getPost('color'),
      'creator_id' => $userId,
      'description' => $description
    ];

    $repeat = $this->request->getPost('repeat');
    $multiplier = (int) $this->request->getPost('multiplier');
    if($repeat != "none") {
      for ($i = 0; $i < $multiplier; $i++) {
        $rozgahDatum = $this->request->getPost('rozgah_datum');
        $datum = $this->datum->splitDate($rozgahDatum);
        $taskDate = date('Y-m-d', strtotime($datum['zacatek_eventu'] . " +{$i} {$repeat}"));
        $taskDate2 = date('Y-m-d', strtotime($datum['konec_eventu'] . " +{$i} {$repeat}"));
        $data['zacatek_eventu'] = $taskDate . " " . $this->request->getPost('startTime');
        $data['konec_eventu'] = $taskDate2 . " " . $this->request->getPost('endTime');
        //ulozeni samostatneho eventu
        $this->eventModel->insert($data);
        //ziskani ID ulozeneho eventu
        $eventId = $this->eventModel->getInsertID();
  
        if ($userList != null) {
          foreach ($userList as $id) {
              $this->eventUserModel->insert(['user_id' => $id, 'event_id' => $eventId]);
          }
        }

        if ($groupList != null) {
          foreach ($groupList as $id) {
              $this->eventGroupModel->insert(['group_id' => $id, 'event_id' => $eventId]);
          }
        }
      }
    }else {
      $this->eventModel->insert($data);
      $eventId = $this->eventModel->getInsertID();

      if ($userList != null) {
        foreach ($userList as $id) {
            $this->eventUserModel->insert(['user_id' => $id, 'event_id' => $eventId]);
        }
      }

      if ($groupList != null) {
        foreach ($groupList as $id) {
            $this->eventGroupModel->insert(['group_id' => $id, 'event_id' => $eventId]);
        }
      }
    }  
    return redirect()->to('/')->with('flash-success', 'Přidáno!');
  }

  public function getEventByID($id) //Metodou získám data, které volám do modal okna
  {
    $event = $this->eventModel->getEventById($id);
    $event->groups = $this->groupModel->getGroupsByEventId($id);
    $event->users = $this->eventUserModel->getUsersByEventId($id);
    $event->allDay = (strstr($event->zacatek_eventu, "00:00:00"))?true:false;
    $data = json_encode((array)$event);
    return $data;
  }

  public function editEventView($id) {
    $e = $this->eventModel->getEventById($id);
    $chatHistory = $this->chatModel->where('event_id', $id)->findAll();
    $data['event'] = $e;
    $data['users'] = $this->userModel->getUsersFromEventByEventId($id);
    $data['groups'] = $this->groupModel->getGroupsFromEventByEventId($id);
    $data['people'] = $this->userModel->getUsersToAddFiltered($id);
    $data['org'] = $this->groupModel->getRolesToAddFiltered($id);
    $data['chat'] = $chatHistory;

    return view('events/eventEdit', $data);

}

  public function editEventPost($eventId){
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
    return redirect()->to('/event/info/'.$eventId)->with('flash-success', 'Změna úspěšná!');;

  }

  public function deleteEvent($id){ //Metoda smaže event
    $this->eventModel->deleteEventAndRelated($id);
    
    return redirect()->to('/')->with('flash-success', 'Event smazán!');
  }

  public function removeUserFromEvent($eventUserID, $eventId){
    if($this->eventUserModel->removeUserFromEvent($eventUserID)){
      return redirect()->to('/event/edit/'.$eventId)->with('flash-success', 'Úspěšně odebráno!');
    }else{
      return redirect()->to('/event/edit/'.$eventId)->with('flash-error', 'Odebrání neuspěšné!');
    }    
  }

  public function removeGroupFromEvent($eventGroupId, $eventId){ //Metoda odebere skupinu z eventu
    if($this->eventGroupModel->removeGroupFromEvent($eventGroupId)){
      return redirect()->to('/event/edit/'.$eventId)->with('flash-success', 'Úspěšně odebráno!');
    }else{
      return redirect()->to('/event/edit/'.$eventId)->with('flash-error', 'Odebrání neuspěšné!');
    }
  }

  public function getEventInfo($id){
    $e = $this->eventModel->getEventById($id);
    $chatHistory = $this->chatModel->where('event_id', $id)->findAll();
    $data['event'] = $e;
    $data['users'] = $this->userModel->getUsersFromEventByEventId($id);
    $data['groups'] = $this->groupModel->getGroupsFromEventByEventId($id);
    $data['people'] = $this->userModel->getUsersToAddFiltered($id);
    $data['org'] = $this->groupModel->getRolesToAddFiltered($id);
    $data['chat'] = $chatHistory;

    return view('events/eventInfo', $data); 
  }

}