<?php

namespace App\Models;

use CodeIgniter\Model;

class EventyUserModel extends \CodeIgniter\Model
{

    protected $table = 'eventy_users';
    protected $id = '$id';
    protected $allowedFields = [
        'event_id',
        'user_id'
    ];
    protected $returnType = "object";

}
