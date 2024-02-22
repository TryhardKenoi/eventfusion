<?php

namespace App\Controllers;

use App\Models\ChatMessageModel;
use App\Models\ChatModel;
use CodeIgniter\HTTP\Request;

class Chat extends BaseController
{

  protected $db;
  protected $chatModel;  
  protected $chatMessageModel;
  function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->chatModel = new ChatModel();
    $this->chatMessageModel = new ChatMessageModel();
  }
  
  public function index($id) 
  { 
    if(empty($this->chatModel->where('event_id', $id)->get()->getResult())) return redirect()->to('/');

    $chat = $this->chatModel->select('chat.*,eventy.nazev_eventu')->join('eventy', 'eventy.id=chat.event_id','left')->where('event_id', $id)->get()->getResult()[0];
    $data['chat'] = $chat;
    
    return view('chat', $data);  
  }

  public function fetchChat()
  {
    $id = $this->request->getVar('evid');
    $chat = $this->chatModel->select('chat.*,eventy.nazev_eventu')
    ->join('eventy', 'eventy.id=chat.event_id','left')
    ->where('event_id', $id)->get()->getResult()[0];
  
    $data['chat'] = $chat;
    $data['messages'] = $this->chatMessageModel
                              ->select('chat_message.*, users.last_name,users.first_name')
                              ->join('users','users.id=chat_message.user_id','left')
                              ->where('chat_id', $chat->id)->findAll();

    return json_encode($data);
  }

  public function add()
  {
    $message = $this->request->getPost('message');
    $uid = $this->request->getPost('uid');    
    $chid = $this->request->getPost('chid');

    $this->chatMessageModel->insert([
      'user_id'=>$uid,
      'message'=>$message,
      'chat_id'=>$chid
    ]);


    return json_encode(['status'=>200]);
  }
}