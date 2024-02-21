<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends \CodeIgniter\Model
{

    protected $table = 'chat';
    protected $id = '$id';
    protected $allowedFields = [
        'event_id',
        'user_id',
        'message',
        'time',
    ];
    protected $returnType = "object";

}
