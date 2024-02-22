<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{

    protected $table = 'chat';
    protected $id = '$id';
    
    protected $allowedFields = [
        'event_id',
        'created_at'
    ];
    protected $returnType = "object";

}
