<?php

namespace App\Controllers;

use App\Models\ChatModel;

class Chat extends BaseController
{

  protected $db;
  function __construct()
  {
    $this->db = \Config\Database::connect();
  }
  
  public function saveMessage($eventID, $userID){
    $model = new ChatModel();
    $data = [
        'event_id' => $eventID,
        'user_id' => $userID,
        'message' => $this->request->getPost('message')
    ];

    $model->insert($data);
    return redirect()->to('event/edit/'.$eventID)->with('flash-success', 'Zpráva odeslána');
  }




}