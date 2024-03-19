<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatMessageModel extends Model
{

    protected $table = 'chat_message';
    protected $id = '$id';
    protected $allowedFields = [
        'chat_id',
        'user_id',
        'message'
    ];
    protected $returnType = "object";
    protected $timestamps = false;

}