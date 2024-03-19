<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table = 'users';
    protected $id = '$id';
    protected $allowedFields = [
        'email',
        'username',
        'first_name',
        'last_name',
        'phone',
        'company',
        'password'
    ];
    protected $returnType = "object";

}
